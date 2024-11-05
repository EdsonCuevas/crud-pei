<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Program;
use App\Models\User;
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

        $expenses = Expenses::where('user_id', $userId)
            ->with('program')
            ->get();

        // Pass the retrieved data to the Inertia view
        return Inertia::render('Volunt/Index', [
            'expenses' => $expenses
        ]);
    }
}
