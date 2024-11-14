<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BenefMyResourcesController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 5) {
            return redirect()->route('401');
        }

        $programs = $user->programs()->with('coordinator')->get();

        return Inertia::render('Benef/MyPrograms', [
            'programas' => $programs
        ]);
    }
}
