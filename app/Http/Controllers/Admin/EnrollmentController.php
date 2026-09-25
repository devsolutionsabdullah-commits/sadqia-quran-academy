<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherAssignedNotification;
use App\Mail\TeacherAssignedToTeacherNotification;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
   public function index()
{
    $enrollments = Enrollment::with(['student', 'course', 'teacher', 'fee'])->latest()->get();
    $teachers = User::where('role', 'teacher')->get();

    return view('admin.enrollments.index', compact('enrollments', 'teachers'));
}

    public function assign(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'teacher_id' => ['required', 'exists:users,id'],
        ]);

        $enrollment->update([
            'teacher_id' => $validated['teacher_id'],
            'status' => 'active',
            'enrolled_at' => now(),
        ]);

        $fresh = $enrollment->fresh(['student', 'course', 'teacher']);

        Mail::to($fresh->student->email)->send(new TeacherAssignedNotification($fresh));
        Mail::to($fresh->teacher->email)->send(new TeacherAssignedToTeacherNotification($fresh));

        return back()->with('success', 'Teacher assigned.');
    }
}