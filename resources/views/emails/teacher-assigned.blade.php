<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #0B6E4F, #085c42); padding: 30px; text-align: center;">
      <h1 style="color: #D4AF37; margin: 0; font-size: 24px;">☽ Sadqia Quran Academy</h1>
    </div>

    <div style="padding: 30px;">
      <h2 style="color: #0B6E4F;">Your Teacher Has Been Assigned!</h2>
      <p>Assalamu Alaikum {{ $enrollment->parent_name }},</p>
      <p>Great news — a teacher has been assigned for <strong>{{ $enrollment->student_name }}</strong>'s <strong>{{ $enrollment->course->name }}</strong> classes.</p>

      <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
          <td style="padding: 8px 0; color: #777;">Teacher:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->teacher->name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Course:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->course->name }}</td>
        </tr>
      </table>

      <p>The teacher will set your class schedule shortly. You'll receive another email with the exact days, times (in your own time zone), and the live class link as soon as it's ready.</p>

      <p style="margin-top: 25px;">
        <a href="{{ route('dashboard.student') }}" style="background: #0B6E4F; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">
          View Your Dashboard
        </a>
      </p>

      <p style="margin-top: 30px; color: #777; font-size: 14px;">JazakAllah Khair,<br>Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>