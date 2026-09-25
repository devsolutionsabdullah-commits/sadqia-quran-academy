/* ============================================================
   SADQIA QURAN ACADEMY — script.js
   Premium Landing Page · All Interactions
   Handles: Preloader · Typed.js · Swiper · CountUp
            Dark Mode · Scroll Progress · Navbar
            Ripple · Form · Back To Top · Lazy Load
            Progress Bars · Smooth Scroll · Animations
   ============================================================ */

'use strict';

/* ============================================================
   PRELOADER
   Animated counter 0→100% then fades out and fires initAll()
   ============================================================ */
(function runPreloader() {
  const preloader = document.getElementById('preloader');
  const counter   = document.getElementById('preloaderCounter');
  const fill      = document.getElementById('preloaderFill');

  if (!preloader) { initAll(); return; }

  // Prevent flash of content while loading
  document.body.style.overflow = 'hidden';

  let progress = 0;
  const interval = setInterval(() => {
    // Random increment for organic feel
    progress += Math.random() * 14 + 4;

    if (progress >= 100) {
      progress = 100;
      clearInterval(interval);

      if (counter) counter.textContent = '100%';
      if (fill)    fill.style.width    = '100%';

      // Small delay so user sees 100%, then dismiss
      setTimeout(() => {
        preloader.classList.add('gone');
        document.body.style.overflow = '';

        // Fire everything once preloader is hidden
        preloader.addEventListener('transitionend', initAll, { once: true });

        // Safety fallback in case transitionend never fires
        setTimeout(initAll, 600);
      }, 380);
    }

    if (counter) counter.textContent = Math.round(progress) + '%';
    if (fill)    fill.style.width    = progress + '%';
  }, 80);
})();

/* ============================================================
   INIT ALL — called once preloader exits
   Guard flag prevents double-init from the safety fallback
   ============================================================ */
let _inited = false;
function initAll() {
  if (_inited) return;
  _inited = true;

  initAOS();
  initTyped();
  initSwiper();
  initCountUp();
  initScrollProgress();
  initNavbar();
  initDarkMode();
  initBackToTop();
  initRipple();
  initForm();
  initProgressBars();
  initSmoothScroll();
  initLazyLoad();
}

/* ============================================================
   AOS — Animate On Scroll
   ============================================================ */
function initAOS() {
  if (typeof AOS === 'undefined') return;
  AOS.init({
    duration: 780,
    easing:   'ease-out-cubic',
    once:     true,
    offset:   55,
    delay:    0,
  });
}

/* ============================================================
   TYPED.JS — Hero Heading Typing Animation
   ============================================================ */
function initTyped() {
  const el = document.getElementById('typedTarget');
  if (!el || typeof Typed === 'undefined') {
    // Fallback: just show first string as static text
    if (el) el.textContent = 'Learn Quran Online with Certified Hafiz';
    return;
  }

  new Typed('#typedTarget', {
    strings: [
      'Learn Quran Online with&nbsp;Certified Hafiz',
      'One-to-One Quran Classes for All Ages',
      'Professional Tajweed &amp;&nbsp;Hifz Programs',
      'Authentic Islamic Education from&nbsp;Home',
    ],
    typeSpeed:    44,
    backSpeed:    22,
    backDelay:    2400,
    startDelay:   600,
    loop:         true,
    smartBackspace: true,
    cursorChar:   '|',
  });
}

/* ============================================================
   SWIPER.JS — Testimonials Slider
   ============================================================ */
function initSwiper() {
  if (typeof Swiper === 'undefined') return;

  new Swiper('.testimonial-swiper', {
    slidesPerView:  1,
    spaceBetween:   28,
    loop:           true,
    grabCursor:     true,
    autoplay: {
      delay:              5200,
      disableOnInteraction: false,
      pauseOnMouseEnter:  true,
    },
    pagination: {
      el:        '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      // ≥992px — show 2 slides
      992: {
        slidesPerView: 2,
        spaceBetween:  28,
      },
    },
    a11y: {
      prevSlideMessage: 'Previous testimonial',
      nextSlideMessage: 'Next testimonial',
    },
  });
}

/* ============================================================
   COUNTER ANIMATION — CountUp.js with plain fallback
   Triggers when stat section enters viewport via
   IntersectionObserver so numbers only count once visible.
   ============================================================ */
