<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{

    public function indexCoordi()
    {

        // Filtra los usuarios que tengan el rol 'coordi' y carga sus programas
        $coordis = User::where('role', 'coordi')->with('programs:name')->get();

        return Inertia::render('Users/Coordinators/Index', [
            'coordinadores' => $coordis
        ]);
    }
}
