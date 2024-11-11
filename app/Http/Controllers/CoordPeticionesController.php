<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CoordPeticionesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Verifica si el usuario tiene el rol adecuado
        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Obtiene los programas con los usuarios pendientes de aprobación
        $programas = Program::with(['users' => function ($query) {
            $query->wherePivot('approved', 0)
                ->select('users.id', 'name')
                ->withPivot('approved');
        }])->get();

        // Retorna los datos a la vista usando Inertia
        return Inertia::render('Coordi/Peticiones', [
            'Programas' => $programas
        ]);
    }

    // Método para aceptar la solicitud de un usuario
    public function acceptRequest(Request $request)
    {
        // Valida los datos del request
        $request->validate([
            'userId' => 'required|integer',
            'programId' => 'required|integer',
        ]);

        // Encuentra el programa y actualiza el estado de aprobación del usuario
        $program = Program::findOrFail($request->programId);
        $program->users()->updateExistingPivot($request->userId, ['approved' => 1]);

        // Retorna un mensaje de éxito
        return redirect()->back()->with('success', 'Usuario aprobado correctamente.');
    }
}