function initCountUp() {
  const elements = document.querySelectorAll('.countup');
  if (!elements.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      if (entry.target.dataset.counted) return;

      entry.target.dataset.counted = 'true';
      observer.unobserve(entry.target);

      const target = parseInt(entry.target.dataset.target, 10);
      animateCounter(entry.target, 0, target, 2200);
    });
  }, { threshold: 0.55 });

  elements.forEach(el => observer.observe(el));
}

/**
 * Plain JS counter — no library dependency
 * Uses requestAnimationFrame for smooth 60fps animation
 */
function animateCounter(el, from, to, duration) {
  const startTime = performance.now();

  function tick(now) {
    const elapsed  = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    // easeOutExpo for a natural deceleration feel
    const eased    = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
    const value    = Math.round(from + (to - from) * eased);

    el.textContent = value;

    if (progress < 1) {
      requestAnimationFrame(tick);
    } else {
      el.textContent = to; // guarantee exact final value
    }
  }

  requestAnimationFrame(tick);
}

/* ============================================================
   SCROLL PROGRESS BAR
   ============================================================ */
function initScrollProgress() {
  const bar = document.getElementById('scrollProgress');
  if (!bar) return;

  function updateBar() {
    const scrollTop    = window.scrollY;
    const docHeight    = document.documentElement.scrollHeight;
    const windowHeight = window.innerHeight;
    const scrollable   = docHeight - windowHeight;
    const pct          = scrollable > 0 ? (scrollTop / scrollable) * 100 : 0;
    bar.style.width    = pct + '%';
  }

  window.addEventListener('scroll', updateBar, { passive: true });
  updateBar(); // initialise
}

/* ============================================================
   NAVBAR
   • shrinks on scroll
   • highlights active nav link based on viewport section
   • closes mobile menu when a link is clicked
   ============================================================ */
function initNavbar() {
  const nav      = document.getElementById('mainNav');
  const navLinks = document.querySelectorAll('#mainNav .nav-link');
  const sections = Array.from(document.querySelectorAll('section[id]'));
  const btt      = document.getElementById('backToTop');

  if (!nav) return;

  function onScroll() {
    const y = window.scrollY;

    // Shrink navbar
    nav.classList.toggle('scrolled', y > 60);

    // Back-to-top visibility
    if (btt) btt.classList.toggle('show', y > 420);

    // Active link highlight
    let current = '';
    sections.forEach(sec => {
      const top = sec.offsetTop - nav.offsetHeight - 24;
      if (y >= top) current = sec.id;
    });

    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      link.classList.toggle('active', href === '#' + current);
    });
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load

  // Close mobile menu on link click
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      const collapseEl = document.getElementById('navContent');
      if (collapseEl && collapseEl.classList.contains('show')) {
        const bsInstance = bootstrap.Collapse.getInstance(collapseEl);
        if (bsInstance) bsInstance.hide();
      }
    });
  });
}

/* ============================================================
   DARK MODE TOGGLE
   Persists preference to localStorage.
   Syncs both mobile & desktop toggle icon.
   ============================================================ */
function initDarkMode() {
  const html        = document.documentElement;
  const btnMobile   = document.getElementById('themeToggleMobile');
  const btnDesktop  = document.getElementById('themeToggleDesktop');
  const iconMobile  = document.getElementById('themeIconMobile');
  const iconDesktop = document.getElementById('themeIconDesktop');

  // Restore saved preference on load
  const saved = localStorage.getItem('sqa-theme');
  if (saved) {
    html.setAttribute('data-theme', saved);
    syncIcons(saved);
  }

  function toggle() {
    const current = html.getAttribute('data-theme') || 'light';
    const next    = current === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('sqa-theme', next);
    syncIcons(next);
  }

  function syncIcons(theme) {
    const cls = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    if (iconMobile)  iconMobile.className  = cls;
    if (iconDesktop) iconDesktop.className = cls;
  }

  if (btnMobile)  btnMobile.addEventListener('click', toggle);
  if (btnDesktop) btnDesktop.addEventListener('click', toggle);
}

/* ============================================================
   BACK TO TOP
   ============================================================ */
function initBackToTop() {
  const btn = document.getElementById('backToTop');
  if (!btn) return;

  btn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/* ============================================================
   RIPPLE EFFECT
   Creates a spreading circle on any .btn-ripple element click.
   ============================================================ */
function initRipple() {
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-ripple');
    if (!btn) return;

    const rect   = btn.getBoundingClientRect();
    const x      = e.clientX - rect.left;
    const y      = e.clientY - rect.top;
    const size   = 100;

    const dot = document.createElement('span');
    dot.classList.add('ripple-dot');
    dot.style.cssText = [
      `width:${size}px`,
      `height:${size}px`,
      `left:${x - size / 2}px`,
      `top:${y - size / 2}px`,
    ].join(';');

    btn.appendChild(dot);
    dot.addEventListener('animationend', () => dot.remove(), { once: true });
  });
}

