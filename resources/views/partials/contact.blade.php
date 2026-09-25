<!-- ============================
     CONTACT SECTION
============================= -->
<section id="contact" class="contact-section" aria-label="Contact and enrollment form">
  <div class="container">
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <div class="section-eyebrow">Get In Touch</div>
      <h2 class="section-title">Book Your Free Trial Class</h2>
      <p class="section-subtitle">Fill in the form below and we'll get back to you within a few hours. Or message us on WhatsApp.</p>
    </div>

    <div class="row g-5">

      <!-- Info -->
      <div class="col-lg-4" data-aos="fade-right">
        <div class="contact-info-box">
          <h3 class="ci-title">Contact Information</h3>

          <div class="ci-item">
            <div class="ci-icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
            <div>
              <strong>Email Us</strong>
              <a href="mailto:devsolutionsabdullah@gmail.com">devsolutionsabdullah@gmail.com</a>
            </div>
          </div>
          <div class="ci-item">
            <div class="ci-icon" aria-hidden="true"><i class="fab fa-whatsapp"></i></div>
            <div>
              <strong>WhatsApp</strong>
              <a href="https://wa.me/923063813338" target="_blank" rel="noopener noreferrer">Chat With Us Now</a>
            </div>
          </div>
          <div class="ci-item">
            <div class="ci-icon" aria-hidden="true"><i class="fas fa-globe"></i></div>
            <div>
              <strong>Teaching Worldwide</strong>
              <span>USA, UK, Canada, Australia, UAE &amp; more</span>
            </div>
          </div>
          <div class="ci-item">
            <div class="ci-icon" aria-hidden="true"><i class="fas fa-clock"></i></div>
            <div>
              <strong>Response Time</strong>
              <span>Within a few hours</span>
            </div>
          </div>

          <a href="https://wa.me/923063813338?text=Assalamu%20Alaikum%2C%20I%20want%20to%20book%20a%20free%20Quran%20class."
             class="btn btn-wa-solid btn-ripple w-100 mt-4" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-whatsapp" aria-hidden="true"></i> Start on WhatsApp
          </a>
        </div>
      </div>

      <!-- Form -->
      <div class="col-lg-8" data-aos="fade-left">
        <div class="contact-form-box">

          @if (session('success'))
            <div class="form-success" role="alert" aria-live="polite">
              <div class="success-icon" aria-hidden="true"><i class="fas fa-check-circle"></i></div>
              <h4>JazakAllah Khair! Your Request Has Been Received.</h4>
              <p>{{ session('success') }} We'll contact you via WhatsApp or email within a few hours. May Allah bless your Quran journey. 🤲</p>
            </div>
          @endif

          @auth
            <form id="enrollForm" method="POST" action="{{ route('enrollments.store') }}" novalidate aria-label="Enrollment inquiry form">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="fStudentName">Student Name <span class="req" aria-hidden="true">*</span></label>
                  <input type="text" name="student_name" class="form-control ci-input" id="fStudentName" placeholder="Student's full name" value="{{ old('student_name') }}" required autocomplete="name" />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fParentName">Parent / Guardian Name <span class="req" aria-hidden="true">*</span></label>
                  <input type="text" name="parent_name" class="form-control ci-input" id="fParentName" placeholder="Parent's full name" value="{{ old('parent_name', Auth::user()->name) }}" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fAge">Student Age <span class="req" aria-hidden="true">*</span></label>
                  <input type="number" name="age" class="form-control ci-input" id="fAge" placeholder="e.g. 8" min="4" max="80" value="{{ old('age') }}" required />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fCountry">Country <span class="req" aria-hidden="true">*</span></label>
                  <select name="country" class="form-select ci-input" id="fCountry" required>
                    <option value="" disabled selected>Select your country</option>
                    <option>USA</option>
                    <option>United Kingdom</option>
                    <option>Canada</option>
                    <option>Australia</option>
                    <option>New Zealand</option>
                    <option>UAE</option>
                    <option>Saudi Arabia</option>
                    <option>Qatar</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fTimezone">Time Zone</label>
                  <select name="timezone" class="form-select ci-input" id="fTimezone">
                    <option value="" selected>Select your time zone</option>
                    <option value="America/New_York">Eastern Time (US &amp; Canada)</option>
                    <option value="America/Chicago">Central Time (US &amp; Canada)</option>
                    <option value="America/Denver">Mountain Time (US &amp; Canada)</option>
                    <option value="America/Los_Angeles">Pacific Time (US &amp; Canada)</option>
                    <option value="Europe/London">London (UK)</option>
                    <option value="Australia/Sydney">Sydney (Australia)</option>
                    <option value="Australia/Perth">Perth (Australia)</option>
                    <option value="Pacific/Auckland">Auckland (New Zealand)</option>
                    <option value="Asia/Dubai">Dubai (UAE)</option>
                    <option value="Asia/Riyadh">Riyadh (Saudi Arabia)</option>
                    <option value="Asia/Qatar">Doha (Qatar)</option>
                    <option value="Asia/Karachi">Pakistan</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fCourse">Course Interested In <span class="req" aria-hidden="true">*</span></label>
                  <select name="course_id" class="form-select ci-input" id="fCourse" required>
                    <option value="" disabled selected>Select a course</option>
                    @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fTiming">Preferred Class Timing</label>
                  <input type="text" name="preferred_timing" class="form-control ci-input" id="fTiming" placeholder="e.g. Weekdays 6–8 PM" value="{{ old('preferred_timing') }}" />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="fWhatsApp">WhatsApp Number <span class="req" aria-hidden="true">*</span></label>
                  <input type="tel" name="whatsapp_number" class="form-control ci-input" id="fWhatsApp" placeholder="+1 234 567 8900" value="{{ old('whatsapp_number') }}" required autocomplete="tel" />
                </div>
                <div class="col-12">
                  <label class="form-label" for="fMessage">Message (Optional)</label>
                  <textarea name="message" class="form-control ci-input" id="fMessage" rows="4" placeholder="Any questions or additional information you'd like to share...">{{ old('message') }}</textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary-cust btn-ripple btn-submit w-100">
                    <i class="fas fa-paper-plane me-2" aria-hidden="true"></i>Send Enrollment Request
                  </button>
                </div>
              </div>
            </form>
          @else
            <div class="text-center py-5">
              <i class="fas fa-lock mb-3" style="font-size: 2rem; color: var(--gold, #D4AF37);"></i>
              <h4>Login Required</h4>
              <p class="text-muted">Please login or create a free account to submit an enrollment request.</p>
              <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary px-4">Login</a>
                <a href="{{ route('register') }}" class="btn btn-trial px-4">Register</a>
              </div>
            </div>
          @endauth

        </div>
      </div>

    </div>
  </div>
</section>