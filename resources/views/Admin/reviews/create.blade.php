@extends('Admin.admin_dashboard')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Add Review</h1><br>
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="child_id">Child:</label>
                    <select class="form-control" id="child_id" name="child_id">
                        <option value="">Select Child</option>
                        @foreach($children as $child)
                            <option value="{{ $child->id }}">{{ $child->user->first_name }} {{ $child->user->last_name }}</option>
                        @endforeach
                    </select>
                    @error('child_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                    <div class="form-group">
                        <label for="teacher_id">Teacher:</label>
                        <select class="form-control" id="teacher_id" name="teacher_id">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->user->first_name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course_id">Course:</label>
                        <select class="form-control" id="course_id" name="course_id">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->type }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="level">Level:</label>
                        <select class="form-control" id="level" name="level">
                            <option value="">Select Level</option>
                            @foreach(\App\Enum\Level::cases() as $level)
                                <option value="{{ $level->value }}">{{ $level->value }}</option>
                            @endforeach
                        </select>
                        @error('level')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
