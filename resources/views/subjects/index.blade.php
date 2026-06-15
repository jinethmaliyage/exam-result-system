@extends('layout')

@section('page-title', 'Subjects')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <div class="pro-kicker">Academic Catalog</div>
                    <h3>Subjects</h3>
                    <p>Organize subject names, codes, and credit hours used in result records.</p>
                </div>
            </div>
            <a href="{{ route('subjects.create') }}" class="btn btn-light fw-bold">
                <i class="fas fa-plus me-2"></i>Add Subject
            </a>
        </div>
    </div>

    <div class="card pro-card">
        <div class="card-header">
            <h5 class="pro-section-title">Subject Records</h5>
            <span class="pro-pill pro-pill-green">{{ $subjects->count() }} total</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover pro-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Code</th>
                        <th>Credit Hours</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $subject)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pro-avatar">
                                    {{ strtoupper(substr($subject->name, 0, 1)) }}
                                </div>
                                <strong>{{ $subject->name }}</strong>
                            </div>
                        </td>
                        <td><span class="pro-pill pro-pill-blue">{{ $subject->code }}</span></td>
                        <td>{{ $subject->credit_hours }}</td>
                        <td>
                            <div class="pro-row-actions justify-content-end">
                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm" title="Edit subject">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this subject?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Delete subject"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted pro-empty">
                            <i class="fas fa-book fa-lg"></i>
                            <div class="fw-semibold">No subjects found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
