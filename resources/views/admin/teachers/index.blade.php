@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Manage Teachers</h2>
      <a href="{{ route('admin.teachers.create') }}" class="btn btn-trial">
        <i class="fas fa-plus me-1"></i> Add Teacher
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
            <th>Email</th>
            <th class="pe-4 text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($teachers as $teacher)
            <tr>
              <td class="ps-4">{{ $teacher->name }}</td>
              <td>{{ $teacher->email }}</td>
              <td class="pe-4 text-end">
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-pen"></i></a>
                <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this teacher account?');">
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
              <td colspan="3" class="text-center py-4 text-muted">No teachers added yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection