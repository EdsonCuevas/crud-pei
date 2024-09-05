<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContacVoluntController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'voluntario' y carga sus programas
        $contacto = User::where('role', 'voluntarios')->with('programs:name')->get();

        return Inertia::render('Users/Volunt/IndexCont', [
            'contactos' => $contacto
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
        $contacto = new User($request->except('password'));
        $contacto->role = 'voluntario';
        $contacto->password = Hash::make($request->password);
        $contacto->save();
        return redirect('volunt');
    }

    public function update(Request $request, User $contacto)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'phone' => 'required|max:20',
        ]);

        $contacto->update($request->input());
        return redirect('volunt');
    }

}

