<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth; // Importar Auth
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoordProgramController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('404')->with('error', 'No tienes acceso a esta página.');
        }

        $userId = Auth::id();

        $programs = Program::where('coordi_id', $userId)->get();

        return Inertia::render("PanelCoordi/Index", [
            "Programas" => $programs,
        ]);
    }
}
