<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BenefContactsController extends Controller
{
    public function index()
    {

        $contacts = User::where('role', 'volunt')->get();

        return Inertia::render('Benef/Contactos', [
            'contactos' => $contacts
        ]);
    }
}
