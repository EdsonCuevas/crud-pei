<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContactsController extends Controller
{
    public function index()
    {
        
        $contacts = User::where('role', 'volunt')->get();

        return Inertia::render('About', [
            'contactos' => $contacts 
        ]);
    }

    
}
