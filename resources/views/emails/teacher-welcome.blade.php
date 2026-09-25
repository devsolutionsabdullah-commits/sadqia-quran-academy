<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px; background: #f8f9fa;">
  <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

    <div style="background: linear-gradient(135deg, #0B6E4F, #085c42); padding: 30px; text-align: center;">
      <h1 style="color: #D4AF37; margin: 0; font-size: 24px;">☽ Sadqia Quran Academy</h1>
    </div>

    <div style="padding: 30px;">
      <h2 style="color: #0B6E4F;">Welcome to the Team, Ustad {{ $name }}!</h2>
      <p>An account has been created for you at Sadqia Quran Academy. You can now login to manage your assigned students, class schedules, attendance, and more.</p>

      <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background: #f8f9fa; border-radius: 8px;">
        <tr>
          <td style="padding: 12px; color: #777;">Email:</td>
          <td style="padding: 12px; font-weight: bold;">{{ $email }}</td>
        </tr>
        <tr>
          <td style="padding: 12px; color: #777;">Password:</td>
          <td style="padding: 12px; font-weight: bold;">{{ $password }}</td>
        </tr>
      </table>

      <p style="color: #b8860b;"><i class="fas fa-triangle-exclamation"></i> For your security, please login and consider this password confidential.</p>

      <p style="margin-top: 25px;">
        <a href="{{ route('login') }}" style="background: #0B6E4F; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 6px; display: inline-block;">
          Login to Your Dashboard
        </a>
      </p>

      <p style="margin-top: 30px; color: #777; font-size: 14px;">JazakAllah Khair,<br>Sadqia Quran Academy</p>
    </div>

  </div>
</body>
</html>