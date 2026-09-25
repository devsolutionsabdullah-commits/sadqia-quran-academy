@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Manage Courses</h2>
      <a href="{{ route('admin.courses.create') }}" class="btn btn-trial">
        <i class="fas fa-plus me-1"></i> Add Course
      </a>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
      <table class="table align-middle mb-0">
        <thead>
          <tr>
            <th class="ps-4">Name</th>
            <th>Category</th>
            <th>Status</th>
            <th class="pe-4 text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($courses as $course)
            <tr>
              <td class="ps-4">{{ $course->name }}</td>
              <td>{{ $course->category ?? '—' }}</td>
              <td>
                <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }}">
                  {{ $course->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td class="pe-4 text-end">
                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-pen"></i>
                </a>
                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this course?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center py-4 text-muted">No courses yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection