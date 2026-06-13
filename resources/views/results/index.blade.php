@extends('layout')

@section('page-title', 'Results')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📊 All Results</h3>
            <p>View and manage all exam results</p>
        </div>
        <a href="{{ route('results.create') }}" class="btn btn-light fw-bold">
            <i class="fas fa-plus me-2"></i>Add Result
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Exam</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>GPA</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div style="width:35px;height:35px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:0.8rem;margin-right:10px;">
                                {{ strtoupper(substr($result->student->name, 0, 1)) }}
                            </div>
                            {{ $result->student->name }}
                        </div>
                    </td>
                    <td>{{ $result->subject->name }}</td>
                    <td><span class="badge bg-info">{{ $result->exam->name }}</span></td>
                    <td><strong>{{ $result->marks_obtained }}</strong></td>
                    <td>
                        <span class="badge" style="background:
                            {{ in_array($result->grade, ['A+','A','A-']) ? '#28a745' :
                               (in_array($result->grade, ['B+','B','B-']) ? '#17a2b8' :
                               (in_array($result->grade, ['C+','C']) ? '#ffc107' : '#dc3545')) }}">
                            {{ $result->grade }}
                        </span>
                    </td>
                    <td><strong>{{ $result->gpa }}</strong></td>
                    <td>
                        <a href="{{ route('results.report-card', $result->student->id) }}"
                            class="btn btn-success btn-sm text-white">
                            <i class="fas fa-file-alt"></i>
                        </a>
                        <form action="{{ route('results.destroy', $result) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this result?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="fas fa-chart-bar fa-2x mb-2 d-block"></i>
                        No results found!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 
