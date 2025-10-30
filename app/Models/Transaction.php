<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'project_id',
        'type',
        'amount',
        'description',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const TYPE_INCOME = 'income';
    public const TYPE_EXPENSE = 'expense';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeIncome($query)
    {
        return $query->where('type', self::TYPE_INCOME);
    }

    public function scopeExpense($query)
    {
        return $query->where('type', self::TYPE_EXPENSE);
    }
}
