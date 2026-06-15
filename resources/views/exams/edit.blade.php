@extends('layout')

@section('page-title', 'Edit Exam')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-pen-to-square"></i>
                </div>
                <div>
                    <div class="pro-kicker">Assessment Schedule</div>
                    <h3>Edit Exam</h3>
                    <p>Update exam details used by result records.</p>
                </div>
            </div>
            <a href="{{ route('exams.index') }}" class="btn btn-light fw-bold">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="pro-form-shell narrow">
        <div class="card pro-card">
            <div class="card-header">
                <h5 class="pro-section-title"><i class="fas fa-clipboard-list me-2 text-danger"></i>Edit Exam Information</h5>
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
                <form action="{{ route('exams.update', $exam) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Exam Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $exam->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="Midterm" {{ $exam->type=='Midterm' ? 'selected' : '' }}>Midterm</option>
                                <option value="Final" {{ $exam->type=='Final' ? 'selected' : '' }}>Final</option>
                                <option value="Assignment" {{ $exam->type=='Assignment' ? 'selected' : '' }}>Assignment</option>
                                <option value="Quiz" {{ $exam->type=='Quiz' ? 'selected' : '' }}>Quiz</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Exam Date <span class="text-danger">*</span></label>
                            <input type="date" name="exam_date" class="form-control"
                                value="{{ old('exam_date', $exam->exam_date) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Total Marks <span class="text-danger">*</span></label>
                            <input type="number" name="total_marks" class="form-control"
                                value="{{ old('total_marks', $exam->total_marks) }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Update Exam
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
