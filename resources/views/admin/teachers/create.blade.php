@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="mb-4" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Add Teacher</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data" class="p-4" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          @csrf

          <h5 class="mb-3" style="color: var(--primary, #0B6E4F);">Account Details</h5>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Set a Password</label>
              <input type="text" name="password" class="form-control" placeholder="Share this with the teacher" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Google Meet Link</label>
              <input type="url" name="meeting_link" class="form-control" value="{{ old('meeting_link') }}" placeholder="https://meet.google.com/xxx-xxxx-xxx">
            </div>
          </div>

          <h5 class="mb-3" style="color: var(--primary, #0B6E4F);">Profile (shown on public Teachers page)</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Photo (optional)</label>
              <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
              <label class="form-label">Qualification</label>
              <input type="text" name="qualifications" class="form-control" value="{{ old('qualifications') }}" placeholder="e.g. Hafiz, Qari, Mufti">
            </div>
            <div class="col-md-4">
              <label class="form-label">Experience (years)</label>
              <input type="number" name="experience_years" class="form-control" min="0" value="{{ old('experience_years') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Languages</label>
              <input type="text" name="languages" class="form-control" value="{{ old('languages') }}" placeholder="e.g. Urdu, English, Arabic">
            </div>
            <div class="col-md-4">
              <label class="form-label">Specialization</label>
              <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}" placeholder="e.g. Tajweed, Hifz">
            </div>
            <div class="col-12">
              <label class="form-label">Biography</label>
              <textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-trial px-4 mt-4">Create Teacher Account</button>
          <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary px-4 mt-4">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection