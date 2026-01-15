<?php

namespace App\Exports;

use App\Models\Pengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PengabdianExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Pengabdian::select(
            'judul',
            'bidang',
            'ketua_pengabdian',
            'anggota',
            'mahasiswa_dokumentasi',
            'tahun',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Bidang',
            'Ketua Pengabdian',
            'Anggota',
            'Mahasiswa',
            'Tahun',
            'Status'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $range   = 'A1:G' . $lastRow;

        /* ===============================
           HEADER: WARNA + TEBAL + TENGAH
           =============================== */
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'], // putih
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'], // biru elegan
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                ],
            ],
        ]);

        /* ===============================
           ISI DATA: GARIS TEBAL
           =============================== */
        $sheet->getStyle('A2:G' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Kolom Tahun & Status rata tengah
        $sheet->getStyle('F2:F' . $lastRow)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('G2:G' . $lastRow)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}
