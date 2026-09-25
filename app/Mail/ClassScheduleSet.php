<?php

namespace App\Mail;

use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassScheduleSet extends Mailable
{
    use Queueable, SerializesModels;

    public Enrollment $enrollment;
    public ClassSchedule $schedule;
    public string $teacherTimeFormatted;
    public ?string $studentTimeFormatted = null;

    public function __construct(Enrollment $enrollment, ClassSchedule $schedule)
    {
        $this->enrollment = $enrollment;
        $this->schedule = $schedule;

        // Build the class time in the teacher's chosen timezone
        $teacherDateTime = Carbon::parse($schedule->start_time, $schedule->timezone);
        $this->teacherTimeFormatted = $teacherDateTime->format('h:i A') . ' (' . $schedule->timezone . ')';

        // Convert to the student's timezone, if we have a valid one on file
        if ($enrollment->timezone) {
            try {
                $studentDateTime = $teacherDateTime->copy()->setTimezone($enrollment->timezone);
                $this->studentTimeFormatted = $studentDateTime->format('h:i A') . ' (' . $enrollment->timezone . ')';
            } catch (\Exception $e) {
                $this->studentTimeFormatted = null;
            }
        }
    }

    public function build()
    {
        return $this->subject('Your Class Schedule is Ready — Sadqia Quran Academy')
            ->view('emails.class-schedule-set');
    }
}