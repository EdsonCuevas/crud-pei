<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BenefContactsController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 5) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        $contacts = User::whereIn('role_id', [2, 3])->with('role')->get();


        return Inertia::render('Benef/Contactos', [
            'contactos' => $contacts
        ]);
    }
}
