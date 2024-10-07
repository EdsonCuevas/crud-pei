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
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Filtra los usuarios que tengan el rol 'voluntario' y carga sus programas
        $user = User::whereIn('role_id', [2, 1])->with('role')->get();

        return Inertia::render('Volunt/IndexCont', [
            'users' => $user
        ]);
    }
}
