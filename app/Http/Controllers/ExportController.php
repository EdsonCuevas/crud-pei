<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsersExportController; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index()
    {
        return view('export');
    }

    public function export()
    {
        return Excel::download(new UsersExportController(), 'program_user.xlsx');
    }
}