/* ============================================================
   ENROLLMENT FORM
   Bootstrap 5 validation only. Actual submission is handled by
   the Laravel backend (EnrollmentController@store) — the form
   posts normally to the server when valid.
   ============================================================ */
function initForm() {
  const form = document.getElementById('enrollForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
    form.classList.add('was-validated');
    // Valid submissions continue on to the server normally.
  });
}

/* ============================================================
   PROGRESS BARS (Student Progress Section)
   Resets widths to 0 then animates to target once visible.
   ============================================================ */
function initProgressBars() {
  const bars = document.querySelectorAll('.pc-bar-fill');
  if (!bars.length) return;

  // Store target widths before resetting to 0
  bars.forEach(bar => {
    bar.dataset.target = bar.style.width || '0%';
    bar.style.width    = '0%';
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      // Animate all bars when any one enters viewport
      bars.forEach((bar, i) => {
        setTimeout(() => {
          bar.style.width = bar.dataset.target;
        }, i * 120); // stagger each bar slightly
      });
      observer.disconnect();
    });
  }, { threshold: 0.35 });

  // Observe the progress card wrapper
  const card = document.querySelector('.prog-card');
  if (card) observer.observe(card);
}

/* ============================================================
   SMOOTH SCROLL
   Handles all internal anchor clicks (#section) with offset
   to account for the sticky navbar height.
   Bootstrap handles its own accordion links — we exclude those.
   ============================================================ */
function initSmoothScroll() {
  document.addEventListener('click', function (e) {
    const anchor = e.target.closest('a[href^="#"]');
    if (!anchor) return;

    const href = anchor.getAttribute('href');
    if (!href || href === '#') return;

    // Let Bootstrap accordion links work normally
    if (anchor.dataset.bsToggle) return;

    const target = document.querySelector(href);
    if (!target) return;

    e.preventDefault();

    const nav    = document.getElementById('mainNav');
    const offset = nav ? nav.offsetHeight + 10 : 70;
    const top    = target.getBoundingClientRect().top + window.scrollY - offset;

    window.scrollTo({ top, behavior: 'smooth' });
  });
}

/* ============================================================
   LAZY LOAD — polyfill for browsers without native support
   ============================================================ */
function initLazyLoad() {
  // Native lazy loading is supported in all modern browsers
  if ('loading' in HTMLImageElement.prototype) return;

  const imgs = document.querySelectorAll('img[loading="lazy"]');
  if (!imgs.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const img = entry.target;
      if (img.dataset.src) img.src = img.dataset.src;
      img.removeAttribute('loading');
      observer.unobserve(img);
    });
  }, { rootMargin: '200px' });

  imgs.forEach(img => observer.observe(img));
}

/* ============================================================
   NAVBAR BORDER FADE on hero section
   Removes the bottom border of the nav while it sits on top
   of the dark hero background so it looks fully seamless.
   ============================================================ */
(function initNavHeroBorder() {
  const nav  = document.getElementById('mainNav');
  const hero = document.getElementById('home');
  if (!nav || !hero) return;

  function update() {
    const heroBottom = hero.offsetTop + hero.offsetHeight;
    if (window.scrollY < heroBottom * 0.35) {
      nav.style.borderBottomColor = 'transparent';
    } else {
      nav.style.borderBottomColor = '';
    }
  }

  window.addEventListener('scroll', update, { passive: true });
  update();
})();

/* ============================================================
   HOVER PARALLAX on Hero Image
   Subtle mouse-follow tilt on the hero image frame.
   Only runs on devices that actually have a mouse (pointer:fine).
   ============================================================ */
(function initHeroParallax() {
  const frame = document.querySelector('.hero-image-frame');
  if (!frame) return;
  if (!window.matchMedia('(pointer:fine)').matches) return;

  const MAX_TILT = 8; // degrees

  frame.addEventListener('mousemove', e => {
    const rect   = frame.getBoundingClientRect();
    const cx     = rect.left + rect.width  / 2;
    const cy     = rect.top  + rect.height / 2;
    const dx     = (e.clientX - cx) / (rect.width  / 2);
    const dy     = (e.clientY - cy) / (rect.height / 2);
    const rotateX = (-dy * MAX_TILT).toFixed(2);
    const rotateY = ( dx * MAX_TILT).toFixed(2);

    frame.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    frame.style.transition = 'transform 0.12s linear';
  });

  frame.addEventListener('mouseleave', () => {
    frame.style.transform  = '';
    frame.style.transition = 'transform 0.45s ease';
  });
})();

