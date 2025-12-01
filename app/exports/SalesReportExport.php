<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromQuery; // Pastikan baris ini ada
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesReportExport implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
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
            '#',
            'Tanggal',
            'Nama Produk',
            'Harga Satuan',
            'Jumlah',
            'Total Harga',
        ];
    }

    /**
     * @param Sale $sale
     * @return array
     */
    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->created_at->format('d-m-Y H:i'),
            $sale->product->name,
            $sale->product->price,
            $sale->quantity,
            $sale->total_price,
        ];
    }

    public function title(): string
    {
        return 'Laporan Penjualan ' . $this->monthName . ' ' . $this->year;
    }
}