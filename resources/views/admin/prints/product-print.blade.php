<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f3f4f6; border: 1px solid #d1d5db; padding: 10px; }
        .table td { border: 1px solid #d1d5db; padding: 8px; }
        .stok-low { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: #2563eb;">SIGUDANG - LAPORAN INVENTARIS PRODUK</h1>
        <p>Kondisi Stok Per Tanggal: {{ date('d F Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Supplier</th>
                <th width="10%">Stok</th>
                <th width="15%">Harga Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $product)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>PRO-{{ $product->id_product }}</td>
                <td>{{ $product->name_product }}</td>
                <td>{{ $product->supplier->nama_supplier ?? '-' }}</td>
                <td align="center" class="{{ $product->stock <= 5 ? 'stok-low' : '' }}">
                    {{ $product->stock }}
                </td>
                <td align="right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>