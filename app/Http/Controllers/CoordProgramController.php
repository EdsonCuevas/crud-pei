<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Program;
use App\Models\User;

class CoordProgramController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        // Obtener todos los programas asignados al coordinador logueado
        $userId = Auth::id();
        $programs = Program::where('coordi_id', $userId)
            ->with(['creator', 'coordinator'])
            ->get();

        return Inertia::render("PanelCoordi/Programs/Index", [
            "Programas" => $programs,
        ]);
    }

    public function show(Program $program)
    {
        $user = Auth::user();

        if ($user->role->id !== 2 || $program->coordi_id !== $user->id) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $program->load(['creator', 'coordinator']);

        return Inertia::render('PanelCoordi/Programs/Show', [
            'program' => $program,
            'creator' => $program->creator,
            'coordinator' => $program->coordinator,
            'users' => $program->users,
        ]);
    }

    public function edit(Program $program)
    {
        $user = Auth::user();

        if ($user->role->id !== 2 || $program->coordi_id !== $user->id) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $coordinators = User::where('role_id', 2)->get(['id', 'name']);
        $beneficiaries = User::where('role_id', 5)->get(['id', 'name']);

        return Inertia::render('PanelCoordi/Programs/Edit', [
            'program' => $program,
            'coordinators' => $coordinators,
            'users' => $beneficiaries,
            'benefsDelPrograma' => $program->users,
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $user = Auth::user();

        if ($user->role->id !== 2 || $program->coordi_id !== $user->id) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'beneficiaries' => 'array',
        ]);

        // Actualizar el programa
        $data = $request->except('creator_id');
        $program->update($data);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('img/' . $program->image);
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/img', $imgName);
            $program->image = $imgName;
            $program->save();
        }

        $program->users()->sync($request->beneficiaries);
        return redirect()->route('coord-programs.index')->with('success', 'Programa Actualizado');
    }
}
