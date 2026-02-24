<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        /* Sama dengan CSS di atas, tambahkan sesuai kebutuhan */
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f3f4f6; border: 1px solid #d1d5db; padding: 10px; }
        .table td { border: 1px solid #d1d5db; padding: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: #059669;">SIGUDANG - LAPORAN STOK MASUK</h1>
        <p>Periode: {{ $period }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Stok Awal</th>
                <th>Jumlah Masuk</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $log)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->product->name_product }}</td>
                <td align="center">{{ $log->stock_before }}</td>
                <td align="center" style="font-weight: bold; color: #059669;">+{{ $log->amount_added }}</td>
                <td align="center">{{ $log->stock_after }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>