@extends('layout')

@section('page-title', 'Add Result')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📊 Add New Result</h3>
            <p>Enter exam result for a student</p>
        </div>
        <a href="{{ route('results.index') }}" class="btn btn-light fw-bold">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar me-2 text-danger"></i>Result Information
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('results.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                            <select name="student_id" class="form-select" required>
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id')==$student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->student_id }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select" required>
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id')==$subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }} ({{ $subject->code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Exam <span class="text-danger">*</span></label>
                            <select name="exam_id" class="form-select" required>
                                <option value="">Select Exam</option>
                                @foreach($exams as $exam)
                                    <option value="{{ $exam->id }}" {{ old('exam_id')==$exam->id ? 'selected' : '' }}>
                                        {{ $exam->name }} ({{ $exam->type }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Marks Obtained <span class="text-danger">*</span></label>
                            <input type="number" name="marks_obtained" class="form-control"
                                placeholder="Enter marks" value="{{ old('marks_obtained') }}"
                                step="0.01" min="0" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Save Result
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
