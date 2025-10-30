<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'inventory_item_id',
        'serial_number',
        'purchase_date',
        'warranty_expiry',
        'assigned_to',
        'status',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_IN_REPAIR = 'in_repair';
    public const STATUS_RETIRED = 'retired';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function maintenances()
    {
        return $this->hasMany(AssetMaintenance::class);
    }
}
