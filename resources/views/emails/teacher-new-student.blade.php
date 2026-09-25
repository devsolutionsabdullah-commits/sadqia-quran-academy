<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #0B6E4F, #085c42); padding: 30px; text-align: center;">
      <h1 style="color: #D4AF37; margin: 0; font-size: 24px;">☽ Sadqia Quran Academy</h1>
    </div>

    <div style="padding: 30px;">
      <h2 style="color: #0B6E4F;">New Student Assigned to You</h2>
      <p>Assalamu Alaikum {{ $enrollment->teacher->name }},</p>
      <p>A new student has been assigned to you:</p>

      <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
          <td style="padding: 8px 0; color: #777;">Student:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->student_name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Course:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->course->name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Student Time Zone:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->timezone ?? 'Not specified' }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Preferred Timing:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->preferred_timing ?? 'Flexible' }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Student Email:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->student->email }}</td>
        </tr>
      </table>

      <p>Please login to your dashboard and set a class schedule for this student — this will notify them with the days, times, and your meeting link.</p>

      <p style="margin-top: 25px;">
        <a href="{{ route('dashboard.teacher') }}" style="background: #0B6E4F; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">
          Set Class Schedule
        </a>
      </p>

      <p style="margin-top: 30px; color: #777; font-size: 14px;">JazakAllah Khair,<br>Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>