@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">
        Welcome, Ustad {{ Auth::user()->name }}
      </h2>
      <span class="badge" style="background: var(--gold, #D4AF37); color:#000;">Teacher</span>
    </div>

    <div class="p-4 mb-4 d-flex align-items-center gap-4" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
      @if (Auth::user()->teacherProfile?->photo_path)
        <img src="{{ asset('storage/' . Auth::user()->teacherProfile->photo_path) }}" alt="{{ Auth::user()->name }}"
             style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 3px solid var(--gold, #D4AF37);">
      @else
        <div class="d-flex align-items-center justify-content-center"
             style="width: 70px; height: 70px; border-radius: 50%; background: var(--primary, #0B6E4F); color: var(--gold, #D4AF37); font-size: 1.6rem; font-weight: 700; border: 3px solid var(--gold, #D4AF37);">
          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
      @endif
      <form action="{{ route('teacher.profile.photo') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-center flex-grow-1">
        @csrf
        <input type="file" name="photo" class="form-control form-control-sm" accept="image/*" required>
        <button type="submit" class="btn btn-sm btn-trial">Update Photo</button>
      </form>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($enrollments->isEmpty())
      <div class="text-center py-5" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
        <i class="fas fa-users mb-3" style="font-size: 2.5rem; color: var(--gold, #D4AF37);"></i>
        <h4>No students assigned yet</h4>
        <p class="text-muted">Once the admin assigns you students, they'll appear here.</p>
      </div>
    @else
      <div class="row g-4">
        @foreach ($enrollments as $enrollment)
          <div class="col-lg-6">
            <div class="p-4 h-100" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">

              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <h5 class="mb-0" style="color: var(--primary, #0B6E4F);">{{ $enrollment->student->name }}</h5>
                  <small class="text-muted">{{ $enrollment->course->name }}</small>
                </div>
                <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'pending' ? 'warning' : 'secondary') }}">
                  {{ ucfirst($enrollment->status) }}
                </span>
              </div>

              <hr>

              <h6 class="mb-2"><i class="fas fa-calendar-days me-1"></i> Class Schedule</h6>

              @forelse ($enrollment->classSchedules as $schedule)
                <div class="d-flex justify-content-between align-items-center mb-2 p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px;">
                  <span>
                    <strong>{{ $schedule->day_of_week }}</strong>
                    — {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                    ({{ $schedule->timezone }})
                  </span>
                  <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Remove this schedule slot?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                      <i class="fas fa-xmark"></i>
                    </button>
                  </form>
                </div>
              @empty
                <p class="text-muted small mb-2">No schedule set yet.</p>
              @endforelse

              <form action="{{ route('schedules.store', $enrollment) }}" method="POST" class="row g-2 mt-2">
                @csrf
                <div class="col-4">
                  <select name="day_of_week" class="form-select form-select-sm" required>
                    <option value="" disabled selected>Day</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="time" name="start_time" class="form-control form-control-sm" required>
                </div>
                <div class="col-3">
                  <select name="timezone" class="form-select form-select-sm" required>
                    <option value="" disabled selected>Zone</option>
                    <option value="Asia/Karachi">Pakistan</option>
                    <option value="America/New_York">US Eastern</option>
                    <option value="America/Chicago">US Central</option>
                    <option value="America/Denver">US Mountain</option>
                    <option value="America/Los_Angeles">US Pacific</option>
                    <option value="Europe/London">UK</option>
                    <option value="Australia/Sydney">Australia (Sydney)</option>
                    <option value="Pacific/Auckland">New Zealand</option>
                    <option value="Asia/Dubai">UAE</option>
                    <option value="Asia/Riyadh">Saudi Arabia</option>
                    <option value="Asia/Qatar">Qatar</option>
                  </select>
                </div>
                <div class="col-1">
                  <button type="submit" class="btn btn-sm btn-trial w-100" title="Add">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </form>

              <hr>

              <h6 class="mb-2"><i class="fas fa-clipboard-check me-1"></i> Mark Attendance</h6>
              <form action="{{ route('attendance.store', $enrollment) }}" method="POST" class="row g-2 mb-3">
                @csrf
                <div class="col-5">
                  <input type="date" name="class_date" class="form-control form-control-sm" required max="{{ now()->toDateString() }}">
                </div>
                <div class="col-4">
                  <select name="status" class="form-select form-select-sm" required>
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                  </select>
                </div>
                <div class="col-3">
                  <button type="submit" class="btn btn-sm btn-trial w-100">Mark</button>
                </div>
              </form>

              <hr>

              <h6 class="mb-2"><i class="fas fa-bell me-1"></i> Add Notice</h6>
              <form action="{{ route('notices.store', $enrollment) }}" method="POST" class="mb-2">
                @csrf
                <div class="input-group input-group-sm">
                  <input type="text" name="message" class="form-control" placeholder="e.g. Please revise Surah Mulk" required maxlength="500">
                  <button type="submit" class="btn btn-trial">Send</button>
                </div>
              </form>

              <hr>

              <h6 class="mb-2"><i class="fas fa-chart-line me-1"></i> Update Progress</h6>
              <form action="{{ route('progress.update', $enrollment) }}" method="POST" class="row g-2">
                @csrf
                <div class="col-7">
                  <input type="text" name="current_lesson" class="form-control form-control-sm" placeholder="e.g. Surah Al-Mulk" value="{{ $enrollment->current_lesson }}">
                </div>
                <div class="col-3">
                  <input type="number" name="progress_percentage" class="form-control form-control-sm" min="0" max="100" placeholder="%" value="{{ $enrollment->progress_percentage }}" required>
                </div>
                <div class="col-2">
                  <button type="submit" class="btn btn-sm btn-trial w-100">Save</button>
                </div>
              </form>

              @forelse ($enrollment->notices->take(3) as $notice)
                <div class="d-flex justify-content-between align-items-start mb-1 p-2 mt-2" style="background: rgba(212,175,55,0.08); border-radius: 8px; font-size: 13px;">
                  <span>{{ $notice->message }}</span>
                  <form action="{{ route('notices.destroy', $notice) }}" method="POST" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm p-0 border-0 text-danger"><i class="fas fa-xmark"></i></button>
                  </form>
                </div>
              @empty
              @endforelse

              <hr>

              <h6 class="mb-2"><i class="fas fa-book-open me-1"></i> Assign Homework</h6>
              <form action="{{ route('homework.store', $enrollment) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf
                <div class="row g-2">
                  <div class="col-md-6">
                    <input type="text" name="title" class="form-control form-control-sm" placeholder="Title (e.g. Revise Surah Mulk)" required>
                  </div>
                  <div class="col-md-6">
                    <input type="date" name="due_date" class="form-control form-control-sm" min="{{ now()->toDateString() }}">
                  </div>
                  <div class="col-12">
                    <textarea name="description" class="form-control form-control-sm" rows="2" placeholder="Instructions (optional)"></textarea>
                  </div>
                  <div class="col-md-8">
                    <input type="file" name="attachment" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png">
                  </div>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-sm btn-trial w-100">Assign</button>
                  </div>
                </div>
              </form>

              @forelse ($enrollment->homework as $hw)
                <div class="d-flex justify-content-between align-items-center mb-1 p-2" style="background: rgba(11,110,79,0.06); border-radius: 8px; font-size: 13px;">
                  <span>
                    <strong>{{ $hw->title }}</strong>
                    <span class="badge bg-{{ $hw->status === 'submitted' ? 'success' : 'warning' }} ms-1">{{ ucfirst($hw->status) }}</span>
                    @if ($hw->submission_path)
                      <a href="{{ asset('storage/' . $hw->submission_path) }}" target="_blank" class="ms-1"><i class="fas fa-paperclip"></i> View Submission</a>
                    @endif
                  </span>
                  <form action="{{ route('homework.destroy', $hw) }}" method="POST" onsubmit="return confirm('Remove this homework?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm p-0 border-0 text-danger"><i class="fas fa-xmark"></i></button>
                  </form>
                </div>
              @empty
              @endforelse

            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection