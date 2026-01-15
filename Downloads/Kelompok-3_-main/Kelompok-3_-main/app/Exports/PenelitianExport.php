<?php

namespace App\Exports;

use App\Models\Penelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PenelitianExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize,
    WithCustomStartCell
{
    /* ======================
       DATA
       ====================== */
    public function collection()
    {
        return Penelitian::select(
            'judul',
            'bidang',
            'ketua_manual',
            'peneliti',
            'mahasiswa_dok',
            'tahun',
            'status'
        )->get();
    }

    /* ======================
       HEADER KOLOM
       ====================== */
    public function headings(): array
    {
        return [
            'Judul Penelitian',
            'Bidang',
            'Ketua Penelitian',
            'Anggota Peneliti',
            'Mahasiswa Dokumentasi',
            'Tahun',
            'Status'
        ];
    }

    /* ======================
       MULAI DARI BARIS KE-3
       ====================== */
    public function startCell(): string
    {
        return 'A3';
    }

    /* ======================
       STYLING TOTAL
       ====================== */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        /* ===== JUDUL BESAR ===== */
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'DATA PENELITIAN DOSEN');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E40AF'], // Biru tua
            ],
        ]);

        /* ===== HEADER TABEL ===== */
        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2563EB'], // Biru
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                ],
            ],
        ]);

        /* ===== ISI DATA ===== */
        $sheet->getStyle('A4:G' . $lastRow)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THICK,
                ],
            ],
        ]);

        // Tengah untuk Tahun & Status
        $sheet->getStyle('F4:F' . $lastRow)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('G4:G' . $lastRow)
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }
}
