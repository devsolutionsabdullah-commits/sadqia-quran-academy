<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #D4AF37, #b8932e); padding: 30px; text-align: center;">
      <h1 style="color: #fff; margin: 0; font-size: 24px;">⏰ Class Starting Soon</h1>
    </div>

    <div style="padding: 30px;">
      @if ($recipientType === 'student')
        <p>Hello {{ $enrollment->parent_name }},</p>
        <p><strong>{{ $enrollment->student_name }}</strong>'s <strong>{{ $enrollment->course->name }}</strong> class starts in 30 minutes.</p>
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
          <tr>
            <td style="padding: 8px 0; color: #777;">Teacher:</td>
            <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->teacher->name }}</td>
          </tr>
          <tr>
            <td style="padding: 8px 0; color: #777;">Time:</td>
            <td style="padding: 8px 0; font-weight: bold;">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} ({{ $schedule->timezone }})</td>
          </tr>
        </table>
      @else
        <p>Assalamu Alaikum Ustad {{ $enrollment->teacher->name }},</p>
        <p>Your class with <strong>{{ $enrollment->student_name }}</strong> ({{ $enrollment->course->name }}) starts in 30 minutes.</p>
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
          <tr>
            <td style="padding: 8px 0; color: #777;">Student:</td>
            <td style="padding: 8px 0; font-weight: bold;">{{ $enrollment->student_name }}</td>
          </tr>
          <tr>
            <td style="padding: 8px 0; color: #777;">Time:</td>
            <td style="padding: 8px 0; font-weight: bold;">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} ({{ $schedule->timezone }})</td>
          </tr>
        </table>
      @endif

      @if ($enrollment->teacher->teacherProfile?->meeting_link)
        <p style="margin-top: 20px;">
          <a href="{{ $enrollment->teacher->teacherProfile->meeting_link }}" style="background: #0B6E4F; color: #fff; padding: 14px 28px; text-decoration: none; border-radius: 6px; display: inline-block; font-size: 16px;">
            Join Class Now
          </a>
        </p>
      @endif

      <p style="margin-top: 30px; color: #777; font-size: 14px;">Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>