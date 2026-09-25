@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">
        Welcome, {{ Auth::user()->name }}
      </h2>
      <span class="badge" style="background: var(--gold, #D4AF37); color:#000;">Student</span>
    </div>

    @if ($enrollments->isEmpty())
      <div class="text-center py-5" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
        <i class="fas fa-book-quran mb-3" style="font-size: 2.5rem; color: var(--gold, #D4AF37);"></i>
        <h4>No enrollments yet</h4>
        <p class="text-muted">Book a free trial class to get started on your Quran journey.</p>
        <a href="{{ route('enroll-now') }}" class="btn btn-trial mt-2">Book Free Trial</a>
      </div>
    @else
      <div class="row g-4">
        @foreach ($enrollments as $enrollment)
          @php
            $total = $enrollment->attendances->count();
            $present = $enrollment->attendances->where('status', 'present')->count();
            $attendancePct = $total > 0 ? round(($present / $total) * 100) : 0;
          @endphp
          <div class="col-lg-6">
            <div class="p-4 h-100" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">

              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <h5 class="mb-0" style="color: var(--primary, #0B6E4F);">{{ $enrollment->course->name }}</h5>
                  <small class="text-muted">
                    <i class="fas fa-chalkboard-teacher me-1"></i>{{ $enrollment->teacher->name ?? 'Not assigned yet' }}
                  </small>
                </div>
                <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'pending' ? 'warning' : 'secondary') }}">
                  {{ ucfirst($enrollment->status) }}
                </span>
              </div>

              <hr>

              <!-- Class Schedule -->
              <h6 class="mb-2"><i class="fas fa-calendar-days me-1"></i> Class Schedule</h6>
              @forelse ($enrollment->classSchedules as $schedule)
                <div class="mb-1 p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px; font-size: 14px;">
                  <strong>{{ $schedule->day_of_week }}</strong> — {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} ({{ $schedule->timezone }})
                </div>
              @empty
                <p class="text-muted small mb-2">Schedule not set yet.</p>
              @endforelse

              @if ($enrollment->teacher?->teacherProfile?->meeting_link)
                <a href="{{ $enrollment->teacher->teacherProfile->meeting_link }}" target="_blank" class="btn btn-sm btn-trial mt-2 mb-2">
                  <i class="fas fa-video me-1"></i> Join Class
                </a>
              @endif

              <!-- Progress -->
              <h6 class="mb-2 mt-3"><i class="fas fa-chart-line me-1"></i> Progress</h6>
              <p class="mb-1 small">{{ $enrollment->current_lesson ?? 'Not started yet' }}</p>
              <div class="progress" style="height: 10px; border-radius: 5px;">
                <div class="progress-bar" role="progressbar" style="width: {{ $enrollment->progress_percentage }}%; background: var(--primary, #0B6E4F);"
                     aria-valuenow="{{ $enrollment->progress_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <small class="text-muted">{{ $enrollment->progress_percentage }}% complete</small>

              <!-- Attendance -->
              <h6 class="mb-2 mt-3"><i class="fas fa-clipboard-check me-1"></i> Attendance</h6>
              <div class="row text-center g-2">
                <div class="col-4">
                  <div class="p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px;">
                    <strong>{{ $total }}</strong>
                    <div class="small text-muted">Total</div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="p-2" style="background: rgba(40,167,69,0.1); border-radius: 8px;">
                    <strong>{{ $present }}</strong>
                    <div class="small text-muted">Present</div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="p-2" style="background: rgba(212,175,55,0.1); border-radius: 8px;">
                    <strong>{{ $attendancePct }}%</strong>
                    <div class="small text-muted">Rate</div>
                  </div>
                </div>
              </div>

              <!-- Teacher Notices -->
              @if ($enrollment->notices->isNotEmpty())
                <h6 class="mb-2 mt-3"><i class="fas fa-bell me-1"></i> Teacher Notices</h6>
                @foreach ($enrollment->notices->take(3) as $notice)
                  <div class="mb-1 p-2" style="background: rgba(212,175,55,0.08); border-radius: 8px; font-size: 13px;">
                    {{ $notice->message }}
                  </div>
                @endforeach
              @endif

              <!-- Fee Status -->
              <h6 class="mb-2 mt-3"><i class="fas fa-money-bill-wave me-1"></i> Fee Status</h6>
              @if ($enrollment->fee)
                <div class="d-flex justify-content-between align-items-center p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px;">
                  <span>
                    <span class="badge bg-{{ $enrollment->fee->status === 'paid' ? 'success' : 'warning' }}">
                      {{ ucfirst($enrollment->fee->status) }}
                    </span>
                    @if ($enrollment->fee->amount)
                      <span class="ms-2">${{ number_format($enrollment->fee->amount, 2) }}</span>
                    @endif
                  </span>
                  @if ($enrollment->fee->due_date)
                    <small class="text-muted">Due: {{ $enrollment->fee->due_date->format('d M, Y') }}</small>
                  @endif
                </div>
              @else
                <p class="text-muted small">No fee record yet.</p>
              @endif

              <!-- Homework -->
              @if ($enrollment->homework->isNotEmpty())
                <h6 class="mb-2 mt-3"><i class="fas fa-book-open me-1"></i> Homework</h6>
                @foreach ($enrollment->homework as $hw)
                  <div class="mb-2 p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px; font-size: 13px;">
                    <div class="d-flex justify-content-between align-items-start">
                      <strong>{{ $hw->title }}</strong>
                      <span class="badge bg-{{ $hw->status === 'submitted' ? 'success' : 'warning' }}">{{ ucfirst($hw->status) }}</span>
                    </div>
                    @if ($hw->description)
                      <p class="mb-1 mt-1">{{ $hw->description }}</p>
                    @endif
                    @if ($hw->due_date)
                      <p class="mb-1 text-muted">Due: {{ $hw->due_date->format('d M, Y') }}</p>
                    @endif
                    @if ($hw->attachment_path)
                      <a href="{{ asset('storage/' . $hw->attachment_path) }}" target="_blank"><i class="fas fa-paperclip"></i> View Attachment</a>
                    @endif

                    @if ($hw->status === 'pending')
                      <form action="{{ route('homework.submit', $hw) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 mt-2">
                        @csrf
                        <input type="file" name="submission" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="submit" class="btn btn-sm btn-trial">Submit</button>
                      </form>
                    @else
                      <a href="{{ asset('storage/' . $hw->submission_path) }}" target="_blank" class="d-block mt-1"><i class="fas fa-check-circle text-success"></i> Your Submission</a>
                    @endif
                  </div>
                @endforeach
              @endif

              @if ($enrollment->certificate_number)
                <a href="{{ route('certificates.show', $enrollment) }}" target="_blank" class="btn btn-trial w-100 mt-3">
                  <i class="fas fa-award me-1"></i> View Certificate
                </a>
              @endif

            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>