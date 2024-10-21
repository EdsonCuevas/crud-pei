<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminVolunteersController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $volunteers = User::where('role_id', '3')->with('programs:title')->get();
        $roles = Role::all();

        return Inertia::render('Admin/Users/Volunteers', [
            'voluntarios' => $volunteers,
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

        $volunteer = new User($request->except('password'));
        $volunteer->role_id = '3';
        $volunteer->password = Hash::make($request->password);
        $volunteer->birthdate = $request->birthdate;
        $volunteer->save();
        return redirect('admin-volunteers');
    }

    public function update(Request $request, User $admin_volunteer)
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

        $admin_volunteer->update($request->all());
        $admin_volunteer->birthdate = $request->birthdate; // Actualiza la fecha
        $admin_volunteer->save();

        return redirect('admin-volunteers');
    }

    public function destroy(User $admin_volunteer)
    {
        $admin_volunteer->delete();
        return redirect('admin-volunteers');
    }
}
