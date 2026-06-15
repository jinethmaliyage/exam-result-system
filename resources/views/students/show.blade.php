@extends('layout')

@section('page-title', 'Student Details')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <div class="pro-kicker">Student Profile</div>
                    <h3>{{ $student->name }}</h3>
                    <p>{{ $student->student_id }} · {{ $student->class }} · {{ $student->year }}</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('students.edit', $student) }}" class="btn btn-light fw-bold">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('students.index') }}" class="btn btn-outline-light fw-bold">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Student ID</div>
                    <div class="h5 fw-bold mb-0">{{ $student->student_id }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Class</div>
                    <div class="h5 fw-bold mb-0">{{ $student->class }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Email</div>
                    <div class="fw-bold text-break">{{ $student->email }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Phone</div>
                    <div class="h5 fw-bold mb-0">{{ $student->phone ?: 'Not provided' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card pro-card">
        <div class="card-header">
            <h5 class="pro-section-title"><i class="fas fa-chart-line me-2 text-danger"></i>Student Results</h5>
            <span class="pro-pill pro-pill-blue">{{ $results->count() }} total</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover pro-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>GPA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td><strong>{{ $result->subject->name }}</strong></td>
                        <td><span class="pro-pill pro-pill-blue">{{ $result->exam->name }}</span></td>
                        <td><strong>{{ $result->marks_obtained }}</strong></td>
                        <td>
                            <span class="pro-pill {{ in_array($result->grade, ['A+','A','A-']) ? 'pro-pill-green' : (in_array($result->grade, ['B+','B','B-']) ? 'pro-pill-blue' : (in_array($result->grade, ['C+','C']) ? 'pro-pill-orange' : 'pro-pill-red')) }}">
                                {{ $result->grade }}
                            </span>
                        </td>
                        <td><strong>{{ $result->gpa }}</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted pro-empty">
                            <i class="fas fa-chart-bar fa-lg"></i>
                            <div class="fw-semibold">No results recorded for this student.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
