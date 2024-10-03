<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class VoluntProgramsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 3) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Retrieve all records from the 'programs' table
        $programs = Program::all();

        // Pass the retrieved data to the Inertia view
        return Inertia::render('Volunt/Index', [
            'programs' => $programs
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
        ]);
        $volunt = new User($request->except('password'));
        $volunt->role = 'voluntario';
        $volunt->password = Hash::make($request->password);
        $volunt->save();
        return redirect('volunt');
    }

    public function update(Request $request, User $volunt)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'phone' => 'required|max:20',
        ]);

        $volunt->update($request->input());
        return redirect('volunt');
    }
}
