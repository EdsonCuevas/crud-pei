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
        $userId = Auth::id();

        $programs = Program::where('coordi_id',$userId)->get();

        return Inertia::render("PanelCoordi/Index",[
            "Programas"=> $programs,
        ]);
    }
}
