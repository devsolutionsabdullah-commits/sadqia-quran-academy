<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'day_of_week',
        'start_time',
        'timezone',
        'last_reminder_sent_date',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}