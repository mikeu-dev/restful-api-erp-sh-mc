<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'lead_id',
        'title',
        'value',
        'stage',
        'expected_close_date',
        'closed_at',
        'status',
    ];

    protected $casts = [
        'expected_close_date' => 'date',
        'closed_at' => 'date',
        'value' => 'decimal:2',
    ];

    public const STATUS_OPEN = 'open';
    public const STATUS_WON = 'won';
    public const STATUS_LOST = 'lost';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function activities()
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }
}
