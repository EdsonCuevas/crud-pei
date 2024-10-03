<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DonorContactosController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 4) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $contactos = User::where('role', 'voluntario')->with('programs:title')->get();

        return Inertia::render('Donador/Contactos', [
            'contactos' => $contactos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255'
        ]);
        $contacto = new Contacto($request->all());
        $contacto->save();
        return redirect('contactos');
    }

    public function update(Request $request, Contacto $contacto)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|max:20',
            'direccion' => 'nullable|max:255'
        ]);

        $contacto->update($request->input());
        return redirect('contactos');
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return redirect('contactos');
    }
}
