@extends('layouts.app')

@section('content')
<section class="py-5" style="min-height: 80vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <h2 class="mb-4" style="font-family: 'Cormorant Garamond', serif; color: var(--primary, #0B6E4F);">Edit Course</h2>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="p-4" style="background: var(--card-bg, #fff); border-radius: 16px; border: 1px solid rgba(212,175,55,0.25);">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $course->category) }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
          </div>

          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $course->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active (visible to students)</label>
          </div>

          <button type="submit" class="btn btn-trial px-4">Update Course</button>
          <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection