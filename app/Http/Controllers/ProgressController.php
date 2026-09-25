<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function update(Request $request, Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $enrollment->teacher_id !== $user->id) {
            abort(403, 'You are not assigned to this student.');
        }

        $validated = $request->validate([
            'current_lesson' => ['nullable', 'string', 'max:255'],
            'progress_percentage' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $enrollment->update($validated);

        return back()->with('success', 'Progress updated.');
    }
}