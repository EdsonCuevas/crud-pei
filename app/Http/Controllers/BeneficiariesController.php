<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class BeneficiariesController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $benef = User::where('role', 'benef')->with('programs:name')->get();

        return Inertia::render('Users/Beneficiaries', [
            'beneficiarios' => $benef
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
        ]);
        $benef = new User($request->except('password'));
        $benef->role = 'benef';
        $benef->password = Hash::make($request->password);
        $benef->save();
        return redirect('beneficiaries');
    }

    public function update(Request $request, User $beneficiary)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => 'required|max:20',
        ]);

        // Verifica si la contraseña está presente en el request antes de actualizarla
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $beneficiary->update($request->input());
        return redirect('beneficiaries');
    }

    public function destroy(User $beneficiary)
    {
        $beneficiary->delete();
        return redirect('beneficiaries');
    }
}
