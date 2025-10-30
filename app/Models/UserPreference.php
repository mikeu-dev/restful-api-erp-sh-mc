<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language',
        'theme',
        'timezone',
        'notifications_enabled',
        'settings',
    ];

    protected $casts = [
        'notifications_enabled' => 'boolean',
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
