@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">
        Admin Dashboard
      </h2>
      <span class="badge" style="background: var(--gold, #D4AF37); color:#000;">Admin</span>
    </div>

    <div class="row g-4">
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-user-graduate mb-2" style="font-size: 1.8rem; color: var(--primary, #0B6E4F);"></i>
          <h3 class="mb-0">{{ $stats['total_students'] }}</h3>
          <p class="text-muted mb-0">Students</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-chalkboard-teacher mb-2" style="font-size: 1.8rem; color: var(--primary, #0B6E4F);"></i>
          <h3 class="mb-0">{{ $stats['total_teachers'] }}</h3>
          <p class="text-muted mb-0">Teachers</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-book-quran mb-2" style="font-size: 1.8rem; color: var(--primary, #0B6E4F);"></i>
          <h3 class="mb-0">{{ $stats['total_courses'] }}</h3>
          <p class="text-muted mb-0">Courses</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-file-signature mb-2" style="font-size: 1.8rem; color: var(--primary, #0B6E4F);"></i>
          <h3 class="mb-0">{{ $stats['total_enrollments'] }}</h3>
          <p class="text-muted mb-0">Enrollments</p>
        </div>
      </div>
    </div>

    <div class="row g-3 mt-2">
      <div class="col-md-4">
        <a href="{{ route('admin.courses.index') }}" class="btn btn-trial w-100 py-3">
          <i class="fas fa-book me-2"></i> Manage Courses
        </a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary w-100 py-3">
          <i class="fas fa-chart-bar me-2"></i> View Reports
        </a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('admin.enrollments.index') }}" class="btn btn-outline-secondary w-100 py-3">
          <i class="fas fa-file-signature me-2"></i> View Enrollments
        </a>
      </div>
    </div>
  </div>
</section>
@endsection