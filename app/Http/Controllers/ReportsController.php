<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return Inertia::render("PanelCoordi/Reports");
    }
}
