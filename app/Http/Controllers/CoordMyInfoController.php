<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CoordMyInfoController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        return Inertia::render('PanelCoordi/MyInfo');
    }
}
