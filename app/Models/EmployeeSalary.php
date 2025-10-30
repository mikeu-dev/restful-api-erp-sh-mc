<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'salary',
        'effective_from',
    ];

    /** Relasi ke karyawan */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
