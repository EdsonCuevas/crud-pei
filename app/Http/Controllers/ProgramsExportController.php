<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProgramsExportController implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Program::with(['creator', 'coordinator', 'users'])  // Cargar las relaciones
            ->get()
            ->map(function ($program) {
                return [
                    'title' => $program->title,
                    'creator_name' => $program->creator ? $program->creator->name : 'N/A',
                    'coordinator_name' => $program->coordinator ? $program->coordinator->name : 'N/A',
                    'users' => $program->users->pluck('name')->join(', '),  // Listar los nombres de los usuarios
                    'created_at' => $program->created_at,
                    'updated_at' => $program->updated_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Program Title',
            'Creator',
            'Coordinator',
            'Beneficiaries',  // Columna para los usuarios
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
