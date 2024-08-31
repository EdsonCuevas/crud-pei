<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{

    public function indexCoordi()
    {

        // Filtra los usuarios que tengan el rol coordi
        $coordis = User::where('role', 'coordi')->get();

        return Inertia::render('Users/Coordinators/Index', [
            'coordinadores' => $coordis
        ]);
    }
}
