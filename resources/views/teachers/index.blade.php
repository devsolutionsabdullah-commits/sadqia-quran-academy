@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container py-4">
    <div class="text-center mb-5">
      <div class="section-eyebrow">Our Team</div>
      <h1 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Meet Our Teachers</h1>
      <p class="text-muted">Certified, experienced, and dedicated to your Quran journey.</p>
    </div>

    @if ($teachers->isEmpty())
      <p class="text-center text-muted">No teachers listed yet.</p>
    @else
      <div class="row g-4">
        @foreach ($teachers as $teacher)
          <div class="col-md-6 col-lg-4">
            <a href="{{ route('teachers.show', $teacher) }}" class="text-decoration-none">
              <div class="p-4 text-center h-100" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25); transition: transform 0.2s;">

                @if ($teacher->teacherProfile?->photo_path)
                  <img src="{{ asset('storage/' . $teacher->teacherProfile->photo_path) }}" alt="{{ $teacher->name }}"
                       style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--gold, #D4AF37);" class="mb-3">
                @else
                  <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                       style="width: 100px; height: 100px; border-radius: 50%; background: var(--primary, #0B6E4F); color: var(--gold, #D4AF37); font-size: 2.2rem; font-weight: 700; border: 3px solid var(--gold, #D4AF37);">
                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                  </div>
                @endif

                <h5 class="mb-1" style="color: var(--primary, #0B6E4F);">{{ $teacher->name }}</h5>
                <p class="text-muted small mb-2">{{ $teacher->teacherProfile?->qualifications ?? 'Quran Teacher' }}</p>

                @if ($teacher->teacherProfile?->experience_years)
                  <p class="small mb-1"><i class="fas fa-briefcase me-1" style="color: var(--gold, #D4AF37);"></i> {{ $teacher->teacherProfile->experience_years }} years experience</p>
                @endif
                @if ($teacher->teacherProfile?->languages)
                  <p class="small mb-0"><i class="fas fa-language me-1" style="color: var(--gold, #D4AF37);"></i> {{ $teacher->teacherProfile->languages }}</p>
                @endif

              </div>
            </a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection