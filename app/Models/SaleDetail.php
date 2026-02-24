<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id',
        'id_product',
        'qty',
        'price_at_sale'
    ];

    /**
     * Relasi ke data transaksi utama
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Relasi ke data produk terkait
     */
    public function product(): BelongsTo
    {
        // Parameter ke-2 adalah foreign key di tabel ini, ke-3 adalah primary key di tabel products
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
