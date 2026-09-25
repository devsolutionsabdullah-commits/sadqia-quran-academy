@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh; background: var(--bg-alt, #f8f9fa);">
  <div class="container py-5">
    <div class="text-center mb-5">
      <div class="section-eyebrow">Pricing</div>
      <h1 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Simple, Hourly Pricing</h1>
      <p class="text-muted">Pay only for the classes you take — no hidden fees, cancel anytime.</p>
    </div>

    <div class="row g-4">
      @foreach ($pricing as $item)
        <div class="col-md-6 col-lg-4">
          <div class="p-4 h-100 text-center" style="background: #fff; border-radius: 16px; border: 1px solid rgba(212,175,55,0.25); box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
            <h4 style="color: var(--primary, #0B6E4F);">{{ $item['name'] }}</h4>
            <div class="my-3">
              <span style="font-size: 2.5rem; font-weight: 700; color: var(--gold, #D4AF37);">${{ $item['rate'] }}</span>
              <span class="text-muted">/hour</span>
            </div>
            <p class="text-muted mb-4"><i class="fas fa-calendar-alt me-1"></i> Typical duration: {{ $item['duration'] }}</p>
            <ul class="list-unstyled text-start small mb-4" style="color: #555;">
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 1-to-1 personalized classes</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Certified Hafiz teacher</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Flexible scheduling</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Free trial class</li>
            </ul>
            <div class="d-flex gap-2">
              <a href="{{ route('course.detail', $item['slug']) }}" class="btn btn-outline-secondary w-50">View Details</a>
              <a href="{{ route('enroll-now') }}" class="btn btn-trial w-50">Enroll Now</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection