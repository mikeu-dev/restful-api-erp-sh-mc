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

    protected $casts = [
        'clock_in'  => 'datetime',
        'clock_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Helper untuk menghitung durasi kerja
    public function getWorkDurationAttribute()
    {
        if (!$this->clock_out) return null;
        return $this->clock_out->diffInHours($this->clock_in);
    }
}
