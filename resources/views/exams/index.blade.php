@extends('layout')

@section('page-title', 'Exams')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div>
                    <div class="pro-kicker">Assessment Schedule</div>
                    <h3>Exams</h3>
                    <p>Manage assessment names, types, dates, and total marks.</p>
                </div>
            </div>
            <a href="{{ route('exams.create') }}" class="btn btn-light fw-bold">
                <i class="fas fa-plus me-2"></i>Add Exam
            </a>
        </div>
    </div>

    <div class="card pro-card">
        <div class="card-header">
            <h5 class="pro-section-title">Exam Records</h5>
            <span class="pro-pill pro-pill-orange">{{ $exams->count() }} total</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover pro-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Exam Name</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Total Marks</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exams as $exam)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pro-avatar">
                                    {{ strtoupper(substr($exam->name, 0, 1)) }}
                                </div>
                                <strong>{{ $exam->name }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="pro-pill {{ $exam->type == 'Final' ? 'pro-pill-red' : ($exam->type == 'Midterm' ? 'pro-pill-orange' : ($exam->type == 'Quiz' ? 'pro-pill-green' : 'pro-pill-purple')) }}">
                                {{ $exam->type }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</td>
                        <td><strong>{{ $exam->total_marks }}</strong></td>
                        <td>
                            <div class="pro-row-actions justify-content-end">
                                <a href="{{ route('exams.edit', $exam) }}" class="btn btn-warning btn-sm" title="Edit exam">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('exams.destroy', $exam) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this exam?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Delete exam"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted pro-empty">
                            <i class="fas fa-clipboard-list fa-lg"></i>
                            <div class="fw-semibold">No exams found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
