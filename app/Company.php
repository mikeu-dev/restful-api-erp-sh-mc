<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'code',
        'tagline',
        'director',
        'phone',
        'logo',
        'address',
        'bank',
        'number',
    ];

    public function settings()
    {
        return $this->hasMany(CompanySetting::class);
    }

    public function getSetting(string $key, $default = null)
    {
        $setting = $this->settings()->where('key', $key)->first();
        return $setting ? json_decode($setting->value, true) : $default;
    }

    public function setSetting(string $key, $value)
    {
        return CompanySetting::updateOrCreate(
            ['company_id' => $this->id, 'key' => $key],
            ['value' => json_encode($value)]
        );
    }
}
