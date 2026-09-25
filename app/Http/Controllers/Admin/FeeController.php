<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:paid,pending'],
            'due_date' => ['nullable', 'date'],
        ]);

        if ($validated['status'] === 'paid') {
            $validated['paid_date'] = now();
        }

        Fee::updateOrCreate(
            ['enrollment_id' => $enrollment->id],
            $validated
        );

        return back()->with('success', 'Fee record updated.');
    }
}