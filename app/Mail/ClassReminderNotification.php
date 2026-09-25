<?php

namespace App\Mail;

use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Enrollment $enrollment;
    public ClassSchedule $schedule;
    public string $recipientType; // 'student' or 'teacher'

    public function __construct(Enrollment $enrollment, ClassSchedule $schedule, string $recipientType)
    {
        $this->enrollment = $enrollment;
        $this->schedule = $schedule;
        $this->recipientType = $recipientType;
    }

    public function build()
    {
        return $this->subject('Your Class Starts in 30 Minutes — Sadqia Quran Academy')
            ->view('emails.class-reminder');
    }
}