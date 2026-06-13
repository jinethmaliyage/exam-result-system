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
                        No students found. Add your first student!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection