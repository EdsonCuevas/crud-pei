<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BeneficiariosController extends Controller
{

    public function index()
    {
        // Filtra los usuarios que tengan el rol 'benefi' y carga sus programas
        $benefis = User::where('role', 'benefi')->with('programs:name')->get();

        return Inertia::render('Users/Coordinators/beneficiarios/benefi', [
            'beneficiarios' => $benefis
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
        $beneficiarios = new User($request->except('password'));
        $beneficiarios->role = 'benefi';
        $beneficiarios->password = Hash::make($request->password);
        $beneficiarios->save();
        return redirect('beneficiaries');
    }

    public function update(Request $request, User $beneficiarios)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|max:60',
            'phone' => 'required|max:20',
        ]);

        $beneficiarios->update($request->input());
        return redirect('beneficiaries');
    }

    public function destroy(User $beneficiarios)
    {
        $beneficiarios->delete();
        return redirect('beneficiaries');
    }
}
