<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #0B6E4F, #085c42); padding: 30px; text-align: center;">
      <h1 style="color: #D4AF37; margin: 0; font-size: 24px;">☽ Sadqia Quran Academy</h1>
    </div>

    <div style="padding: 30px;">
      <h2 style="color: #0B6E4F;">JazakAllah Khair, {{ $enrollment->parent_name }}!</h2>
      <p>We've received your enrollment request for <strong>{{ $enrollment->student_name }}</strong> and we're excited to begin this Quran learning journey together.</p>

      <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
          <td style="padding: 8px 0; color: #777;">Course:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->course->name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Student:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->student_name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Status:</td>
          <td style="padding: 8px 0;"><span style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 12px; font-size: 13px;">Pending Teacher Assignment</span></td>
        </tr>
      </table>

      <p>Our team will assign a qualified teacher and reach out to you via WhatsApp or email within a few hours to schedule your <strong>free trial class</strong>.</p>

      <p style="margin-top: 25px;">
        <a href="{{ route('dashboard.student') }}" style="background: #0B6E4F; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">
          View Your Dashboard
        </a>
      </p>

      <p style="margin-top: 30px; color: #777; font-size: 14px;">May Allah bless your Quran journey. 🤲<br>— Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>