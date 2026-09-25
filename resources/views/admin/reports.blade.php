@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <h2 class="mb-4" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Reports</h2>

    <!-- Enrollments -->
    <h5 class="mb-3" style="color: var(--primary, #0B6E4F);"><i class="fas fa-user-graduate me-2"></i>Enrollments</h5>
    <div class="row g-3 mb-5">
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0">{{ $totalEnrollments }}</h3>
          <p class="text-muted mb-0 small">Total Enrollments</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-success">{{ $activeEnrollments }}</h3>
          <p class="text-muted mb-0 small">Active</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-warning">{{ $pendingEnrollments }}</h3>
          <p class="text-muted mb-0 small">Pending</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0" style="color: var(--gold, #D4AF37);">{{ $completedEnrollments }}</h3>
          <p class="text-muted mb-0 small">Completed</p>
        </div>
      </div>
    </div>

    <div class="mb-5" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25); padding: 20px;">
      <h6 class="mb-3">Enrollments by Course</h6>
      @forelse ($enrollmentsByCourse as $row)
        <div class="d-flex justify-content-between border-bottom py-2">
          <span>{{ $row->course->name ?? 'Unknown' }}</span>
          <strong>{{ $row->total }}</strong>
        </div>
      @empty
        <p class="text-muted mb-0">No data yet.</p>
      @endforelse
    </div>

    <!-- Fees -->
    <h5 class="mb-3" style="color: var(--primary, #0B6E4F);"><i class="fas fa-money-bill-wave me-2"></i>Fees</h5>
    <div class="row g-3 mb-5">
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-success">${{ number_format($totalCollected, 2) }}</h3>
          <p class="text-muted mb-0 small">Collected</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-warning">${{ number_format($totalPending, 2) }}</h3>
          <p class="text-muted mb-0 small">Pending</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0">{{ $paidCount }}</h3>
          <p class="text-muted mb-0 small">Paid Records</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0">{{ $pendingCount }}</h3>
          <p class="text-muted mb-0 small">Pending Records</p>
        </div>
      </div>
    </div>

    <!-- Attendance -->
    <h5 class="mb-3" style="color: var(--primary, #0B6E4F);"><i class="fas fa-clipboard-check me-2"></i>Attendance</h5>
    <div class="row g-3 mb-5">
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0">{{ $totalAttendanceRecords }}</h3>
          <p class="text-muted mb-0 small">Total Records</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-success">{{ $presentCount }}</h3>
          <p class="text-muted mb-0 small">Present</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-danger">{{ $absentCount }}</h3>
          <p class="text-muted mb-0 small">Absent</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0" style="color: var(--gold, #D4AF37);">{{ $overallAttendanceRate }}%</h3>
          <p class="text-muted mb-0 small">Overall Rate</p>
        </div>
      </div>
    </div>

    <!-- Homework -->
    <h5 class="mb-3" style="color: var(--primary, #0B6E4F);"><i class="fas fa-book-open me-2"></i>Homework</h5>
    <div class="row g-3">
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0">{{ $totalHomework }}</h3>
          <p class="text-muted mb-0 small">Total Assigned</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-success">{{ $submittedHomework }}</h3>
          <p class="text-muted mb-0 small">Submitted</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0 text-warning">{{ $pendingHomework }}</h3>
          <p class="text-muted mb-0 small">Pending</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="p-3 text-center" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.25);">
          <h3 class="mb-0" style="color: var(--gold, #D4AF37);">{{ $submissionRate }}%</h3>
          <p class="text-muted mb-0 small">Submission Rate</p>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection