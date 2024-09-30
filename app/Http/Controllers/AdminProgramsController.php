<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;

class AdminProgramsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('404')->with('error', 'No tienes acceso a esta página.');
        }

        return Inertia::render('Admin/Programs/Index', [
            'programas' => Program::with(['creator', 'coordinator'])->paginate(2)
        ]);
    }

    public function show(Program $admin_program)
    {

        $admin_program->load(['creator', 'coordinator']); // Cargar las relaciones

        return Inertia::render('Admin/Programs/Show', [
            'program' => $admin_program,
            'creator' => $admin_program->creator,
            'coordinator' => $admin_program->coordinator,
            'users' => $admin_program->users
        ]);
    }

    public function destroy(Program $admin_program)
    {
        $admin_program->delete();
        return redirect('admin-programs')->with('success', 'Programa Eliminado');
    }
}
