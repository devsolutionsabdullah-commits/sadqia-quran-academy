<?php

namespace App\Http\Controllers;

use App\Models\TeacherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherProfileController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $validated = $request->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        $teacher = Auth::user();
        $profile = $teacher->teacherProfile;

        $photoPath = $profile?->photo_path;
        if ($photoPath) {
            Storage::disk('public')->delete($photoPath);
        }

        $newPath = $request->file('photo')->store('teacher-photos', 'public');

        TeacherProfile::updateOrCreate(
            ['user_id' => $teacher->id],
            ['photo_path' => $newPath]
        );

        return back()->with('success', 'Your profile photo has been updated.');
    }
}