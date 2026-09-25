@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <h2 class="mb-4" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Enrollments</h2>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th class="ps-4">Student</th>
            <th>Course</th>
            <th>Status</th>
            <th>Teacher</th>
            <th>Assign Teacher</th>
            <th>Fee</th>
            <th class="pe-4">Certificate</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($enrollments as $enrollment)
            <tr>
              <td class="ps-4">{{ $enrollment->student->name }}</td>
              <td>{{ $enrollment->course->name }}</td>
              <td>
                <span class="badge bg-{{ $enrollment->status === 'active' ? 'success' : ($enrollment->status === 'pending' ? 'warning' : 'secondary') }}">
                  {{ ucfirst($enrollment->status) }}
                </span>
              </td>
              <td>{{ $enrollment->teacher->name ?? '—' }}</td>
              <td>
                <form action="{{ route('admin.enrollments.assign', $enrollment) }}" method="POST" class="d-flex gap-2">
                  @csrf
                  <select name="teacher_id" class="form-select form-select-sm" required>
                    <option value="">Select teacher</option>
                    @foreach ($teachers as $teacher)
                      <option value="{{ $teacher->id }}" {{ $enrollment->teacher_id === $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                      </option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-sm btn-trial">Assign</button>
                </form>
              </td>
              <td>
                <form action="{{ route('admin.fees.update', $enrollment) }}" method="POST" class="d-flex flex-column gap-1" style="min-width: 200px;">
                  @csrf
                  <div class="d-flex gap-1">
                    <input type="number" name="amount" step="0.01" class="form-control form-control-sm" placeholder="$" value="{{ $enrollment->fee?->amount ?? '' }}">
                    <select name="status" class="form-select form-select-sm">
                      <option value="pending" {{ ($enrollment->fee?->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="paid" {{ ($enrollment->fee?->status ?? '') === 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                  </div>
                  <input type="date" name="due_date" class="form-control form-control-sm" value="{{ $enrollment->fee?->due_date?->format('Y-m-d') }}">
                  <button type="submit" class="btn btn-sm btn-outline-secondary">Save Fee</button>
                </form>
              </td>
              <td class="pe-4">
                @if ($enrollment->certificate_number)
                  <a href="{{ route('certificates.show', $enrollment) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-award"></i> View
                  </a>
                @else
                  <form action="{{ route('certificates.issue', $enrollment) }}" method="POST" onsubmit="return confirm('Issue certificate for this student?');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-trial">Issue</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-4 text-muted">No enrollments yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection