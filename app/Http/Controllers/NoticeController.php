<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function store(Request $request, Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $enrollment->teacher_id !== $user->id) {
            abort(403, 'You are not assigned to this student.');
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $validated['enrollment_id'] = $enrollment->id;
        $validated['created_by'] = $user->id;

        Notice::create($validated);

        return back()->with('success', 'Notice added.');
    }

    public function destroy(Notice $notice)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $notice->enrollment->teacher_id !== $user->id) {
            abort(403);
        }

        $notice->delete();

        return back()->with('success', 'Notice removed.');
    }
}