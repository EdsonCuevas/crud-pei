<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminBeneficiariesController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $benef = User::where('role_id', '5')->with('programs:title')->get();
        $roles = Role::all();

        return Inertia::render('Admin/Users/Beneficiaries', [
            'beneficiarios' => $benef,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'password' => 'required|min:8',
            'phone' => ['required', 'digits_between:1,15'],
            'birthdate' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'), 'after_or_equal:1900-01-01'],
        ]);

        $benef = new User($request->except('password'));
        $benef->role_id = '5';
        $benef->password = Hash::make($request->password);
        $benef->birthdate = $request->birthdate;
        $benef->save();
        return redirect('admin-beneficiaries');
    }

    public function update(Request $request, User $admin_beneficiary)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => ['required', 'digits_between:1,15'],
            'role_id' => 'required',
            'password' => 'nullable|min:8',
            'birthdate' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d'), 'after_or_equal:1900-01-01'],
        ]);

        // Solo encripta la contraseña si fue proporcionada
        if ($request->filled('password')) {
            $request->merge(['password' => bcrypt($request->input('password'))]);
        } else {
            $request->request->remove('password');
        }

        $admin_beneficiary->update($request->all());
        $admin_beneficiary->birthdate = $request->birthdate; // Actualiza la fecha
        $admin_beneficiary->save();
        return redirect('admin-beneficiaries');
    }

    public function destroy(User $admin_beneficiary)
    {
        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        $admin_beneficiary->delete();
        return redirect('admin-beneficiaries');
    }
}
