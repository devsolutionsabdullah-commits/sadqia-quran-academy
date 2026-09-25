<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <title>Sadqia Quran Academy - Learn Quran Online with Certified Hafiz</title>
  <meta name="title" content="Sadqia Quran Academy - Learn Quran Online with Certified Hafiz" />
  <meta name="description" content="Join Sadqia Quran Academy for professional one-to-one online Quran classes. Nazra, Tajweed, Hifz, Qaida Noorania and Islamic Studies for kids and adults worldwide." />
  <meta name="keywords" content="online quran academy, learn quran online, quran classes for kids, tajweed classes, hifz program, qaida noorania, quran memorization, online islamic education, quran teacher" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="Sadqia Quran Academy" />
  <link rel="canonical" href="https://sadqiaquranacademy.com/" />

  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://sadqiaquranacademy.com/" />
  <meta property="og:title" content="Sadqia Quran Academy - Learn Quran Online with Certified Hafiz" />
  <meta property="og:description" content="Professional one-to-one online Quran classes for kids and adults worldwide. Flexible timing, certified Hafiz, and affordable fees." />
  <meta property="og:site_name" content="Sadqia Quran Academy" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Sadqia Quran Academy - Learn Quran Online" />
  <meta name="twitter:description" content="One-to-one online Quran classes for kids and adults. Nazra, Tajweed, Hifz and more." />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <script type="application/ld+json">
  @verbatim
  {
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "Sadqia Quran Academy",
    "description": "Professional online Quran academy offering one-to-one classes in Nazra, Tajweed, Hifz, Qaida Noorania, and Islamic Studies for kids and adults worldwide.",
    "url": "https://sadqiaquranacademy.com",
    "email": "devsolutionsabdullah@gmail.com",
    "areaServed": ["US","GB","CA","AU","NZ","AE","SA","QA","EU"],
    "teaches": ["Quran Recitation","Tajweed","Quran Memorization","Islamic Studies"],
    "offers": {
      "@type": "Offer",
      "name": "Free Trial Quran Class",
      "price": "0",
      "priceCurrency": "USD",
      "availability": "https://schema.org/InStock"
    }
  }
  @endverbatim
  </script>
</head>
<body>

@include('partials.preloader')

<div id="scrollProgress" role="progressbar" aria-label="Page scroll progress"></div>

@include('partials.navbar')

<main>
@yield('content')
</main>

@include('partials.footer')

<button id="backToTop" class="back-to-top btn-ripple" aria-label="Back to top of page">
  <i class="fas fa-chevron-up" aria-hidden="true"></i>
</button>

<div class="mobile-cta-bar d-lg-none" aria-label="Quick action bar">
  <a href="#contact" class="btn btn-mob-trial btn-ripple">
    <i class="fas fa-calendar-check" aria-hidden="true"></i> Book Free Trial
  </a>
  <a href="https://wa.me/923063813338" class="btn btn-mob-wa btn-ripple" target="_blank" rel="noopener noreferrer">
    <i class="fab fa-whatsapp" aria-hidden="true"></i> WhatsApp
  </a>
</div>

@include('partials.scripts')
@stack('scripts')
</body>
</html>