/* ============================================================
   FLOATING CARDS PARALLAX on Scroll (hero section)
   Adds a subtle vertical offset to the floating stat cards
   as the user scrolls, reinforcing the layered depth.
   ============================================================ */
(function initFloatParallax() {
  const cards = document.querySelectorAll('.hero-float-card');
  if (!cards.length) return;

  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    cards.forEach((card, i) => {
      // alternating directions, differing speeds
      const dir   = i % 2 === 0 ? 1 : -1;
      const speed = 0.06 + i * 0.02;
      card.style.transform = `translateY(${dir * y * speed}px)`;
    });
  }, { passive: true });
})();

/* ============================================================
   COURSE CARD ENTRANCE
   Staggers course card AOS delay programmatically so each
   row animates in a clean cascade regardless of screen size.
   ============================================================ */
(function staggerCourseCards() {
  const cards = document.querySelectorAll('.course-card');
  cards.forEach((card, i) => {
    const col = card.closest('[data-aos]');
    if (col) col.setAttribute('data-aos-delay', String((i % 3) * 80));
  });
})();

/* ============================================================
   FAQ ACCORDION ICON ANIMATION
   Adds a rotating icon to each accordion button for a more
   polished feel beyond Bootstrap's default arrow.
   ============================================================ */
(function initFaqIcons() {
  const buttons = document.querySelectorAll('.faq-item .accordion-button');
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      // tiny color flash on open
      if (!btn.classList.contains('collapsed')) {
        btn.style.transition = 'color 0.2s';
      }
    });
  });
})();

/* ============================================================
   TESTIMONIAL CARD HOVER ELEVATION
   Lifts the active Swiper slide slightly on mouseenter.
   ============================================================ */
(function initTestCardHover() {
  document.addEventListener('mouseenter', e => {
    const card = e.target.closest('.test-card');
    if (!card) return;
    card.style.transform  = 'translateY(-5px)';
    card.style.boxShadow  = 'var(--shadow-lg)';
    card.style.transition = 'transform 0.25s ease, box-shadow 0.25s ease';
  }, true);

  document.addEventListener('mouseleave', e => {
    const card = e.target.closest('.test-card');
    if (!card) return;
    card.style.transform = '';
    card.style.boxShadow = '';
  }, true);
})();

/* ============================================================
   STICKY WHATSAPP — hide during contact section
   When the user is already in the contact section the sticky
   WhatsApp button is redundant, so we fade it out cleanly.
   ============================================================ */
(function initWaVisibility() {
  const wa      = document.querySelector('.sticky-wa');
  const contact = document.getElementById('contact');
  if (!wa || !contact) return;

  window.addEventListener('scroll', () => {
    const rect     = contact.getBoundingClientRect();
    const inContact = rect.top <= window.innerHeight && rect.bottom >= 0;
    wa.style.opacity   = inContact ? '0' : '';
    wa.style.pointerEvents = inContact ? 'none' : '';
  }, { passive: true });
})();

/* ============================================================
   COUNTRY CARD TOOLTIP
   Shows a subtle "Accepting students" label under each flag
   on hover for added trust-building detail.
   ============================================================ */
(function initCountryTooltips() {
  const cards = document.querySelectorAll('.country-card');
  cards.forEach(card => {
    card.setAttribute('title', 'Accepting students');
    card.setAttribute('role', 'img');
    card.setAttribute('aria-label', (card.querySelector('.c-name')?.textContent || '') + ' — Accepting students');
  });
})();

/* ============================================================
   STAT SECTION BACKGROUND PARTICLES
   Draws subtle animated dots on a canvas inside stats section
   for added premium depth. Degrades gracefully if canvas
   is not supported or user prefers reduced motion.
   ============================================================ */
