@extends('layout')

@section('page-title', 'Edit Student')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div>
                    <div class="pro-kicker">Student Profile</div>
                    <h3>Edit Student</h3>
                    <p>Update student contact, class, and academic year details.</p>
                </div>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-light fw-bold">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="pro-form-shell">
        <div class="card pro-card">
            <div class="card-header">
                <h5 class="pro-section-title"><i class="fas fa-id-card me-2 text-danger"></i>Edit Student Information</h5>
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

                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Student ID</label>
                            <input type="text" class="form-control bg-light"
                                value="{{ $student->student_id }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $student->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $student->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $student->phone) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                            <input type="text" name="class" class="form-control"
                                value="{{ old('class', $student->class) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                            <input type="number" name="year" class="form-control"
                                value="{{ old('year', $student->year) }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Update Student
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
