@extends('layout')

@section('page-title', 'Report Card')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📄 Report Card</h3>
            <p>{{ $student->name }}'s academic report</p>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-light fw-bold me-2">
                <i class="fas fa-print me-2"></i>Print
            </button>
            <a href="{{ route('results.download-pdf', $student->id) }}" class="btn btn-danger fw-bold me-2">
                <i class="fas fa-file-pdf me-2"></i>Download PDF
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-light fw-bold">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            {{-- Report Card Header --}}
            <div class="card-body p-0">
                <div style="background:linear-gradient(135deg,#1a1a2e,#0f3460);padding:30px;text-align:center;color:white;">
                    <div style="font-size:2.5rem;margin-bottom:10px;">🎓</div>
                    <h3 class="fw-bold mb-1">EduResult Pro</h3>
                    <p class="opacity-75 mb-0">Official Academic Report Card</p>
                </div>

                {{-- Student Info --}}
                <div class="p-4" style="background:#f8f9fa;border-bottom:2px solid #e9ecef;">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Student Name:</strong> {{ $student->name }}</p>
                            <p class="mb-1"><strong>Student ID:</strong> {{ $student->student_id }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Class:</strong> {{ $student->class }}</p>
                            <p class="mb-1"><strong>Year:</strong> {{ $student->year }}</p>
                        </div>
                    </div>
                </div>

                {{-- Results Table --}}
                <div class="p-4">
                    <table class="table table-bordered mb-4">
                        <thead style="background:#1a1a2e;color:white;">
                            <tr>
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
                                <td>{{ $result->subject->name }}</td>
                                <td>{{ $result->exam->name }}</td>
                                <td>{{ $result->marks_obtained }} / {{ $result->exam->total_marks }}</td>
                                <td>
                                    <span class="badge" style="background:
                                        {{ in_array($result->grade, ['A+','A','A-']) ? '#28a745' :
                                           (in_array($result->grade, ['B+','B','B-']) ? '#17a2b8' :
                                           (in_array($result->grade, ['C+','C']) ? '#ffc107' : '#dc3545')) }}">
                                        {{ $result->grade }}
                                    </span>
                                </td>
                                <td>{{ $result->gpa }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No results found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Average GPA --}}
                    <div class="text-end">
                        <div style="display:inline-block;background:linear-gradient(135deg,#1a1a2e,#0f3460);color:white;padding:15px 30px;border-radius:10px;">
                            <p class="mb-1 opacity-75" style="font-size:0.85rem">Average GPA</p>
                            <h3 class="mb-0 fw-bold">{{ number_format($averageGpa, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection