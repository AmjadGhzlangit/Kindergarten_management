@extends('Admin.admin_dashboard')

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">{{ $course->name }}</h4>
      <p><strong>Teacher ID:</strong> {{ $course->teacher_id }}</p>
      <p><strong>Type:</strong> {{ $course->type }}</p>
      <p><strong>Description:</strong> {{ $course->description }}</p>
      <div class="btn-group" role="group" aria-label="Course Actions">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
