<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminCoordiController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $coordis = User::where('role_id', '2')->get();
        $roles = Role::all();

        return Inertia::render('Admin/Users/Coordinators', [
            'coordinadores' => $coordis,
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
            'birthdate' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'), 'after_or_equal:1900-01-01'],
            'rfc' => 'required|max:12',
        ]);

        $coordinador = new User($request->except('password'));
        $coordinador->role_id = '2';
        $coordinador->password = Hash::make($request->password);
        $coordinador->birthdate = $request->birthdate;
        $coordinador->save();
        return redirect('admin-coordinators');
    }

    public function update(Request $request, User $admin_coordinator)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => ['required', 'digits_between:1,15'],
            'role_id' => 'required',
            'password' => 'nullable|min:8',
            'birthdate' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'), 'after_or_equal:1900-01-01'],
            'rfc' => 'required|max:12',
        ]);

        // Solo encripta la contraseña si fue proporcionada
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $admin_coordinator->update($request->all());
        $admin_coordinator->birthdate = $request->birthdate; // Actualiza la fecha
        $admin_coordinator->save();

        return redirect('admin-coordinators');
    }


    public function destroy(User $admin_coordinator)
    {
        $admin_coordinator->delete();
        return redirect('admin-dashboard');
    }
}
