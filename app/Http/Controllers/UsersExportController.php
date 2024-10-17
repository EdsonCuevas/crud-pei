<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExportController implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return DB::table('program_user')
            ->join('programs', 'program_user.program_id', '=', 'programs.id')
            ->select(
                'program_user.id',
                'program_user.user_id',
                'programs.title as program_title',
                'programs.description as program_description',
                'program_user.created_at',
                'program_user.updated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Program Title',
            'Program Description',
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
