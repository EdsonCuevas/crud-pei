<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Inertia\Inertia;

class MyInfoController extends Controller
{

    public function index()
    {
        return Inertia::render('Benef/MyInfo');
    }
}
