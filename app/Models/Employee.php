<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'position',
        'hired_at',
    ];

    protected $casts = [
        'hired_at' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class);
    }

    public function attendance()
    {
        return $this->hasMany(EmployeeAttendance::class);
    }
}
