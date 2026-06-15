@extends('layout')

@section('page-title', 'Students')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <div class="pro-kicker">Student Registry</div>
                    <h3>Students</h3>
                    <p>Maintain student records, contact details, classes, and enrollment years.</p>
                </div>
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-light fw-bold">
                <i class="fas fa-plus me-2"></i>Add Student
            </a>
        </div>
    </div>

    <div class="card pro-filter mb-4">
        <div class="card-body py-3">
            <form action="{{ route('students.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name, student ID, email, or class"
                        value="{{ $search ?? '' }}">
                    <button class="btn btn-primary px-4" type="submit">
                        <i class="fas fa-filter me-2"></i>Search
                    </button>
                    @if($search)
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-4">
                        Clear
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if($search)
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Search results for <strong>"{{ $search }}"</strong>: {{ $students->count() }} student(s) found.
    </div>
    @endif

    <div class="card pro-card">
        <div class="card-header">
            <h5 class="pro-section-title">Student Records</h5>
            <span class="pro-pill pro-pill-blue">{{ $students->count() }} total</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover pro-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Year</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td><span class="pro-pill pro-pill-gray">{{ $student->student_id }}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pro-avatar">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <strong>{{ $student->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->year }}</td>
                        <td>
                            <div class="pro-row-actions justify-content-end">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm text-white" title="View student">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm" title="Edit student">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this student?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Delete student"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted pro-empty">
                            <i class="fas fa-user-graduate fa-lg"></i>
                            <div class="fw-semibold">
                                @if($search)
                                    No students found for "{{ $search }}".
                                @else
                                    No students found. Add your first student.
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
