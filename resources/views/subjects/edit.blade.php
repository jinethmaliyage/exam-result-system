@extends('layout')

@section('page-title', 'Edit Subject')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>✏️ Edit Subject</h3>
            <p>Update subject information</p>
        </div>
        <a href="{{ route('subjects.index') }}" class="btn btn-light fw-bold">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-book me-2 text-danger"></i>Edit Subject Information
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
                <form action="{{ route('subjects.update', $subject) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $subject->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Subject Code</label>
                            <input type="text" class="form-control bg-light"
                                value="{{ $subject->code }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Credit Hours <span class="text-danger">*</span></label>
                            <input type="number" name="credit_hours" class="form-control"
                                value="{{ old('credit_hours', $subject->credit_hours) }}" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Update Subject
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
