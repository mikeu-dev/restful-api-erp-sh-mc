<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'type',
        'balance',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke transaksi */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /** Relasi ke pembayaran */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /** Relasi ke pengeluaran */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
