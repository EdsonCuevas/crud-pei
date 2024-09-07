<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CoordiController extends Controller
{

    public function index()
    {
        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $coordis = User::where('role', 'coordi')->with('programs:name')->get();

        return Inertia::render('Users/Coordinators/Index', [
            'coordinadores' => $coordis
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
        ]);
        $coordinador = new User($request->except('password'));
        $coordinador->role = 'coordi';
        $coordinador->password = Hash::make($request->password);
        $coordinador->save();
        return redirect('coordinators');
    }

    public function update(Request $request, User $coordinador)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'phone' => 'required|max:20',
        ]);

        $coordinador->update($request->input());
        return redirect('coordinators');
    }

    public function destroy(User $coordinador)
    {
        $coordinador->delete();
        return redirect('coordinators');
    }
    
}
