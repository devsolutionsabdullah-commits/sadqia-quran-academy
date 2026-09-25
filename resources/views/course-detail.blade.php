@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">

    <div class="text-center mb-5">
      <div class="section-eyebrow">Course Details</div>
      <h1 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">{{ $course['name'] }}</h1>
    </div>

    <div class="row g-4 mb-5">
      <div class="col-md-6">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-calendar-alt mb-2" style="font-size: 1.8rem; color: var(--primary, #0B6E4F);"></i>
          <h4 class="mb-0">{{ $course['duration'] }}</h4>
          <p class="text-muted mb-0">Duration</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-4 text-center" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          <i class="fas fa-dollar-sign mb-2" style="font-size: 1.8rem; color: var(--gold, #D4AF37);"></i>
          <h4 class="mb-0">${{ $course['rate'] }}/hour</h4>
          <p class="text-muted mb-0">Price</p>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">

        <h3 class="mb-3" style="color: var(--primary, #0B6E4F);">Course Outline</h3>
        @foreach ($course['outline'] as $phase => $topics)
          <div class="mb-3 p-3" style="background: var(--card-bg, #fff); border-radius: 12px; border: 1px solid rgba(212,175,55,0.2);">
            <h6 class="mb-2" style="color: var(--gold, #D4AF37);">{{ $phase }}</h6>
            <ul class="mb-0">
              @foreach ($topics as $topic)
                <li>{{ $topic }}</li>
              @endforeach
            </ul>
          </div>
        @endforeach

        <h3 class="mb-3 mt-5" style="color: var(--primary, #0B6E4F);">Learning Outcomes</h3>
        <p class="mb-2">Student will:</p>
        <ul>
          @foreach ($course['outcomes'] as $outcome)
            <li>{{ $outcome }}</li>
          @endforeach
        </ul>

      </div>

      <div class="col-lg-4">
        <div class="p-4" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25); position: sticky; top: 100px;">
          <h5 style="color: var(--primary, #0B6E4F);">Who is this course for?</h5>
          <ul class="mb-4">
            @foreach ($course['who_for'] as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
          <a href="{{ route('enroll-now') }}" class="btn btn-trial w-100">Enroll Now</a>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection