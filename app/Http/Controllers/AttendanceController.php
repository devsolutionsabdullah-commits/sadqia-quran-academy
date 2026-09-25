<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $enrollment->teacher_id !== $user->id) {
            abort(403, 'You are not assigned to this student.');
        }

        $validated = $request->validate([
            'class_date' => ['required', 'date'],
            'status' => ['required', 'in:present,absent'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['enrollment_id'] = $enrollment->id;
        $validated['marked_by'] = $user->id;

        Attendance::create($validated);

        return back()->with('success', 'Attendance marked.');
    }

    public function destroy(Attendance $attendance)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $attendance->enrollment->teacher_id !== $user->id) {
            abort(403);
        }

        $attendance->delete();

        return back()->with('success', 'Attendance record removed.');
    }
}