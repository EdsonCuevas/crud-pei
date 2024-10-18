<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsersExportController;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($roleId)
    {
        return Excel::download(new UsersExportController($roleId), 'users_role_' . $roleId . '.xlsx');
    }
}
