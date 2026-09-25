@extends('layouts.app')

@section('content')
<section class="auth-section py-5" style="min-height: 80vh; display: flex; align-items: center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="auth-card p-4 p-md-5" style="background: var(--card-bg, #fff); border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); border: 1px solid rgba(212,175,55,0.25);">

          <div class="text-center mb-4">
            <i class="fas fa-book-quran" style="font-size: 2.5rem; color: var(--gold, #D4AF37);"></i>
            <h2 class="mt-3" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Welcome Back</h2>
            <p class="text-muted">Login to continue your Quran journey</p>
          </div>

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn w-100 py-2 btn-ripple" style="background: var(--primary, #0B6E4F); color: #fff; font-weight: 600; border-radius: 8px;">
              Login
            </button>
          </form>

          <p class="text-center mt-4 mb-0">
            Don't have an account?
            <a href="{{ route('register') }}" style="color: var(--gold, #D4AF37); font-weight: 600;">Register here</a>
          </p>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection