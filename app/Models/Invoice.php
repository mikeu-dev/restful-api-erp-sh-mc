<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'total',
        'status',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke Client */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /** Relasi ke Item */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /** Relasi ke Pembayaran */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /** Hitung total dari item secara otomatis */
    public function calculateTotal()
    {
        return $this->items->sum('total');
    }
}
