@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="mb-4" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Edit Teacher Profile — {{ $teacher->name }}</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" enctype="multipart/form-data" class="p-4" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          @csrf
          @method('PUT')

          @if ($teacher->teacherProfile?->photo_path)
            <img src="{{ asset('storage/' . $teacher->teacherProfile->photo_path) }}" alt="{{ $teacher->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;" class="mb-3">
          @endif

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Photo</label>
              <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
              <label class="form-label">Google Meet Link</label>
              <input type="url" name="meeting_link" class="form-control" value="{{ old('meeting_link', $teacher->teacherProfile->meeting_link ?? '') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Qualification</label>
              <input type="text" name="qualifications" class="form-control" value="{{ old('qualifications', $teacher->teacherProfile->qualifications ?? '') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Experience (years)</label>
              <input type="number" name="experience_years" class="form-control" min="0" value="{{ old('experience_years', $teacher->teacherProfile->experience_years ?? '') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Languages</label>
              <input type="text" name="languages" class="form-control" value="{{ old('languages', $teacher->teacherProfile->languages ?? '') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Specialization</label>
              <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $teacher->teacherProfile->specialization ?? '') }}">
            </div>
            <div class="col-12">
              <label class="form-label">Biography</label>
              <textarea name="bio" class="form-control" rows="4">{{ old('bio', $teacher->teacherProfile->bio ?? '') }}</textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-trial px-4 mt-4">Save Changes</button>
          <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary px-4 mt-4">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection