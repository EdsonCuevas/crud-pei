<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class UsersExportController implements FromCollection, WithHeadings, WithStyles
{
    protected $roleId;

    public function __construct($roleId)
    {
        $this->roleId = $roleId;
    }

    public function collection()
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select(
                'roles.role as role_name',
                'users.name',
                'users.email',
                'users.phone',
                'users.created_at',
                'users.updated_at'
            )
            ->where('users.role_id', $this->roleId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Role',
            'Name',
            'Email',
            'Phone',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], 
        ];
    }
}
