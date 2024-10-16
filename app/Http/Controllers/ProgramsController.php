<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Program;

class ProgramsController extends Controller
{
    public function index() {
        // Obtener todos los programas ordenados por la fecha de creación (más nuevos primero)
        $programas = Program::orderBy('created_at', 'desc')->get();
        return Inertia::render('Programs', [
            'programas' => $programas
        ]);
    }
}
