<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /** Relasi ke Lead (jika diperlukan) */
    public function leads()
    {
        return $this->hasMany(Lead::class, 'status', 'name');
    }
}
