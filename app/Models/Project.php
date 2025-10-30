<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'start_date',
        'end_date',
    ];

    /** Relasi ke perusahaan */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** Relasi ke task-task dalam proyek */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /** Hitung jumlah task selesai */
    public function getCompletedTasksCountAttribute()
    {
        return $this->tasks()->where('status', 'done')->count();
    }

    /** Hitung progres proyek (persentase task selesai) */
    public function getProgressAttribute()
    {
        $total = $this->tasks()->count();
        if ($total === 0) return 0;

        $done = $this->tasks()->where('status', 'done')->count();
        return round(($done / $total) * 100, 2);
    }
}
