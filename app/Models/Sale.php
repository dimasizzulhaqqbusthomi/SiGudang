<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'invoice_number',
        'total_price',
        'user_id'
    ];

    /**
     * Menghubungkan ke detail produk yang dibeli
     */
    public function details(): HasMany
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }

    /**
     * Menghubungkan ke Kasir (User) yang melakukan transaksi
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}