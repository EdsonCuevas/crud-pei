<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DonorMyInfoController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 4) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        return Inertia::render('Donador/MyInfo');
    }
}
