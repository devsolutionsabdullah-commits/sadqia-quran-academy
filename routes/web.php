<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\EnrollmentController as StudentEnrollmentController;
use App\Models\Course;
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\TeacherProfileController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\CertificateController;

// Public pages
Route::get('/', function () {
    $courses = Course::where('is_active', true)->get();
    return view('welcome', compact('courses'));
})->name('home');

Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/courses/{slug}', [CourseDetailController::class, 'show'])->name('course.detail');
Route::get('/teachers', [TeachersController::class, 'index'])->name('teachers.index.public');
Route::get('/teachers/{teacher}', [TeachersController::class, 'show'])->name('teachers.show');

// Auth
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboards
Route::middleware(['auth', 'role:student'])->get('/dashboard', [DashboardController::class, 'student'])->name('dashboard.student');
Route::middleware(['auth', 'role:teacher'])->get('/teacher/dashboard', [DashboardController::class, 'teacher'])->name('dashboard.teacher');
Route::middleware(['auth', 'role:admin'])->get('/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

// Enroll Now + student-side enrollment
Route::get('/enroll-now', [StudentEnrollmentController::class, 'create'])->name('enroll-now');
Route::middleware('auth')->post('/enroll', [StudentEnrollmentController::class, 'store'])->name('enrollments.store');

// Teacher-only: class schedules + own profile photo
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::post('/schedules/{enrollment}', [ClassScheduleController::class, 'store'])->name('schedules.store');
    Route::delete('/schedules/{classSchedule}', [ClassScheduleController::class, 'destroy'])->name('schedules.destroy');
    Route::post('/my-profile/photo', [TeacherProfileController::class, 'updatePhoto'])->name('teacher.profile.photo');
});

// Teacher + Admin: attendance, notices, progress, homework
Route::middleware(['auth'])->group(function () {
    Route::post('/attendance/{enrollment}', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('/notices/{enrollment}', [NoticeController::class, 'store'])->name('notices.store');
    Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    Route::post('/progress/{enrollment}', [ProgressController::class, 'update'])->name('progress.update');
    Route::post('/homework/{enrollment}', [HomeworkController::class, 'store'])->name('homework.store');
    Route::post('/homework/{homework}/submit', [HomeworkController::class, 'submit'])->name('homework.submit');
    Route::delete('/homework/{homework}', [HomeworkController::class, 'destroy'])->name('homework.destroy');
    Route::post('/certificates/{enrollment}/issue', [CertificateController::class, 'issue'])->name('certificates.issue');
    Route::get('/certificates/{enrollment}', [CertificateController::class, 'show'])->name('certificates.show');
});

// Admin-only
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::post('/enrollments/{enrollment}/assign', [EnrollmentController::class, 'assign'])->name('enrollments.assign');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::post('/fees/{enrollment}', [FeeController::class, 'update'])->name('fees.update');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});