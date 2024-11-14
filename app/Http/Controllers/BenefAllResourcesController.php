<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Program;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BenefAllResourcesController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 5) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $programs = Program::with('coordinator')->get();

        $userPrograms = $user->programs->pluck('id')->toArray();

        return Inertia::render('Benef/AllPrograms', [
            'programas' => $programs,
            'userPrograms' => $userPrograms,
        ]);
    }

    public function registerUserToProgram(Request $request)
    {
        $program = Program::findOrFail($request->program_id);
        $user = User::findOrFail(Auth::id());

        // Verificar si el usuario ya está registrado en el programa
        if ($user->programs()->where('program_id', $program->id)->exists()) {
            return redirect()->back()->withErrors(['program' => 'Ya estás registrado en este programa.']);
        }

        // Si no está registrado, crea la relación
        $user->programs()->attach($program->id);

        return redirect()->back()->with('success', '¡Te has registrado en el programa exitosamente!');
    }
}
