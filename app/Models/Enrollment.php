<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
    'course_id',
    'teacher_id',
    'status',
    'enrolled_at',
    'student_name',
    'parent_name',
    'age',
    'country',
    'timezone',
    'preferred_timing',
    'whatsapp_number',
    'message',
    'current_lesson',
    'progress_percentage',
    'completed_at',
    'certificate_number',
    ];

    protected function casts(): array
    {
        return [
            'enrolled_at' => 'datetime',
        ];
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function fee()
    {
        return $this->hasOne(Fee::class);
    }
    public function homework()
    {
        return $this->hasMany(Homework::class);
    }
}