<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MyInfoController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 5) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        return Inertia::render('Benef/MyInfo');
    }
}
