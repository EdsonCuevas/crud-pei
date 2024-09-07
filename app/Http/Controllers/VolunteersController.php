<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class VolunteersController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $volunteers = User::where('role_id', '3')->with('programs:name')->get();
        $roles = Role::all();

        return Inertia::render('Users/Volunteers', [
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
            'phone' => 'required|max:20',
        ]);
        $volunteer = new User($request->except('password'));
        $volunteer->role_id = '3';
        $volunteer->password = Hash::make($request->password);
        $volunteer->save();
        return redirect('volunteers');
    }

    public function update(Request $request, User $volunteer)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => 'required|max:20',
            'role_id' => 'required',
        ]);

        // Verifica si la contraseña está presente en el request antes de actualizarla
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $volunteer->update($request->input());
        return redirect('volunteers');
    }

    public function destroy(User $volunteer)
    {
        $volunteer->delete();
        return redirect('volunteers');
    }
}
