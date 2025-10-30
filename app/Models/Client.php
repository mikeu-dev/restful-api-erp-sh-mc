<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'address',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke kontak tambahan */
    public function contacts()
    {
        return $this->hasMany(ClientContact::class);
    }

    /** Relasi ke catatan */
    public function notes()
    {
        return $this->hasMany(ClientNote::class);
    }
}
