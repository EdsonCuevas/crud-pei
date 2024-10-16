<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class DonorDonacionesController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 4) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $userId = Auth::id();

        $donaciones = Donation::where('users_id', $userId)
            ->with('proram')
            ->get();

        return Inertia::render('Donador/Donaciones/Index', [
            'donaciones' => $donaciones
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role->id !== 4) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }


        $programas = Program::all();

        return Inertia::render('Donador/Donaciones/Create', [
            'programas' => $programas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_number' => 'required|string',
            'program_id' => 'required|exists:programs,id',
        ]);

        $userId = Auth::id();

        // Crear la donación
        Donation::create([
            'value' => $request->input('amount'),
            'concept' => $request->input('transaction_number'),
            'programs_id' => $request->input('program_id'),
            'users_id' => $userId, // Suponiendo que tienes una relación con el usuario
        ]);

        return redirect()->route('donor-donations.index')->with('success', 'Donation created successfully.');
    }

    public function show(Donation $donor_donation)
    {
        $donor_donation->load(['proram', 'user']);

        return Inertia::render('Donador/Donaciones/View', [
            'donacion' => $donor_donation
        ]);
    }
}
