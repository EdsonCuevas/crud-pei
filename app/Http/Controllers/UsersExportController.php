<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

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
                'users.rfc',
                'users.birthdate',
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
            'RFC',
            'Birthdate',
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
                'startColor' => ['rgb' => '3399FF'], // Fondo verde
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
