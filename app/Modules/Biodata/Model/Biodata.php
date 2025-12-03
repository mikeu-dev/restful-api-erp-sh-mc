<?php

namespace App\Modules\Biodata\Model;

use App\Modules\Religion\Model\Religion;
use App\Modules\User\Model\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biodata extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'pob',
        'dob',
        'gender',
        'user_id',
        'religion_id'
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
}
