@extends('layout')

@section('page-title', 'Subjects')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📚 Subjects</h3>
            <p>Manage all subjects</p>
        </div>
        <a href="{{ route('subjects.create') }}" class="btn btn-light fw-bold">
            <i class="fas fa-plus me-2"></i>Add Subject
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Code</th>
                    <th>Credit Hours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $subject->name }}</strong></td>
                    <td><span class="badge bg-primary">{{ $subject->code }}</span></td>
                    <td>{{ $subject->credit_hours }}</td>
                    <td>
                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this subject?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="fas fa-book fa-2x mb-2 d-block"></i>
                        No subjects found!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection