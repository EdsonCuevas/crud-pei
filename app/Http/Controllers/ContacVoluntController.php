<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContacVoluntController extends Controller
{
    public function index()
    {
        // Filtra los usuarios que tengan el rol 'voluntario' y carga sus programas
        $user = User::where('role',  'coordi')->get();

        return Inertia::render('Volunt/IndexCont', [
            'users' => $user
        ]);
    }
}