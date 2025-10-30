<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'note',
    ];

    /** Relasi ke Client */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
