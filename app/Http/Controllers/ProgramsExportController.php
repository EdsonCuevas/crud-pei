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
        return Program::with(['creator', 'coordinator', 'users'])
            ->get()
            ->map(function ($program) {
                return [
                    'title' => $program->title,
                    'creator_name' => $program->creator ? $program->creator->name : 'N/A',
                    'coordinator_name' => $program->coordinator ? $program->coordinator->name : 'N/A',
                    'users' => $program->users->pluck('name')->join(', '),
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
            'Beneficiaries',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Obtener la última fila y columna
        $highestRow = $sheet->getHighestRow(); // Última fila con datos
        $highestColumn = $sheet->getHighestColumn(); // Última columna con datos
    
        // Aplicar estilo a la fila de encabezados
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4CAF50'], // Fondo verde
            ],
        ]);
    
        // Aplicar bordes a toda la tabla
        $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    
        // Ajustar tamaño de las columnas automáticamente
        foreach (range('A', $highestColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}    