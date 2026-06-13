@extends('layout')

@section('page-title', 'Add Student')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>🎓 Add New Student</h3>
            <p>Fill in the details to register a new student</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-light fw-bold">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-plus me-2 text-danger"></i>Student Information
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

                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Student ID <span class="text-danger">*</span></label>
                            <input type="text" name="student_id" class="form-control"
                                placeholder="e.g. STU001" value="{{ old('student_id') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Enter full name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter email" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="Enter phone number" value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                            <input type="text" name="class" class="form-control"
                                placeholder="e.g. Grade 10A" value="{{ old('class') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                            <input type="number" name="year" class="form-control"
                                placeholder="e.g. 2024" value="{{ old('year') }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Save Student
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection