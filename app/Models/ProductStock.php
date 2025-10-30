<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
    ];

    /** Relasi ke produk */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /** Relasi ke gudang */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
