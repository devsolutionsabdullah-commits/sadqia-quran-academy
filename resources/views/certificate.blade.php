<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate — {{ $enrollment->student_name }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: #f0f0f0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 30px;
    }
    .certificate {
      width: 100%;
      max-width: 900px;
      background: #fdfcf7;
      border: 10px solid #0B6E4F;
      outline: 2px solid #D4AF37;
      outline-offset: -20px;
      padding: 60px 50px;
      text-align: center;
      position: relative;
    }
    .cert-icon { font-size: 2.5rem; color: #D4AF37; margin-bottom: 10px; }
    .cert-academy { font-family: 'Cormorant Garamond', serif; font-size: 1.4rem; color: #0B6E4F; letter-spacing: 2px; text-transform: uppercase; }
    .cert-title { font-family: 'Cormorant Garamond', serif; font-size: 3rem; color: #0B6E4F; margin: 20px 0 10px; }
    .cert-subtitle { color: #777; font-size: 1rem; margin-bottom: 30px; }
    .cert-name { font-family: 'Cormorant Garamond', serif; font-size: 2.3rem; color: #D4AF37; border-bottom: 2px solid #D4AF37; display: inline-block; padding: 0 30px 8px; margin-bottom: 25px; }
    .cert-body { font-size: 1.05rem; color: #444; line-height: 1.8; max-width: 600px; margin: 0 auto 35px; }
    .cert-course { font-weight: 700; color: #0B6E4F; }
    .cert-footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 40px; padding: 0 20px; }
    .cert-footer-item { text-align: center; }
    .cert-footer-label { font-size: 0.8rem; color: #999; border-top: 1px solid #ccc; padding-top: 6px; margin-top: 4px; min-width: 160px; }
    .cert-number { position: absolute; bottom: 15px; right: 25px; font-size: 0.75rem; color: #999; }
    .print-btn {
      display: block; margin: 25px auto 0; padding: 10px 24px; background: #0B6E4F; color: #fff;
      border: none; border-radius: 6px; font-size: 15px; cursor: pointer;
    }
    @media print {
      body { background: #fff; padding: 0; }
      .print-btn { display: none; }
      .certificate { border-width: 8px; box-shadow: none; }
    }
  </style>
</head>
<body>

  <div>
    <div class="certificate">
      <div class="cert-icon">☽</div>
      <div class="cert-academy">Sadqia Quran Academy</div>
      <div class="cert-title">Certificate of Completion</div>
      <div class="cert-subtitle">This certificate is proudly presented to</div>

      <div class="cert-name">{{ $enrollment->student_name }}</div>

      <div class="cert-body">
        for successfully completing the <span class="cert-course">{{ $enrollment->course->name }}</span> course
        at Sadqia Quran Academy, demonstrating dedication and commitment to Quranic education.
      </div>

      <div class="cert-footer">
        <div class="cert-footer-item">
          <div>{{ $enrollment->completed_at?->format('d F, Y') }}</div>
          <div class="cert-footer-label">Date Completed</div>
        </div>
        <div class="cert-footer-item">
          <div style="font-family: 'Cormorant Garamond', serif; font-size: 1.3rem;">{{ $enrollment->teacher->name ?? 'Sadqia Quran Academy' }}</div>
          <div class="cert-footer-label">Instructor</div>
        </div>
      </div>

      <div class="cert-number">Certificate No: {{ $enrollment->certificate_number }}</div>
    </div>

    <button class="print-btn" onclick="window.print()">
      🖨️ Print / Save as PDF
    </button>
  </div>

</body>
</html>