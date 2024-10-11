<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Donation;
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

        return Inertia::render('Donador/Donaciones/Create');
    }

    public function show(Donation $donor_donation)
    {
        $donor_donation->load(['proram']);

        return Inertia::render('Donador/Donaciones/View', [
            'donacion'=>$donor_donation
        ]);
    }
}
