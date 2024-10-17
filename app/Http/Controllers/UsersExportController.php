<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromColleccion;


class UsersExportController implements FromColleccion
{
    @return Illuminate\Support\Collection

    public function collection()
    {
        return User::all();
    }  
}
