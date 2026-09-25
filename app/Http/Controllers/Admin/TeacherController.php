<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TeacherWelcomeNotification;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->with('teacherProfile')->latest()->get();

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'meeting_link' => ['nullable', 'url', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'languages' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $teacher = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('teacher-photos', 'public');
        }

        TeacherProfile::create([
            'user_id' => $teacher->id,
            'meeting_link' => $validated['meeting_link'] ?? null,
            'qualifications' => $validated['qualifications'] ?? null,
            'experience_years' => $validated['experience_years'] ?? null,
            'languages' => $validated['languages'] ?? null,
            'specialization' => $validated['specialization'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'photo_path' => $photoPath,
        ]);

        Mail::to($teacher->email)->send(new TeacherWelcomeNotification($teacher->name, $teacher->email, $validated['password']));

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher account created.');
    }

    public function edit(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $teacher->load('teacherProfile');

        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $validated = $request->validate([
            'meeting_link' => ['nullable', 'url', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'languages' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $photoPath = $teacher->teacherProfile->photo_path ?? null;
        if ($request->hasFile('photo')) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('teacher-photos', 'public');
        }

        $teacher->teacherProfile()->updateOrCreate(
            ['user_id' => $teacher->id],
            [
                'meeting_link' => $validated['meeting_link'] ?? null,
                'qualifications' => $validated['qualifications'] ?? null,
                'experience_years' => $validated['experience_years'] ?? null,
                'languages' => $validated['languages'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'photo_path' => $photoPath,
            ]
        );

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher profile updated.');
    }

    public function destroy(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $teacher->delete();

        return back()->with('success', 'Teacher removed.');
    }
}