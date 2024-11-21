<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth; // Importar Auth
use App\Models\Donation;
use Inertia\Inertia;

class CoordProgramController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401');
        }

        $userId = Auth::id();

        $programs = Program::where('coordi_id', $userId)
            ->with(['users', 'creator'])
            ->withSum('donations as total_donations', 'value')
            ->get();

        return Inertia::render("Coordi/Index", [
            "Programas" => $programs,
        ]);
    }

    public function show(Program $coord_program)
    {
        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401');
        }

        $coord_program->load(['creator', 'coordinator']); // Cargar las relaciones
        $totalDonations = Donation::where('programs_id', $coord_program->id)->sum('value');

        return Inertia::render('Coordi/Show', [
            'program' => $coord_program,
            'creator' => $coord_program->creator,
            'coordinator' => $coord_program->coordinator,
            'users' => $coord_program->users,
            'totalDonations' => $totalDonations,
        ]);
    }
}
