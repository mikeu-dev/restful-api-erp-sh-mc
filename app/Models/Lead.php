<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
        'source',
        'status',
        'value',
        'assigned_to',
        'notes',
    ];

    protected $casts = [
        'value' => 'decimal:2',
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUALIFIED = 'qualified';
    public const STATUS_CONVERTED = 'converted';
    public const STATUS_LOST = 'lost';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assignedEmployee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function activities()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }
}
