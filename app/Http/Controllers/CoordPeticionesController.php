<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CoordPeticionesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Verificar si el usuario tiene el rol correcto (id 2 para coordinador)
        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Obtener los programas con usuarios que no han sido aprobados (approved = 0)
        $programas = Program::with(['users' => function ($query) {
            $query->wherePivot('approved', 0)
                ->select('users.id', 'name')
                ->withPivot('approved');
        }])->get();

        return Inertia::render('PanelCoordi/Peticiones', [
            'Programas' => $programas
        ]);
    }
}
