<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $programas = Program::orderBy('created_at', 'desc')->take(6)->get();

        return Inertia::render('HomePage', [
            'programas' => $programas
        ]);
    }


    public function inscripcion(Request $request)
    {
        $user = Auth::user();

        // Verifica si el usuario no está autenticado o si no es beneficiario
        if (!$user || $user->role->id !== 5) {
            return redirect()->back()->withErrors(['error_auth' => 'Necesitas iniciar sesion como beneficiario.']);
        }

        // Buscar el recurso (programa) por ID
        $program = Program::findOrFail($request->program_id);

        // Verificar si el usuario ya está registrado en el programa
        if ($user->programs()->where('program_id', $program->id)->exists()) {
            return redirect()->back()->withErrors(['already_registered' => 'Ya estás registrado en este programa.']);
        }

        // Inscribir al usuario en el programa
        $user->programs()->attach($program->id);

        // Mensaje de éxito
        return redirect()->back()->with('success', '¡Tu inscripción ha sido exitosa!');
    }
}
