<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function issue(Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin()) {
            abort(403);
        }

        if (! $enrollment->certificate_number) {
            $enrollment->update([
                'completed_at' => now(),
                'certificate_number' => 'SQA-' . strtoupper(Str::random(8)),
                'progress_percentage' => 100,
            ]);
        }

        return back()->with('success', 'Certificate issued.');
    }

    public function show(Enrollment $enrollment)
    {
        $user = Auth::user();

        if (! $user->isAdmin() && $enrollment->student_id !== $user->id) {
            abort(403);
        }

        if (! $enrollment->certificate_number) {
            abort(404, 'No certificate has been issued for this enrollment yet.');
        }

        return view('certificate', compact('enrollment'));
    }
}