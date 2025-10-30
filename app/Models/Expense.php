<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
     use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'amount',
        'account_id',
        'expense_date',
        'description',
    ];

    /** Relasi ke Company */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke Account */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
