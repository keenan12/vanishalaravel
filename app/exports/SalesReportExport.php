<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;

class SalesReportExport implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles, WithEvents
{
    protected $month;
    protected $year;
    protected $monthName;

    /**
     * @param int $month
     * @param int $year
     * @param string $monthName
     */
    public function __construct(int $month, int $year, string $monthName)
    {
        $this->month = $month;
        $this->year = $year;
        $this->monthName = $monthName;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Sale::with('product')
            ->where('status', 'completed')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->orderBy('created_at', 'asc');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Produk',
            'Pembeli',
            'Qty',
            'Harga Satuan',
            'Total Harga',
        ];
    }

    /**
     * @param Sale $sale
     * @return array
     */
    protected $rowNumber = 0;

    public function map($sale): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $sale->created_at->format('d/m/Y H:i'),
            $sale->product->name,
            $sale->buyer_name ?? $sale->customer_name ?? 'Umum',
            $sale->quantity,
            $sale->product->price,
            $sale->total_price,
        ];
    }

    public function title(): string
    {
        return 'Laporan Penjualan ' . $this->monthName . ' ' . $this->year;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '667EEA'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                
                // Apply borders to all cells
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Center align specific columns
                $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // No
                $sheet->getStyle('B2:B' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Tanggal
                $sheet->getStyle('E2:E' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Qty

                // Right align price columns
                $sheet->getStyle('F2:G' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                // Format currency columns (Harga Satuan and Total Harga)
                $sheet->getStyle('F2:F' . $highestRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('G2:G' . $highestRow)->getNumberFormat()->setFormatCode('#,##0');

                // Add summary rows
                $summaryRow = $highestRow + 2;
                
                // Total Quantity
                $sheet->setCellValue('D' . $summaryRow, 'Total Kuantitas:');
                $sheet->setCellValue('E' . $summaryRow, '=SUM(E2:E' . $highestRow . ')');
                $sheet->getStyle('D' . $summaryRow . ':E' . $summaryRow)->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8ECEF'],
                    ],
                ]);

                // Total Revenue
                $summaryRow++;
                $sheet->setCellValue('D' . $summaryRow, 'TOTAL PENDAPATAN:');
                $sheet->setCellValue('G' . $summaryRow, '=SUM(G2:G' . $highestRow . ')');
                $sheet->getStyle('D' . $summaryRow . ':G' . $summaryRow)->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFD700'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                $sheet->getStyle('G' . $summaryRow)->getNumberFormat()->setFormatCode('#,##0');

                // Merge cells for summary labels
                $sheet->mergeCells('D' . ($summaryRow - 1) . ':D' . ($summaryRow - 1));
                $sheet->mergeCells('D' . $summaryRow . ':F' . $summaryRow);

                // Apply borders to summary
                $sheet->getStyle('D' . ($summaryRow - 1) . ':G' . $summaryRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Set row height for header
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Freeze header row
                $sheet->freezePane('A2');
            },
        ];
    }
}