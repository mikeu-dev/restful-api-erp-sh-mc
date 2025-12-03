<?php

namespace App\Modules\Religion\Model;

use App\Modules\Biodata\Model\Biodata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Religion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
}
