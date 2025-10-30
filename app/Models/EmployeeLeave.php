<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
     use HasFactory;

    protected $fillable = [
        'employee_id',
        'type',
        'start_date',
        'end_date',
        'reason',
    ];

    /** Relasi ke karyawan */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /** Hitung durasi cuti (hari) */
    public function getDurationAttribute()
    {
        return \Carbon\Carbon::parse($this->start_date)
            ->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1;
    }
}
