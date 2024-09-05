<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VoluntController extends Controller
{

    public function index()
    {
        // Filtra los usuarios que tengan el rol 'voluntario' y carga sus programas
        $volunt = User::where('role', 'voluntarios')->with('programs:name')->get();

        return Inertia::render('Users/Volunt/Index', [
            'voluntarios' => $volunt
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

    public function destroy(User $volunt)
    {
        $volunt->delete();
        return redirect('volunt');
    }
}