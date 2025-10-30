<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /** Relasi ke pengaturan perusahaan */
    public function settings()
    {
        return $this->hasMany(CompanySetting::class);
    }

    /** Relasi ke user */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /** Ambil setting tertentu dengan key */
    public function getSetting(string $key, $default = null)
    {
        return optional($this->settings->where('key', $key)->first())->value ?? $default;
    }
}
