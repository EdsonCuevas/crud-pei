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

        return Inertia::render('Programs/Index', [
            'programas' => Program::with(['creator', 'coordinator'])->paginate(2)
        ]);
    }

    public function destroy(Program $admin_program)
    {
        $admin_program->delete();
        return redirect('admin-programs')->with('success', 'Programa Eliminado');
    }
}
