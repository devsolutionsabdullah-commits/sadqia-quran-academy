<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeworkController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $enrollment->teacher_id !== $user->id) {
            abort(403, 'You are not assigned to this student.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png'],
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('homework-attachments', 'public');
        }

        Homework::create([
            'enrollment_id' => $enrollment->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'attachment_path' => $attachmentPath,
            'assigned_by' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Homework assigned.');
    }

    public function submit(Request $request, Homework $homework)
    {
        $user = Auth::user();

        if ($homework->enrollment->student_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'submission' => ['required', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png'],
        ]);

        $submissionPath = $request->file('submission')->store('homework-submissions', 'public');

        $homework->update([
            'submission_path' => $submissionPath,
            'submitted_at' => now(),
            'status' => 'submitted',
        ]);

        return back()->with('success', 'Homework submitted.');
    }

    public function destroy(Homework $homework)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $homework->enrollment->teacher_id !== $user->id) {
            abort(403);
        }

        if ($homework->attachment_path) {
            Storage::disk('public')->delete($homework->attachment_path);
        }
        if ($homework->submission_path) {
            Storage::disk('public')->delete($homework->submission_path);
        }

        $homework->delete();

        return back()->with('success', 'Homework removed.');
    }
}