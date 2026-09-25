<!-- ============================
     NAVBAR
============================= -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav" aria-label="Main navigation">
  <div class="container">

    <a class="navbar-brand" href="{{ route('home') }}#home" aria-label="Sadqia Quran Academy Home">
      <span class="brand-icon" aria-hidden="true"><i class="fas fa-star-and-crescent"></i></span>
      <span class="brand-text">Sadqia <span class="brand-accent">Quran</span> Academy</span>
    </a>

    <div class="d-flex align-items-center gap-2 d-lg-none">
      <button class="theme-toggle" id="themeToggleMobile" aria-label="Toggle dark mode">
        <i class="fas fa-moon" id="themeIconMobile"></i>
      </button>
      <button class="navbar-toggler border-0" type="button"
              data-bs-toggle="collapse" data-bs-target="#navContent"
              aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars" style="color:var(--text)"></i>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#courses">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#why-us">Why Us</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#how-it-works">How It Works</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#testimonials">Testimonials</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#faq">FAQ</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('pricing') }}">Pricing</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index.public') }}">Teachers</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <button class="theme-toggle d-none d-lg-flex" id="themeToggleDesktop" aria-label="Toggle dark mode">
          <i class="fas fa-moon" id="themeIconDesktop"></i>
        </button>

        @auth
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
              <li>
                @if (Auth::user()->isAdmin())
                  <a class="dropdown-item" href="/admin"><i class="fas fa-gauge"></i> Admin Dashboard</a>
                  <a class="dropdown-item" href="/admin/teachers"><i class="fas fa-chalkboard-teacher"></i> Manage Teachers</a>
                  <a class="dropdown-item" href="/admin/courses"><i class="fas fa-book"></i> Manage Courses</a>
                  <a class="dropdown-item" href="/admin/enrollments"><i class="fas fa-file-signature"></i> Enrollments</a>
                @elseif (Auth::user()->isTeacher())
                  <a class="dropdown-item" href="/teacher/dashboard"><i class="fas fa-gauge"></i> Teacher Dashboard</a>
                @else
                  <a class="dropdown-item" href="/dashboard"><i class="fas fa-gauge"></i> My Dashboard</a>
                @endif
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="px-2">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-right-from-bracket"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </div>
        @else
          <div class="dropdown">
            <a class="btn btn-trial dropdown-toggle" href="#" id="authMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user" aria-hidden="true"></i> Account
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authMenu">
              <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-right-to-bracket"></i> Login</a></li>
              <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a></li>
            </ul>
          </div>
        @endauth

        <a href="{{ route('enroll-now') }}" class="btn btn-trial">Book Free Trial</a>
      </div>
    </div>
  </div>
</nav>