(function initStatParticles() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const section = document.querySelector('.stats-section');
  if (!section) return;

  const canvas  = document.createElement('canvas');
  canvas.setAttribute('aria-hidden', 'true');
  canvas.style.cssText = [
    'position:absolute', 'inset:0',
    'width:100%', 'height:100%',
    'pointer-events:none', 'z-index:0',
  ].join(';');
  section.style.position = section.style.position || 'relative';
  section.insertBefore(canvas, section.firstChild);

  const ctx     = canvas.getContext('2d');
  let particles = [];
  let raf;

  function resize() {
    canvas.width  = section.offsetWidth;
    canvas.height = section.offsetHeight;
  }

  function Particle() {
    this.reset();
  }
  Particle.prototype.reset = function () {
    this.x   = Math.random() * canvas.width;
    this.y   = Math.random() * canvas.height;
    this.r   = Math.random() * 1.5 + 0.4;
    this.dx  = (Math.random() - 0.5) * 0.4;
    this.dy  = (Math.random() - 0.5) * 0.4;
    this.a   = Math.random() * 0.35 + 0.08;
  };
  Particle.prototype.update = function () {
    this.x += this.dx;
    this.y += this.dy;
    if (this.x < 0 || this.x > canvas.width ||
        this.y < 0 || this.y > canvas.height) this.reset();
  };

  function init() {
    resize();
    particles = Array.from({ length: 55 }, () => new Particle());
  }

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
      p.update();
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(212,175,55,${p.a})`;
      ctx.fill();
    });
    raf = requestAnimationFrame(draw);
  }

  // Use IntersectionObserver to only animate when visible (performance)
  const io = new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting) {
      if (!raf) { init(); draw(); }
    } else {
      cancelAnimationFrame(raf);
      raf = null;
    }
  }, { threshold: 0.1 });
  io.observe(section);

  window.addEventListener('resize', () => {
    resize();
    particles.forEach(p => p.reset());
  }, { passive: true });
})();

/* ============================================================
   FORM INPUT FLOATING LABELS ENHANCEMENT
   Adds a subtle border-color pulse when a required field
   that was invalid gets corrected by the user.
   ============================================================ */
(function initFormFeedback() {
  const form = document.getElementById('enrollForm');
  if (!form) return;

  form.querySelectorAll('.ci-input').forEach(input => {
    input.addEventListener('input', function () {
      if (this.checkValidity()) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
      }
    });
  });
})();

/* ============================================================
   SCROLL-TRIGGERED SECTION HEADINGS
   Adds a colour underline animation to each section-title
   as it enters the viewport for extra visual polish.
   ============================================================ */
(function initHeadingUnderlines() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const style = document.createElement('style');
  style.textContent = `
    .section-title { position: relative; display: inline-block; }
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -4px; left: 0;
      height: 2px; width: 0%;
      background: linear-gradient(90deg, var(--clr-primary), var(--clr-gold));
      border-radius: 999px;
      transition: width 0.65s cubic-bezier(0,0,0.2,1) 0.2s;
    }
    .section-title.line-in::after { width: 60%; }
  `;
  document.head.appendChild(style);

  const titles = document.querySelectorAll('.section-header .section-title');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('line-in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.6 });

  titles.forEach(t => io.observe(t));
})();

/* ============================================================
   BACK-TO-TOP KEYBOARD SHORTCUT
   Pressing Alt + ↑ scrolls the user back to the top — a nice
   UX touch for keyboard / power users.
   ============================================================ */
document.addEventListener('keydown', e => {
  if (e.altKey && e.key === 'ArrowUp') {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
});

/* ============================================================
   ACTIVE NAV INDICATOR — underline accent on active link
   Appends a tiny green dot below the currently active nav
   link for an extra premium touch.
   ============================================================ */
(function initNavDot() {
  const style = document.createElement('style');
  style.textContent = `
    .nav-link.active::after {
      content:'';
      position:absolute;
      bottom:2px; left:50%;
      transform:translateX(-50%);
      width:5px; height:5px;
      background:var(--clr-gold);
      border-radius:50%;
    }
    #mainNav .nav-link { position:relative; }
  `;
  document.head.appendChild(style);
})();

/* ============================================================
   CONSOLE SIGNATURE
   A branded console message for developers who inspect the
   site — a nice professional touch.
   ============================================================ */
(function consoleSignature() {
  const style = [
    'background:linear-gradient(135deg,#0B6E4F,#D4AF37)',
    'color:#fff',
    'padding:8px 20px',
    'border-radius:4px',
    'font-size:14px',
    'font-weight:bold',
    'letter-spacing:1px',
  ].join(';');

  console.log('%c ☽ Sadqia Quran Academy ', style);
  console.log('%cBuilt with ♥ | devsolutionsabdullah@gmail.com', 'color:#0B6E4F;font-size:12px;');
})();