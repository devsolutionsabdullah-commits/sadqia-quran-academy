@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container py-4">
    <div class="row g-4">

      <div class="col-lg-4">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25); position: sticky; top: 100px;">

          @if ($teacher->teacherProfile?->photo_path)
            <img src="{{ asset('storage/' . $teacher->teacherProfile->photo_path) }}" alt="{{ $teacher->name }}"
                 style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover; border: 4px solid var(--gold, #D4AF37);" class="mb-3">
          @else
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                 style="width: 140px; height: 140px; border-radius: 50%; background: var(--primary, #0B6E4F); color: var(--gold, #D4AF37); font-size: 3rem; font-weight: 700; border: 4px solid var(--gold, #D4AF37);">
              {{ strtoupper(substr($teacher->name, 0, 1)) }}
            </div>
          @endif

          <h3 style="color: var(--primary, #0B6E4F);">{{ $teacher->name }}</h3>
          <p class="text-muted">{{ $teacher->teacherProfile?->qualifications ?? 'Quran Teacher' }}</p>

          <hr>

          <ul class="list-unstyled text-start small">
            @if ($teacher->teacherProfile?->experience_years)
              <li class="mb-2"><i class="fas fa-briefcase me-2" style="color: var(--gold, #D4AF37);"></i> {{ $teacher->teacherProfile->experience_years }} years experience</li>
            @endif
            @if ($teacher->teacherProfile?->specialization)
              <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--gold, #D4AF37);"></i> Specializes in {{ $teacher->teacherProfile->specialization }}</li>
            @endif
            @if ($teacher->teacherProfile?->languages)
              <li class="mb-2"><i class="fas fa-language me-2" style="color: var(--gold, #D4AF37);"></i> {{ $teacher->teacherProfile->languages }}</li>
            @endif
          </ul>

          <a href="{{ route('enroll-now') }}" class="btn btn-trial w-100 mt-3">Book Trial with {{ explode(' ', $teacher->name)[0] }}</a>
        </div>
      </div>

      <div class="col-lg-8">
        <h4 class="mb-3" style="color: var(--primary, #0B6E4F);">Biography</h4>
        @if ($teacher->teacherProfile?->bio)
          <p>{{ $teacher->teacherProfile->bio }}</p>
        @else
          <p class="text-muted">No biography added yet.</p>
        @endif
      </div>

    </div>
  </div>
</section>
@endsection