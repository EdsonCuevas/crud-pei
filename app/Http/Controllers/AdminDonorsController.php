<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminDonorsController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $donors = User::where('role_id', '4')->with('programs:title')->get();
        $roles = Role::all();

        return Inertia::render('Admin/Users/Donors', [
            'donadores' => $donors,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'password' => 'required|min:8',
            'phone' => ['required', 'digits_between:1,15'],
            'birthdate' => 'required|date',
            'rfc' => 'required|max:12',
        ]);

        $donor = new User($request->except('password'));
        $donor->role_id = '4';
        $donor->password = Hash::make($request->password);
        $donor->birthdate = $request->birthdate;
        $donor->save();
        return redirect('admin-donors');
    }

    public function update(Request $request, User $admin_donor)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => ['required', 'digits_between:1,15'],
            'role_id' => 'required',
            'password' => 'nullable|min:8',
            'birthdate' => 'required|date',
            'rfc' => 'required|max:12',
        ]);

        // Solo encripta la contraseña si fue proporcionada
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $admin_donor->update($request->all());
        $admin_donor->birthdate = $request->birthdate; // Actualiza la fecha
        $admin_donor->save();
        return redirect('admin-donors');
    }

    public function destroy(User $admin_donor)
    {
        $admin_donor->delete();
        return redirect('admin-donors');
    }
}
