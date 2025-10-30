<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'clock_in',
        'clock_out',
    ];

    /** Relasi ke karyawan */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /** Hitung total jam kerja */
    public function getTotalHoursAttribute()
    {
        if (!$this->clock_out) return null;

        $in = \Carbon\Carbon::parse($this->clock_in);
        $out = \Carbon\Carbon::parse($this->clock_out);

        return round($in->diffInMinutes($out) / 60, 2);
    }
}
