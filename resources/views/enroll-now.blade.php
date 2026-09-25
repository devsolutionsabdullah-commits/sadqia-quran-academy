@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-eyebrow">Get Started</div>
      <h1 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Enroll Now</h1>
      <p class="text-muted">Fill in the details below and we'll match you with the right teacher.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="p-4 p-md-5" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @auth
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('enrollments.store') }}">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name (Student) <span class="req">*</span></label>
                  <input type="text" name="student_name" class="form-control" value="{{ old('student_name') }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Parent / Guardian Name <span class="req">*</span></label>
                  <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name', Auth::user()->name) }}" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Age <span class="req">*</span></label>
                  <input type="number" name="age" class="form-control" min="4" max="80" value="{{ old('age') }}" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender</label>
                  <select name="gender" class="form-select">
                    <option value="" selected>Prefer not to say</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">WhatsApp Number <span class="req">*</span></label>
                  <input type="tel" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number') }}" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Country <span class="req">*</span></label>
                  <select name="country" class="form-select" required>
                    <option value="" disabled selected>Select your country</option>
                    <option>USA</option>
                    <option>United Kingdom</option>
                    <option>Canada</option>
                    <option>Australia</option>
                    <option>New Zealand</option>
                    <option>UAE</option>
                    <option>Saudi Arabia</option>
                    <option>Qatar</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Time Zone</label>
                  <select name="timezone" class="form-select">
                    <option value="" selected>Select your time zone</option>
                    <option value="America/New_York">Eastern Time (US &amp; Canada)</option>
                    <option value="America/Chicago">Central Time (US &amp; Canada)</option>
                    <option value="America/Denver">Mountain Time (US &amp; Canada)</option>
                    <option value="America/Los_Angeles">Pacific Time (US &amp; Canada)</option>
                    <option value="Europe/London">London (UK)</option>
                    <option value="Australia/Sydney">Sydney (Australia)</option>
                    <option value="Pacific/Auckland">Auckland (New Zealand)</option>
                    <option value="Asia/Dubai">Dubai (UAE)</option>
                    <option value="Asia/Riyadh">Riyadh (Saudi Arabia)</option>
                    <option value="Asia/Qatar">Doha (Qatar)</option>
                    <option value="Asia/Karachi">Pakistan</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Course <span class="req">*</span></label>
                  <select name="course_id" class="form-select" required>
                    <option value="" disabled selected>Select a course</option>
                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Preferred Teacher (Optional)</label>
                  <select name="preferred_teacher_id" class="form-select">
                    <option value="">No preference</option>
                    @foreach ($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Previous Quran Experience</label>
                  <select name="quran_experience" class="form-select">
                    <option value="" selected>Select level</option>
                    <option value="Beginner">Beginner (never studied)</option>
                    <option value="Some Experience">Some Experience</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced / Reverting Hafiz</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Preferred Days &amp; Time</label>
                  <input type="text" name="preferred_timing" class="form-control" placeholder="e.g. Weekdays 6-8 PM" value="{{ old('preferred_timing') }}">
                </div>
                <div class="col-12">
                  <label class="form-label">Additional Notes</label>
                  <textarea name="message" class="form-control" rows="3">{{ old('message') }}</textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary-cust btn-ripple w-100 py-3">
                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                  </button>
                </div>
              </div>
            </form>
          @else
            <div class="text-center py-5">
              <i class="fas fa-lock mb-3" style="font-size: 2rem; color: var(--gold, #D4AF37);"></i>
              <h4>Login Required</h4>
              <p class="text-muted">Please login or create a free account to submit your application.</p>
              <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary px-4">Login</a>
                <a href="{{ route('register') }}" class="btn btn-trial px-4">Register</a>
              </div>
            </div>
          @endauth

        </div>
      </div>
    </div>
  </div>
</section>
@endsection