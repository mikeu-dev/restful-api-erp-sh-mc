<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
    ];

    /** Relasi ke tiket */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /** Relasi ke user pengirim pesan */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
