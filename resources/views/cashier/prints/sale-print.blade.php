<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; color: #4f46e5; }
        .header p { margin: 2px 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f3f4f6; color: #374151; font-weight: bold; padding: 10px; border: 1px solid #d1d5db; text-align: left; }
        .table td { padding: 8px; border: 1px solid #d1d5db; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: right; font-style: italic; font-size: 10px; }
        .total-row { background-color: #f9fafb; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIGUDANG - LAPORAN PENJUALAN</h1>
        <p>Jl. Raya Telang, PO Box. 2 Kamal, Bangkalan - Madura</p>
        <p>Email: support@sigudang.com | Website: www.sigudang.com</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="50%"><strong>Periode:</strong> {{ $period }}</td>
            <td width="50%" class="text-right"><strong>Tanggal Cetak:</strong> {{ date('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>No. Invoice</th>
                <th>Tanggal</th>
                <th>Nama Kasir</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($data as $sale)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $sale->invoice_number }}</td>
                <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $sale->user->name }}</td>
                <td class="text-right">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
            </tr>
            @php $grandTotal += $sale->total_price; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem SiGudang pada {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>