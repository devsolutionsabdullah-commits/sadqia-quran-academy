<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function student()
    {
        $enrollments = Auth::user()->studentEnrollments()
            ->with(['course', 'teacher.teacherProfile', 'classSchedules', 'attendances', 'notices', 'fee', 'homework'])
            ->get();

        return view('dashboard.student', compact('enrollments'));
    }

    public function teacher()
    {
        $enrollments = Auth::user()->teacherEnrollments()
            ->with(['course', 'student', 'classSchedules', 'notices', 'homework'])
            ->get();

        return view('dashboard.teacher', compact('enrollments'));
    }

    public function admin()
    {
        $stats = [
            'total_students' => \App\Models\User::where('role', 'student')->count(),
            'total_teachers' => \App\Models\User::where('role', 'teacher')->count(),
            'total_courses' => \App\Models\Course::count(),
            'total_enrollments' => \App\Models\Enrollment::count(),
        ];

        return view('dashboard.admin', compact('stats'));
    }
}