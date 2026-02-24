<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $table = 'stock_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_product',
        'stock_before',
        'amount_added',
        'stock_after',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
