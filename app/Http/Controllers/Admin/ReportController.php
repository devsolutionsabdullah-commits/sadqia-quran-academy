<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Fee;
use App\Models\Homework;

class ReportController extends Controller
{
    public function index()
    {
        // Enrollments overview
        $totalEnrollments = Enrollment::count();
        $activeEnrollments = Enrollment::where('status', 'active')->count();
        $pendingEnrollments = Enrollment::where('status', 'pending')->count();
        $completedEnrollments = Enrollment::whereNotNull('certificate_number')->count();

        $enrollmentsByCourse = Enrollment::selectRaw('course_id, count(*) as total')
            ->with('course')
            ->groupBy('course_id')
            ->get();

        // Fees overview
        $totalCollected = Fee::where('status', 'paid')->sum('amount');
        $totalPending = Fee::where('status', 'pending')->sum('amount');
        $paidCount = Fee::where('status', 'paid')->count();
        $pendingCount = Fee::where('status', 'pending')->count();

        // Attendance overview
        $totalAttendanceRecords = Attendance::count();
        $presentCount = Attendance::where('status', 'present')->count();
        $absentCount = Attendance::where('status', 'absent')->count();
        $overallAttendanceRate = $totalAttendanceRecords > 0
            ? round(($presentCount / $totalAttendanceRecords) * 100)
            : 0;

        // Homework overview
        $totalHomework = Homework::count();
        $submittedHomework = Homework::where('status', 'submitted')->count();
        $pendingHomework = Homework::where('status', 'pending')->count();
        $submissionRate = $totalHomework > 0
            ? round(($submittedHomework / $totalHomework) * 100)
            : 0;

        return view('admin.reports', compact(
            'totalEnrollments', 'activeEnrollments', 'pendingEnrollments', 'completedEnrollments',
            'enrollmentsByCourse',
            'totalCollected', 'totalPending', 'paidCount', 'pendingCount',
            'totalAttendanceRecords', 'presentCount', 'absentCount', 'overallAttendanceRate',
            'totalHomework', 'submittedHomework', 'pendingHomework', 'submissionRate'
        ));
    }
}