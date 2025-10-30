<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'location',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke stok produk */
    public function productStocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
