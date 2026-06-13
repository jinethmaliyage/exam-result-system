@extends('layout')

@section('page-title', 'Exams')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📝 Exams</h3>
            <p>Manage all exams</p>
        </div>
        <a href="{{ route('exams.create') }}" class="btn btn-light fw-bold">
            <i class="fas fa-plus me-2"></i>Add Exam
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Name</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Total Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exams as $exam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $exam->name }}</strong></td>
                    <td>
                        <span class="badge" style="background:
                            {{ $exam->type == 'Final' ? '#dc3545' :
                               ($exam->type == 'Midterm' ? '#fd7e14' :
                               ($exam->type == 'Quiz' ? '#20c997' : '#6f42c1')) }}">
                            {{ $exam->type }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</td>
                    <td>{{ $exam->total_marks }}</td>
                    <td>
                        <a href="{{ route('exams.edit', $exam) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('exams.destroy', $exam) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this exam?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        <i class="fas fa-clipboard-list fa-2x mb-2 d-block"></i>
                        No exams found!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection