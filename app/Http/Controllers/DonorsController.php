<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class DonorsController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $donors = User::where('role_id', '4')->with('programs:name')->get();
        $roles = Role::all();

        return Inertia::render('Users/Donors', [
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
            'phone' => 'required|max:20',
        ]);
        $donor = new User($request->except('password'));
        $donor->role_id = '4';
        $donor->password = Hash::make($request->password);
        $donor->save();
        return redirect('donors');
    }

    public function update(Request $request, User $donor)
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

        $donor->update($request->input());
        return redirect('donors');
    }

    public function destroy(User $donor)
    {
        $donor->delete();
        return redirect('donors');
    }
}
