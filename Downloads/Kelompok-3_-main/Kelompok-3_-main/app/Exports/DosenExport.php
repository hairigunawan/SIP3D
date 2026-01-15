<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DosenExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    /**
     * Ambil data dari tabel dosen
     */
    public function collection()
    {
        return Dosen::select('nidn', 'nama', 'email', 'fakultas', 'prodi', 'status')->get();
    }

    /**
     * Header kolom
     */
    public function headings(): array
    {
        return [
            'NIDN',
            'Nama',
            'Email',
            'Fakultas',
            'Prodi',
            'Status',
        ];
    }

    /**
     * Styling lembar Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Judul (baris header)
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getFont()->setSize(12);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:F1')->getFill()
              ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
              ->getStartColor()->setARGB('FFCCE5FF'); // warna biru lembut

        // Border seluruh data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:F{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF808080'],
                ],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Ubah tinggi baris agar lebih proporsional
        for ($i = 1; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(22);
        }

        return [];
    }

    /**
     * Nama sheet di file Excel
     */
    public function title(): string
    {
        return 'Data Dosen';
    }
}
