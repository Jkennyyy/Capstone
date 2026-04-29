<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'course_id',
        'room',
        'date',
        'started_at',
        'ended_at',
        'status',
        'remarks',
        'created_by',
    ];

    public function records(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }

    public function classroom()
    {
        return $this->belongsTo(\App\Models\Classroom::class, 'classroom_id');
    }

    public function schedule()
    {
        return $this->belongsTo(\App\Models\Schedule::class, 'schedule_id');
    }
}
