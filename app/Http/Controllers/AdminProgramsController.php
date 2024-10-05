<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\User;

class AdminProgramsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
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

    public function create()
    {
        $coordinators = User::where('role_id', 2)->get(['id', 'name']);

        return Inertia::render('Admin/Programs/Create', [
            'programas' => Program::all(),
            'coordinators' => $coordinators
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'image' => 'required|file|mimes:png,jpg',
        ]);

        // Obtén el ID del usuario logueado
        $userId = Auth::id();

        // Crea el programa con los datos del request, incluyendo el creator_id
        $program = Program::create(array_merge($request->all(), ['creator_id' => $userId]));
        if ($request->hasFile('image')) {
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/img', $imgName);
            $program->image = $imgName;
            $program->save();
        }
        return redirect('admin-programs')->with('success', 'Programa Creado');
    }

    public function edit(Program $admin_program)
    {
        return Inertia::render('Admin/Programs/Edit', [
            'programas' => Program::all(),
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
