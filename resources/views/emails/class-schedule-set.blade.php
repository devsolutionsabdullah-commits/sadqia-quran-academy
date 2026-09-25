<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #0B6E4F, #085c42); padding: 30px; text-align: center;">
      <h1 style="color: #D4AF37; margin: 0; font-size: 24px;">☽ Sadqia Quran Academy</h1>
    </div>

    <div style="padding: 30px;">
      <h2 style="color: #0B6E4F;">Your Class Schedule is Ready!</h2>
      <p>Assalamu Alaikum {{ $enrollment->parent_name }},</p>
      <p>Your class schedule for <strong>{{ $enrollment->student_name }}</strong>'s <strong>{{ $enrollment->course->name }}</strong> class has been set:</p>

      <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
          <td style="padding: 8px 0; color: #777;">Teacher:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->teacher->name }}</td>
        </tr>
        <tr>
          <td style="padding: 8px 0; color: #777;">Day:</td>
          <td style="padding: 8px 0; font-weight: bold;">{{ $schedule->day_of_week }}</td>
        </tr>
        @if ($studentTimeFormatted)
          <tr>
            <td style="padding: 8px 0; color: #777;">Time (your zone):</td>
            <td style="padding: 8px 0; font-weight: bold; color: #0B6E4F;">{{ $studentTimeFormatted }}</td>
          </tr>
        @endif
        <tr>
          <td style="padding: 8px 0; color: #777;">Time (teacher's zone):</td>
          <td style="padding: 8px 0;">{{ $teacherTimeFormatted }}</td>
        </tr>
      </table>

      @if ($enrollment->teacher->teacherProfile?->meeting_link)
        <p style="margin-top: 25px;">
          <a href="{{ $enrollment->teacher->teacherProfile->meeting_link }}" style="background: #0B6E4F; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">
            Join Live Class
          </a>
        </p>
        <p style="color: #777; font-size: 13px;">Save this link — it will be used for all your classes with this teacher.</p>
      @else
        <p style="color: #777;">Your teacher will share the class link shortly.</p>
      @endif

      <p style="margin-top: 25px;">
        <a href="{{ route('dashboard.student') }}" style="color: #0B6E4F;">View full schedule on your dashboard →</a>
      </p>

      <p style="margin-top: 30px; color: #777; font-size: 14px;">JazakAllah Khair,<br>Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>