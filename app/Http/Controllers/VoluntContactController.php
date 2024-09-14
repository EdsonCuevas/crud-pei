<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class VoluntContactController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 3) {
            return redirect()->route('404')->with('error', 'No tienes acceso a esta página.');
        }

        // Filtra los usuarios que tengan el rol 'voluntario' y carga sus programas
        $user = User::where('role',  'coordi')->get();

        return Inertia::render('Volunt/IndexCont', [
            'users' => $user
        ]);
    }
}
