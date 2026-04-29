<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_session_id',
        'student_name',
        'student_id',
        'student_id_number',
        'status',
        'time_in',
        'present',
        'remarks',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(AttendanceSession::class, 'attendance_session_id');
    }
}
