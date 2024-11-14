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
            return redirect()->route('401');
        }

        $contactos = User::whereIn('role_id', [1])->with('role')->get();

        return Inertia::render('Donador/Contactos', [
            'contactos' => $contactos
        ]);
    }
}
