<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoordPeticionesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $userId = Auth::id();

        // Consulta que une la tabla de usuarios con la tabla intermedia program_user
        $programUsers = User::with(['programs' => function($query) {
            $query->select('program_id', 'user_id', 'approved');
        }])
        ->whereHas('programs', function ($query) use ($userId) {
            $query->where('coordi_id', $userId);
        })
        ->get();

        return Inertia::render("PanelCoordi/Peticiones", [
            "ProgramUsers" => $programUsers,
        ]);
    }
}
