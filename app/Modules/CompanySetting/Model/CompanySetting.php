<?php

namespace App\Modules\CompanySetting\Model;

use App\Modules\Company\Model\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'key',
        'value',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
