@extends('layout')

@section('page-title', 'Results')

@section('content')
<style>
    .results-page {
        --ink: #182033;
        --muted: #667085;
        --line: #e6eaf0;
        --accent: #e94560;
        --navy: #17233f;
        --teal: #0f766e;
    }

    .results-hero {
        background:
            linear-gradient(135deg, rgba(23,35,63,0.96), rgba(36,59,97,0.92)),
            repeating-linear-gradient(135deg, rgba(255,255,255,0.13) 0 1px, transparent 1px 18px);
        border-radius: 12px;
        color: #fff;
        margin-bottom: 22px;
        overflow: hidden;
        min-height: 150px;
        padding: 32px;
        position: relative;
    }

    .results-hero::after {
        background: linear-gradient(135deg, rgba(15,118,110,0.75), rgba(233,69,96,0.42));
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 999px;
        content: "";
        height: 190px;
        position: absolute;
        right: -55px;
        top: -65px;
        width: 190px;
    }

    .results-hero h3 {
        font-size: 1.9rem;
        font-weight: 750;
        letter-spacing: 0;
        margin: 0;
    }

    .results-hero p {
        color: rgba(255,255,255,0.74);
        font-size: 0.95rem;
        margin: 6px 0 0;
    }

    .hero-icon {
        align-items: center;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.16);
        border-radius: 10px;
        display: flex;
        height: 48px;
        justify-content: center;
        width: 48px;
    }

    .results-kicker {
        align-items: center;
        color: rgba(255,255,255,0.72);
        display: inline-flex;
        font-size: 0.75rem;
        font-weight: 800;
        gap: 8px;
        letter-spacing: 0.08em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .results-summary {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin: -34px 18px 24px;
        position: relative;
        z-index: 2;
    }

    .summary-tile {
        align-items: center;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 14px 35px rgba(24, 32, 51, 0.11);
        display: flex;
        gap: 14px;
        padding: 18px;
    }

    .summary-icon {
        align-items: center;
        border-radius: 10px;
        display: flex;
        flex: 0 0 44px;
        height: 44px;
        justify-content: center;
        width: 44px;
    }

    .summary-icon.records { background: #eef6ff; color: #175cd3; }
    .summary-icon.gpa { background: #ecfdf3; color: #047857; }
    .summary-icon.marks { background: #fff7ed; color: #c2410c; }

    .summary-label {
        color: var(--muted);
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .summary-value {
        color: var(--ink);
        font-size: 1.25rem;
        font-weight: 850;
        line-height: 1;
    }

    .results-hero .btn {
        border-radius: 8px;
        box-shadow: 0 12px 26px rgba(0,0,0,0.16);
        padding: 10px 16px;
        position: relative;
        z-index: 1;
    }

    .results-filter,
    .results-table-card {
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 16px 38px rgba(24, 32, 51, 0.08);
    }

    .results-filter .card-body {
        padding: 20px;
    }

    .filter-heading {
        color: var(--ink);
        font-size: 0.92rem;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .results-page .form-label {
        color: #344054;
        font-size: 0.8rem;
        margin-bottom: 7px;
    }

    .results-page .form-select {
        background-color: #fff;
        border-color: #d9e0ea;
        min-height: 44px;
    }

    .results-actions {
        display: flex;
        gap: 10px;
    }

    .results-actions .btn {
        min-height: 44px;
    }

    .filtered-note {
        align-items: center;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 10px;
        color: #9a3412;
        display: flex;
        font-size: 0.9rem;
        gap: 10px;
        margin-bottom: 16px;
        padding: 11px 14px;
    }

    .results-table-header {
        align-items: center;
        border-bottom: 1px solid var(--line);
        display: flex;
        justify-content: space-between;
        padding: 18px 20px;
    }

    .results-table-header h5 {
        color: var(--ink);
        font-size: 1rem;
        font-weight: 750;
        margin: 0;
    }

    .result-count-pill {
        background: #eef6ff;
        border: 1px solid #cfe5ff;
        border-radius: 999px;
        color: #175cd3;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 6px 11px;
    }

    .results-table {
        min-width: 860px;
    }

    .results-table th {
        background: #eef2f7;
        color: #475467;
        font-size: 0.76rem;
        letter-spacing: 0;
        padding: 14px 18px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .results-table td {
        color: #344054;
        padding: 16px 18px;
    }

    .results-table tbody tr {
        transition: background 0.2s ease, box-shadow 0.2s ease;
    }

    .results-table tbody tr:hover {
        background: #f9fbff;
        box-shadow: inset 4px 0 0 var(--accent);
    }

    .result-index {
        color: #98a2b3;
        font-weight: 700;
    }

    .student-avatar {
        align-items: center;
        background: linear-gradient(135deg, #17233f, #0f766e);
        border-radius: 10px;
        color: #fff;
        display: flex;
        flex: 0 0 40px;
        font-size: 0.85rem;
        font-weight: 800;
        height: 40px;
        justify-content: center;
        margin-right: 12px;
        width: 40px;
    }

    .student-name {
        color: var(--ink);
        font-weight: 700;
    }

    .subject-text {
        color: #475467;
        font-weight: 600;
    }

    .exam-badge,
    .grade-badge {
        border-radius: 999px;
        display: inline-flex;
        font-size: 0.78rem;
        font-weight: 750;
        padding: 7px 10px;
    }

    .exam-badge {
        background: #ecfeff;
        color: #155e75;
    }

    .grade-a { background: #dcfce7; color: #166534; }
    .grade-b { background: #dbeafe; color: #1e40af; }
    .grade-c { background: #fef3c7; color: #92400e; }
    .grade-low { background: #fee2e2; color: #991b1b; }

    .marks-text,
    .gpa-text {
        color: var(--ink);
        font-weight: 800;
    }

    .row-actions {
        display: flex;
        gap: 8px;
    }

    .row-actions .btn {
        align-items: center;
        border-radius: 8px;
        display: inline-flex;
        height: 34px;
        justify-content: center;
        padding: 0;
        width: 36px;
    }

    .empty-state {
        padding: 54px 20px;
    }

    .empty-state i {
        align-items: center;
        background: #f2f4f7;
        border-radius: 12px;
        color: #98a2b3;
        display: inline-flex;
        height: 52px;
        justify-content: center;
        margin-bottom: 12px;
        width: 52px;
    }

    @media (max-width: 767.98px) {
        .results-hero {
            padding: 22px;
        }

        .results-hero .d-flex {
            align-items: flex-start !important;
            gap: 16px;
        }

        .results-hero h3 {
            font-size: 1.35rem;
        }

        .results-summary {
            grid-template-columns: 1fr;
            margin: 0 0 20px;
        }

        .results-actions {
            flex-direction: column;
        }

        .results-table-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="results-page">
    <div class="results-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="hero-icon me-3">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div>
                    <div class="results-kicker">
                        <i class="fas fa-star"></i> Academic Performance
                    </div>
                    <h3>All Results</h3>
                    <p>Review, filter, and manage student exam performance.</p>
                </div>
            </div>
            <a href="{{ route('results.create') }}" class="btn btn-light fw-bold">
                <i class="fas fa-plus me-2"></i>Add Result
            </a>
        </div>
    </div>

    <div class="results-summary">
        <div class="summary-tile">
            <div class="summary-icon records">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <div class="summary-label">Total Records</div>
                <div class="summary-value">{{ $results->count() }}</div>
            </div>
        </div>
        <div class="summary-tile">
            <div class="summary-icon gpa">
                <i class="fas fa-award"></i>
            </div>
            <div>
                <div class="summary-label">Average GPA</div>
                <div class="summary-value">{{ number_format($results->avg('gpa') ?? 0, 2) }}</div>
            </div>
        </div>
        <div class="summary-tile">
            <div class="summary-icon marks">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div>
                <div class="summary-label">Highest Marks</div>
                <div class="summary-value">{{ number_format($results->max('marks_obtained') ?? 0, 2) }}</div>
            </div>
        </div>
    </div>

    <div class="card results-filter mb-4">
        <div class="card-body">
            <div class="filter-heading">
                <i class="fas fa-sliders-h me-2 text-primary"></i>Filter Results
            </div>
            <form action="{{ route('results.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label fw-semibold">Subject</label>
                        <select name="subject_id" class="form-select">
                            <option value="">All Subjects</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $subjectFilter == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label fw-semibold">Exam</label>
                        <select name="exam_id" class="form-select">
                            <option value="">All Exams</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}"
                                    {{ $examFilter == $exam->id ? 'selected' : '' }}>
                                    {{ $exam->name }} ({{ $exam->type }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <div class="results-actions">
                            <button class="btn btn-primary px-4" type="submit">
                                <i class="fas fa-filter me-2"></i>Apply
                            </button>
                            @if($subjectFilter || $examFilter)
                                <a href="{{ route('results.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="fas fa-times me-2"></i>Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($subjectFilter || $examFilter)
        <div class="filtered-note">
            <i class="fas fa-info-circle"></i>
            <span>Showing filtered results with <strong>{{ $results->count() }}</strong> result(s) found.</span>
        </div>
    @endif

    <div class="card results-table-card">
        <div class="results-table-header">
            <h5>Result Records</h5>
            <span class="result-count-pill">{{ $results->count() }} total</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover results-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>GPA</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td><span class="result-index">{{ $loop->iteration }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($result->student->name, 0, 1)) }}
                                    </div>
                                    <span class="student-name">{{ $result->student->name }}</span>
                                </div>
                            </td>
                            <td><span class="subject-text">{{ $result->subject->name }}</span></td>
                            <td><span class="exam-badge">{{ $result->exam->name }}</span></td>
                            <td><span class="marks-text">{{ $result->marks_obtained }}</span></td>
                            <td>
                                <span class="grade-badge {{ in_array($result->grade, ['A+','A','A-']) ? 'grade-a' : (in_array($result->grade, ['B+','B','B-']) ? 'grade-b' : (in_array($result->grade, ['C+','C']) ? 'grade-c' : 'grade-low')) }}">
                                    {{ $result->grade }}
                                </span>
                            </td>
                            <td><span class="gpa-text">{{ $result->gpa }}</span></td>
                            <td>
                                <div class="row-actions justify-content-end">
                                    <a href="{{ route('results.report-card', $result->student->id) }}"
                                        class="btn btn-success btn-sm text-white" title="Report card">
                                        <i class="fas fa-file-alt"></i>
                                    </a>
                                    <form action="{{ route('results.destroy', $result) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this result?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Delete result">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted empty-state">
                                <i class="fas fa-chart-bar fa-lg"></i>
                                <div class="fw-semibold">
                                    @if($subjectFilter || $examFilter)
                                        No results found for selected filters.
                                    @else
                                        No results found.
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
