<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeachersController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->with('teacherProfile')->get();

        return view('teachers.index', compact('teachers'));
    }

    public function show(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $teacher->load('teacherProfile');

        return view('teachers.show', compact('teacher'));
    }
}