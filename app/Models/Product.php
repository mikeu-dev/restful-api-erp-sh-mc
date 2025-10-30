<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'sku',
        'category_id',
        'price',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke Kategori */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /** Relasi ke stok */
    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    /** Hitung total stok semua gudang */
    public function getTotalStockAttribute()
    {
        return $this->stocks->sum('quantity');
    }
}
