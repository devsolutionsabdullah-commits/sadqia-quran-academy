<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #333; padding: 20px;">
  <h2 style="color: #0B6E4F;">New Enrollment Request</h2>
  <p>A new enrollment request has been submitted:</p>
  <table style="border-collapse: collapse; width: 100%;">
    <tr><td style="padding: 6px 0;"><strong>Student:</strong></td><td>{{ $enrollment->student_name }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>Parent:</strong></td><td>{{ $enrollment->parent_name }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>Course:</strong></td><td>{{ $enrollment->course->name }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>Age:</strong></td><td>{{ $enrollment->age }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>Country:</strong></td><td>{{ $enrollment->country }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>WhatsApp:</strong></td><td>{{ $enrollment->whatsapp_number }}</td></tr>
    <tr><td style="padding: 6px 0;"><strong>Preferred Timing:</strong></td><td>{{ $enrollment->preferred_timing ?? 'Not specified' }}</td></tr>
  </table>
  <p style="margin-top: 20px;">
    <a href="{{ route('admin.enrollments.index') }}" style="background: #0B6E4F; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 6px;">
      Assign a Teacher
    </a>
  </p>
</body>
</html>