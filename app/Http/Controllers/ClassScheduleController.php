<?php

namespace App\Http\Controllers;

use App\Mail\ClassScheduleSet;
use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClassScheduleController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        if ($enrollment->teacher_id !== Auth::id()) {
            abort(403, 'You are not assigned to this student.');
        }

        $validated = $request->validate([
            'day_of_week' => ['required', 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'start_time' => ['required', 'date_format:H:i'],
            'timezone' => ['required', 'string', 'max:255'],
        ]);

        $validated['enrollment_id'] = $enrollment->id;

        $schedule = ClassSchedule::create($validated);

        Mail::to($enrollment->student->email)->send(new ClassScheduleSet($enrollment->fresh(['student', 'teacher', 'course']), $schedule));

        return back()->with('success', 'Class schedule added.');
    }

    public function destroy(ClassSchedule $classSchedule)
    {
        if ($classSchedule->enrollment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $classSchedule->delete();

        return back()->with('success', 'Schedule removed.');
    }
}