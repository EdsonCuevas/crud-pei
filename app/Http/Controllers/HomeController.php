<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Program;

class HomeController extends Controller
{

    public function index()
    {
        $programas = Program::orderBy('created_at', 'desc')->take(6)->get();

        return Inertia::render('HomePage', [
            'programas' => $programas
        ]);
    }
}
