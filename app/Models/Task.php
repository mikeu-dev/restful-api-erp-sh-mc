<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'priority',
    ];

    /** Relasi ke proyek */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /** Relasi ke karyawan yang ditugaskan */
    public function assignee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    /** Relasi ke komentar task */
    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    /** Scope untuk task berdasarkan status */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /** Scope untuk prioritas */
    public function scopePriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }
}
