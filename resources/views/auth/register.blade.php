@extends('layouts.app')

@section('content')
<section class="auth-section py-5" style="min-height: 80vh; display: flex; align-items: center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="auth-card p-4 p-md-5" style="background: var(--card-bg, #fff); border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid rgba(212,175,55,0.25);">

          <div class="text-center mb-4">
            <i class="fas fa-book-quran" style="font-size: 2.5rem; color: var(--gold, #D4AF37);"></i>
            <h2 class="mt-3" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Create Your Account</h2>
            <p class="text-muted">Join Sadqia Quran Academy today</p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn w-100 py-2 btn-ripple" style="background: var(--primary, #0B6E4F); color: #fff; font-weight: 600; border-radius: 8px;">
              Create Account
            </button>
          </form>

          <p class="text-center mt-4 mb-0">
            Already have an account?
            <a href="{{ route('login') }}" style="color: var(--gold, #D4AF37); font-weight: 600;">Login here</a>
          </p>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection