<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importar Auth


class CoordReportsController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 2) {
            return redirect()->route('401')->with('error', 'No tienes acceso a esta página.');
        }

        return Inertia::render("PanelCoordi/Reports");
    }
}
