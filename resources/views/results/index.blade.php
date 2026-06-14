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

{{-- Filter Box --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form action="{{ route('results.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter by Subject</label>
                    <select name="subject_id" class="form-select">
                        <option value="">All Subjects</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ $subjectFilter == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter by Exam</label>
                    <select name="exam_id" class="form-select">
                        <option value="">All Exams</option>
                        @foreach($exams as $exam)
                            <option value="{{ $exam->id }}"
                                {{ $examFilter == $exam->id ? 'selected' : '' }}>
                                {{ $exam->name }} ({{ $exam->type }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary px-4 me-2" type="submit">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    @if($subjectFilter || $examFilter)
                    <a href="{{ route('results.index') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-times me-2"></i>Clear
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

@if($subjectFilter || $examFilter)
<p class="text-muted mb-3">
    Showing filtered results — <strong>{{ $results->count() }}</strong> result(s) found
</p>
@endif

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
                        @if($subjectFilter || $examFilter)
                            No results found for selected filters!
                        @else
                            No results found!
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection