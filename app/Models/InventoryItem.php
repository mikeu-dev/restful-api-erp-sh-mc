<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'sku',
        'quantity',
        'unit_price',
        'status',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_OUT_OF_STOCK = 'out_of_stock';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }
}
