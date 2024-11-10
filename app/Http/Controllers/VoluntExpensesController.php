<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class VoluntExpensesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 3) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $userId = Auth::id();

        $programs = Program::all();

        $expenses = Expenses::where('user_id', $userId)
            ->with(relations: 'program')
            ->with(relations: 'user')
            ->get();

        // Pass the retrieved data to the Inertia view
        return Inertia::render('Volunt/Index', [
            'expenses' => $expenses,
            'programs' => $programs
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'value' => 'required|numeric|min:0',
            'reason' => 'required|string|max:255'
        ]);

        // Asignar el user_id del usuario autenticado
        $validatedData['user_id'] = Auth::id();

        // Crear el gasto
        Expenses::create($validatedData);

        return redirect()->back()->with('success', 'Gasto registrado exitosamente');
    }
}
