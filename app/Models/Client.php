<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'address',
        'website',
        'industry',
        'status',
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_PROSPECT = 'prospect';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contacts()
    {
        return $this->hasMany(ClientContact::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
