@extends('layout')

@section('page-title', 'Add Exam')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>📝 Add New Exam</h3>
            <p>Fill in the details to add a new exam</p>
        </div>
        <a href="{{ route('exams.index') }}" class="btn btn-light fw-bold">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-clipboard-list me-2 text-danger"></i>Exam Information
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
                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Exam Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="e.g. Mid Term 2024" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="Midterm" {{ old('type')=='Midterm' ? 'selected' : '' }}>Midterm</option>
                                <option value="Final" {{ old('type')=='Final' ? 'selected' : '' }}>Final</option>
                                <option value="Assignment" {{ old('type')=='Assignment' ? 'selected' : '' }}>Assignment</option>
                                <option value="Quiz" {{ old('type')=='Quiz' ? 'selected' : '' }}>Quiz</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Exam Date <span class="text-danger">*</span></label>
                            <input type="date" name="exam_date" class="form-control"
                                value="{{ old('exam_date') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Total Marks <span class="text-danger">*</span></label>
                            <input type="number" name="total_marks" class="form-control"
                                placeholder="e.g. 100" value="{{ old('total_marks') }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Save Exam
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
