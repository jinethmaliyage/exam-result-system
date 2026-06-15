@extends('layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="pro-page">
    <div class="pro-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="pro-hero-icon me-3">
                    <i class="fas fa-gauge-high"></i>
                </div>
                <div>
                    <div class="pro-kicker">Academic Overview</div>
                    <h3>Dashboard</h3>
                    <p>Track students, assessments, subjects, and recent result activity.</p>
                </div>
            </div>
            <a href="{{ route('results.create') }}" class="btn btn-light fw-bold">
                <i class="fas fa-plus me-2"></i>Add Result
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="metric-label">Total Students</div>
                            <div class="metric-value">{{ $totalStudents }}</div>
                        </div>
                        <div class="metric-icon pro-pill-blue">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="metric-link">View all students <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="metric-label">Total Subjects</div>
                            <div class="metric-value">{{ $totalSubjects }}</div>
                        </div>
                        <div class="metric-icon pro-pill-green">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('subjects.index') }}" class="metric-link">View all subjects <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="metric-label">Total Exams</div>
                            <div class="metric-value">{{ $totalExams }}</div>
                        </div>
                        <div class="metric-icon pro-pill-orange">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('exams.index') }}" class="metric-link">View all exams <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="metric-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="metric-label">Total Results</div>
                            <div class="metric-value">{{ $totalResults }}</div>
                        </div>
                        <div class="metric-icon pro-pill-purple">
                            <i class="fas fa-chart-column"></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('results.index') }}" class="metric-link">View all results <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card pro-card h-100">
                <div class="card-header">
                    <h5 class="pro-section-title"><i class="fas fa-chart-pie me-2 text-danger"></i>Pass / Fail Ratio</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="passFailChart" width="250" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card pro-card h-100">
                <div class="card-header">
                    <h5 class="pro-section-title"><i class="fas fa-chart-bar me-2 text-danger"></i>Grade Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="gradeChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card pro-card">
        <div class="card-header">
            <h5 class="pro-section-title"><i class="fas fa-clock me-2 text-danger"></i>Recent Results</h5>
            <a href="{{ route('results.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>Add Result
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover pro-table mb-0">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Grade</th>
                        <th>GPA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentResults as $result)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="pro-avatar">
                                    {{ strtoupper(substr($result->student->name, 0, 1)) }}
                                </div>
                                <strong>{{ $result->student->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $result->subject->name }}</td>
                        <td><span class="pro-pill pro-pill-blue">{{ $result->exam->name }}</span></td>
                        <td><strong>{{ $result->marks_obtained }}</strong></td>
                        <td>
                            <span class="pro-pill {{ in_array($result->grade, ['A+','A','A-']) ? 'pro-pill-green' : (in_array($result->grade, ['B+','B','B-']) ? 'pro-pill-blue' : (in_array($result->grade, ['C+','C']) ? 'pro-pill-orange' : 'pro-pill-red')) }}">
                                {{ $result->grade }}
                            </span>
                        </td>
                        <td><strong>{{ $result->gpa }}</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted pro-empty">
                            <i class="fas fa-inbox fa-lg"></i>
                            <div class="fw-semibold">No results yet. Add your first result!</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var passFailChart = new Chart(document.getElementById('passFailChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pass', 'Fail'],
            datasets: [{
                data: [{{ $passCount }}, {{ $failCount }}],
                backgroundColor: ['#047857', '#991b1b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    var gradeLabels = <?php echo json_encode(array_keys($gradeData)); ?>;
    var gradeValues = <?php echo json_encode(array_values($gradeData)); ?>;

    var gradeChart = new Chart(document.getElementById('gradeChart'), {
        type: 'bar',
        data: {
            labels: gradeLabels,
            datasets: [{
                label: 'Number of Students',
                data: gradeValues,
                backgroundColor: [
                    '#047857','#047857','#047857',
                    '#175cd3','#175cd3','#175cd3',
                    '#c2410c','#c2410c',
                    '#b54708',
                    '#991b1b'
                ],
                borderRadius: 6,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
