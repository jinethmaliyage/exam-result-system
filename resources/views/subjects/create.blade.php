@extends('layout')

@section('page-title', 'Add Subject')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-book-medical"></i>
                </div>
                <div>
                    <div class="pro-kicker">Academic Catalog</div>
                    <h3>Add Subject</h3>
                    <p>Create a subject record with its code and credit hours.</p>
                </div>
            </div>
            <a href="{{ route('subjects.index') }}" class="btn btn-light fw-bold">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="pro-form-shell narrow">
        <div class="card pro-card">
            <div class="card-header">
                <h5 class="pro-section-title"><i class="fas fa-book me-2 text-danger"></i>Subject Information</h5>
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
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="e.g. Mathematics" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Subject Code <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control"
                                placeholder="e.g. MATH101" value="{{ old('code') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Credit Hours <span class="text-danger">*</span></label>
                            <input type="number" name="credit_hours" class="form-control"
                                placeholder="e.g. 3" value="{{ old('credit_hours') }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Save Subject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
