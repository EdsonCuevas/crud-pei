<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BenefRecursosController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 5) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $programs = $user->programs()->with(['creator', 'coordinator'])->get();

        return Inertia::render('Benef/Recursos', [
            'programas' => $programs
        ]);
    }
}
