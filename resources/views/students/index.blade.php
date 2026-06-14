@extends('layout')

@section('page-title', 'Students')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>🎓 Students</h3>
            <p>Manage all registered students</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-light fw-bold">
            <i class="fas fa-plus me-2"></i>Add Student
        </a>
    </div>
</div>

{{-- Search Box --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('students.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text" style="background:white;border-right:0;">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control"
                    placeholder="Search by name, student ID, email or class..."
                    value="{{ $search ?? '' }}"
                    style="border-left:0;">
                <button class="btn btn-primary px-4" type="submit">
                    Search
                </button>
                @if($search)
                <a href="{{ route('students.index') }}" class="btn btn-secondary px-4">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

@if($search)
<p class="text-muted mb-3">
    Search results for: <strong>"{{ $search }}"</strong>
    — {{ $students->count() }} student(s) found
</p>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="badge bg-secondary">{{ $student->student_id }}</span></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div style="width:38px;height:38px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;margin-right:10px;">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <strong>{{ $student->name }}</strong>
                        </div>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->year }}</td>
                    <td>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm text-white">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this student?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="fas fa-user-graduate fa-2x mb-2 d-block"></i>
                        @if($search)
                            No students found for "{{ $search }}"
                        @else
                            No students found. Add your first student!
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection