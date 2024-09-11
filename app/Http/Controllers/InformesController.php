<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformesController extends Controller
{

    public function index()
    {
        $informes = User::where('role', 'voluntario')->with('programs:name')->get();

        return Inertia::render('Users/Donador/informes', [
            'informes' => $informes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255', // Asume campos como título para un informe
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]);
        $informe = new Informe($request->all());
        $informe->save();
        return redirect('informes');
    }

    public function update(Request $request, Informe $informe)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]);

        $informe->update($request->input());
        return redirect('informes');
    }

    public function destroy(Informe $informe)
    {
        $informe->delete();
        return redirect('informes');
    }
}
