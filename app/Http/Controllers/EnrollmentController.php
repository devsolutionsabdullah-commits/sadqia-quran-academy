<?php

namespace App\Http\Controllers;

use App\Mail\EnrollmentConfirmation;
use App\Mail\NewEnrollmentNotification;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    public function create()
    {
        $courses = Course::where('is_active', true)->get();
        $teachers = User::where('role', 'teacher')->get();

        return view('enroll-now', compact('courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'student_name' => ['required', 'string', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:4', 'max:80'],
            'gender' => ['nullable', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:255'],
            'timezone' => ['nullable', 'string', 'max:255'],
            'preferred_timing' => ['nullable', 'string', 'max:255'],
            'quran_experience' => ['nullable', 'string', 'max:255'],
            'preferred_teacher_id' => ['nullable', 'exists:users,id'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'message' => ['nullable', 'string'],
        ]);

        $validated['student_id'] = Auth::id();
        $validated['status'] = 'pending';

        $enrollment = Enrollment::create($validated);

        Mail::to('devsolutionsabdullah@gmail.com')->send(new NewEnrollmentNotification($enrollment));
        Mail::to(Auth::user()->email)->send(new EnrollmentConfirmation($enrollment));

        return redirect()->route('enroll-now')->with('success', 'JazakAllah Khair! Your enrollment request has been received.');
    }
}