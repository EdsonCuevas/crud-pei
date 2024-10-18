<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgramsExportController implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return DB::table('programs')
            ->join('users as creators', 'programs.creator_id', '=', 'creators.id')
            ->join('users as coordinators', 'programs.coordi_id', '=', 'coordinators.id')
            ->select(
                'programs.title',
                'programs.description',
                'creators.name as creator_name',  // Nombre del creador
                'coordinators.name as coordinator_name',  // Nombre del coordinador
                'programs.created_at',
                'programs.updated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Program Title',
            'Description',
            'Creator',
            'Coordinator',
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
