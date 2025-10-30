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

    /** Relasi ke perusahaan */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke data gaji */
    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    /** Relasi ke data cuti / izin */
    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class);
    }

    /** Relasi ke kehadiran */
    public function attendances()
    {
        return $this->hasMany(EmployeeAttendance::class);
    }

    /** Ambil gaji aktif (terbaru berdasarkan tanggal efektif) */
    public function currentSalary()
    {
        return $this->hasOne(EmployeeSalary::class)->latestOfMany('effective_from');
    }
}
