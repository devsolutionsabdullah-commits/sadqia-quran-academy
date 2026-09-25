<!-- ============================
     HERO SECTION
============================= -->
<section id="home" class="hero-section" aria-label="Hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <div class="hero-glow" aria-hidden="true"></div>

  <div class="container hero-container">
    <div class="row align-items-center g-5">

      <!-- Text -->
      <div class="col-lg-7 hero-text" data-aos="fade-right" data-aos-duration="900">
        <div class="hero-eyebrow" aria-hidden="true">
          <i class="fas fa-star-and-crescent"></i> Online Quran Academy
        </div>
        <h1 class="hero-heading">
          <span id="typedTarget"></span>
        </h1>
        <p class="hero-subtitle">
          Professional one-to-one Quran classes for kids &amp; adults worldwide — learn from a certified Hafiz at your own pace, in your own time zone.
        </p>
        <div class="hero-buttons">
          <a href="{{ route('enroll-now') }}" class="btn btn-hero-primary btn-ripple">
            <i class="fas fa-calendar-check"></i> Book Free Trial Class
          </a>
          <a href="https://wa.me/923063813338?text=Assalamu%20Alaikum%2C%20I%20want%20to%20book%20a%20free%20Quran%20trial%20class."
             class="btn btn-hero-wa btn-ripple" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-whatsapp"></i> Chat on WhatsApp
          </a>
        </div>
        <div class="trust-badges" role="list" aria-label="Trust indicators">
          <div class="trust-badge" role="listitem"><i class="fas fa-certificate" aria-hidden="true"></i><span>Certified Hafiz</span></div>
          <div class="trust-badge" role="listitem"><i class="fas fa-user-graduate" aria-hidden="true"></i><span>1-to-1 Classes</span></div>
          <div class="trust-badge" role="listitem"><i class="fas fa-globe" aria-hidden="true"></i><span>Worldwide</span></div>
          <div class="trust-badge" role="listitem"><i class="fas fa-clock" aria-hidden="true"></i><span>Flexible Timings</span></div>
          <div class="trust-badge" role="listitem"><i class="fas fa-shield-heart" aria-hidden="true"></i><span>Trusted Academy</span></div>
        </div>
      </div>

      <!-- Hero Image -->
      <div class="col-lg-5 d-none d-lg-flex justify-content-center" data-aos="fade-left" data-aos-duration="900" data-aos-delay="150">
        <div class="hero-image-wrapper">
          <div class="hero-image-frame">
            <svg class="hero-svg" viewBox="0 0 410 470" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Decorative Islamic geometric star pattern in green and gold, symbolizing Sadqia Quran Academy">
              <defs>
                <linearGradient id="heroBgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#0d7a59"/>
                  <stop offset="100%" stop-color="#085c42"/>
                </linearGradient>
                <linearGradient id="goldLine" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#e8c84a"/>
                  <stop offset="100%" stop-color="#D4AF37"/>
                </linearGradient>
              </defs>
              <rect width="410" height="470" fill="url(#heroBgGrad)"/>
              <!-- subtle repeating geometric lattice -->
              <g opacity="0.10" stroke="#ffffff" stroke-width="1">
                <path d="M0 60 L410 60 M0 130 L410 130 M0 200 L410 200 M0 270 L410 270 M0 340 L410 340 M0 410 L410 410"/>
                <path d="M35 0 L35 470 M105 0 L105 470 M175 0 L175 470 M245 0 L245 470 M315 0 L315 470 M385 0 L385 470"/>
              </g>
              <!-- central 8-point star medallion -->
              <g transform="translate(205,215)">
                <circle r="118" fill="none" stroke="url(#goldLine)" stroke-width="1.5" opacity="0.55"/>
                <circle r="96" fill="none" stroke="url(#goldLine)" stroke-width="1" opacity="0.4"/>
                <g stroke="url(#goldLine)" stroke-width="2" fill="none" stroke-linejoin="round">
                  <polygon points="0,-84 17,-40 62,-59 34,-19 84,0 34,19 62,59 17,40 0,84 -17,40 -62,59 -34,19 -84,0 -34,-19 -62,-59 -17,-40" />
                </g>
                <circle r="6" fill="url(#goldLine)"/>
              </g>
              <!-- open book silhouette -->
              <g transform="translate(205,236)" opacity="0.95">
                <path d="M-58 -18 C-40 -28 -18 -28 0 -20 C18 -28 40 -28 58 -18 L58 26 C40 16 18 16 0 24 C-18 16 -40 16 -58 26 Z"
                      fill="#F8F9FA" stroke="url(#goldLine)" stroke-width="1.5"/>
                <line x1="0" y1="-20" x2="0" y2="24" stroke="url(#goldLine)" stroke-width="1.5"/>
                <line x1="-42" y1="-14" x2="-10" y2="-9" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
                <line x1="-42" y1="-4" x2="-10" y2="0" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
                <line x1="-42" y1="6" x2="-10" y2="10" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
                <line x1="42" y1="-14" x2="10" y2="-9" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
                <line x1="42" y1="-4" x2="10" y2="0" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
                <line x1="42" y1="6" x2="10" y2="10" stroke="#0B6E4F" stroke-width="1.4" opacity="0.5"/>
              </g>
              <!-- corner crescent accents -->
              <g fill="url(#goldLine)" opacity="0.8">
                <path d="M40 40 a14 14 0 1 0 0.1 0 a10.5 10.5 0 1 1 -0.1 0 Z"/>
                <path d="M370 430 a14 14 0 1 0 0.1 0 a10.5 10.5 0 1 1 -0.1 0 Z"/>
              </g>
            </svg>
          </div>
          <div class="hero-float-card hfc-1" aria-hidden="true">
            <i class="fas fa-user-graduate"></i>
            <div><strong>1-to-1</strong><small>Personal Classes</small></div>
          </div>
          <div class="hero-float-card hfc-2" aria-hidden="true">
            <i class="fas fa-star"></i>
            <div><strong>Certified</strong><small>Hafiz Teacher</small></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <a href="#countries" class="scroll-down-indicator" aria-label="Scroll down">
    <span>Scroll</span><i class="fas fa-chevron-down" aria-hidden="true"></i>
  </a>
</section>