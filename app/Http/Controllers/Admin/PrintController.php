<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mpdf\Mpdf;

class PrintController extends Controller
{
    /**
     */
    private function generatePdf($view, $data, $filename)
    {
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 15,
            'margin_bottom' => 15,
            'margin_left' => 15,
            'margin_right' => 15,
            'default_font' => 'helvetica',
            'tempDir' => storage_path('app/public') 
        ]);

        $html = view($view, $data)->render();
        
        $mpdf->WriteHTML($html);
        
        return $mpdf->Output($filename, 'I');
    }

    /**
     */
    public function printProducts(Request $request)
    {
        $query = Product::with('supplier');

        if ($request->filled(['start_date', 'end_date'])) {
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
            $period = $start->format('d/m/Y') . " - " . $end->format('d/m/Y');
        } else {
            $period = "Seluruh Data Produk";
        }

        return $this->generatePdf('admin.prints.product-print', [
            'data' => $query->get(),
            'title' => 'LAPORAN DAFTAR PRODUK GUDANG',
            'period' => $period
        ], 'Laporan-Produk.pdf');
    }

    /**
     * Laporan Stok Masuk
     */
    public function printIncoming(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $data = StockLog::with('product')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return $this->generatePdf('admin.prints.incoming-print', [
            'data' => $data,
            'title' => 'LAPORAN RIWAYAT STOK MASUK',
            'period' => $start->format('d/m/Y') . " - " . $end->format('d/m/Y')
        ], "Laporan-Stok-Masuk.pdf");
    }

    /**
     */
    public function printSales(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $data = Sale::with(['user', 'details.product'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return $this->generatePdf('admin.prints.sale-print', [
            'data' => $data,
            'title' => 'LAPORAN TRANSAKSI PENJUALAN',
            'period' => $start->format('d/m/Y') . " - " . $end->format('d/m/Y')
        ], "Laporan-Penjualan.pdf");
    }
}