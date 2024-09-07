<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ContactoController extends Controller
{
    public function index()
    {
        
        $conta = User::where('role', 'conta')
            ->with('programs:name')
            ->get();

        return Inertia::render('./Pages/About', [
            'contactos' => $conta 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|max:20',
            'position' => 'required|max:60', 
            'schedule' => 'required|max:60', 
            'address' => 'required|max:100', 
        ]);

        $contactos = new User($request->except('password'));
        $contactos->role = 'conta';
        $contactos->password = Hash::make($request->password);
        $contactos->save();

        return redirect()->route('contacts');
    }

    public function update(Request $request, User $contactos)
    {
        $request->validate([
            'name' => 'required|max:60',
            'email' => 'required|email|max:60',
            'phone' => 'required|max:20',
            'position' => 'required|max:60', 
            'schedule' => 'required|max:60', 
            'address' => 'required|max:100', 
        ]);

        $contactos->update($request->all()); 
        
        return redirect()->route('contacts');
    }

    public function destroy(User $contactos)
    {
        $contactos->delete();

        return redirect()->route('contacts');
    }
}
