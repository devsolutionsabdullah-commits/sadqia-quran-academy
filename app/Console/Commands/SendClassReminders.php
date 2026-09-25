<?php

namespace App\Console\Commands;

use App\Mail\ClassReminderNotification;
use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendClassReminders extends Command
{
    protected $signature = 'classes:send-reminders';
    protected $description = 'Send email reminders 30 minutes before each scheduled class';

    public function handle()
    {
        $schedules = ClassSchedule::with(['enrollment.student', 'enrollment.teacher', 'enrollment.course'])
            ->whereHas('enrollment', function ($q) {
                $q->where('status', 'active');
            })
            ->get();

        $sent = 0;

        foreach ($schedules as $schedule) {
            // Figure out the next occurrence of this class in the teacher's timezone
            $now = Carbon::now($schedule->timezone);
            $classDateTime = Carbon::parse('this ' . $schedule->day_of_week, $schedule->timezone)
                ->setTimeFromTimeString($schedule->start_time);

            // If that time already passed today, roll forward to next week
            if ($classDateTime->lessThan($now)) {
                $classDateTime->addWeek();
            }

            $minutesUntilClass = $now->diffInMinutes($classDateTime, false);

            // Only send when class is 25-30 minutes away, and not already sent today
            $today = $now->toDateString();
            $alreadySent = $schedule->last_reminder_sent_date === $today;

            if ($minutesUntilClass >= 25 && $minutesUntilClass <= 30 && ! $alreadySent) {
                $enrollment = $schedule->enrollment;

                Mail::to($enrollment->student->email)
                    ->send(new ClassReminderNotification($enrollment, $schedule, 'student'));

                Mail::to($enrollment->teacher->email)
                    ->send(new ClassReminderNotification($enrollment, $schedule, 'teacher'));

                $schedule->update(['last_reminder_sent_date' => $today]);
                $sent++;
            }
        }

        $this->info("Reminders sent: {$sent}");
    }
}