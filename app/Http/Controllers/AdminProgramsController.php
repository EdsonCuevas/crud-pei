<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminProgramsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        return Inertia::render('Admin/Programs/Index', [
            'programas' => Program::with(['creator', 'coordinator'])->paginate(10)
        ]);
    }

    public function pdf(){
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }
        
        $adminprogram = Program::all();
        $pdf = Pdf::loadView('programpdf', compact('adminprogram'));
        return $pdf->stream();
    }

    public function show(Program $admin_program)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

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
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $coordinators = User::where('role_id', 2)->get(['id', 'name']);
        $beneficiaries = User::where('role_id', 5)->get(['id', 'name']);

        return Inertia::render('Admin/Programs/Create', [
            'coordinators' => $coordinators,
            'users' => $beneficiaries
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'image' => 'required|file|mimes:png,jpg',
            'beneficiaries' => 'array'
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
        $program->users()->sync($request->beneficiaries);
        return redirect('admin-programs')->with('success', 'Programa Creado');
    }

    public function edit(Program $admin_program)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $coordinators = User::where('role_id', 2)->get(['id', 'name']);
        $beneficiaries = User::where('role_id', 5)->get(['id', 'name']);

        return Inertia::render('Admin/Programs/Edit', [
            'program' => $admin_program,
            'coordinators' => $coordinators,
            'users' => $beneficiaries,
            'benefsDelPrograma' => $admin_program->users
        ]);
    }

    public function updateProgram(Request $request)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:255',
            'id' => 'required|numeric',
            'beneficiaries' => 'array'
        ]);

        $program = Program::find($request->id);

        // Excluir el campo creator_id de los datos que se actualizarán
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
        return redirect('admin-programs')->with('success', 'Programa Actualizado');
    }


    public function destroy(Program $admin_program)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        Storage::disk('public')->delete('img/' . $admin_program->image);
        $admin_program->delete();
        return redirect('admin-programs')->with('success', 'Programa Eliminado');
    }
}
