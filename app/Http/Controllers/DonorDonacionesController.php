<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DonorDonacionesController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 4) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $voluntarios = User::where('role', 'voluntario')->with('programs:title')->get();

        return Inertia::render('Donador/Donaciones', [
            'voluntarios' => $voluntarios
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
        $voluntario = new User($request->except('password'));
        $voluntario->role = 'voluntario';
        $voluntario->password = Hash::make($request->password);
        $voluntario->save();
        return redirect('voluntarios');
    }

    public function update(Request $request, User $voluntario)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'phone' => 'required|max:20',
        ]);

        $voluntario->update($request->input());
        return redirect('voluntarios');
    }

    public function destroy(User $voluntario)
    {
        $voluntario->delete();
        return redirect('voluntarios');
    }
}
