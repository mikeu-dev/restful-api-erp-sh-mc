<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
        'created_by',
        'title',
        'description',
        'status',
        'priority',
    ];

    /** Relasi ke perusahaan */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke client (pelapor) */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /** Relasi ke user pembuat tiket */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Relasi ke pesan dalam tiket */
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    /** (Opsional) relasi ke master status jika digunakan */
    public function statusMaster()
    {
        return $this->belongsTo(TicketStatus::class, 'status', 'name');
    }

    /** (Opsional) relasi ke master prioritas jika digunakan */
    public function priorityMaster()
    {
        return $this->belongsTo(TicketPriority::class, 'priority', 'name');
    }
}
