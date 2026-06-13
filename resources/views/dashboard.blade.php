@extends('layout')

@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Cards --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75" style="font-size:0.85rem">Total Students</p>
                        <h2 class="mb-0 fw-bold">{{ $totalStudents }}</h2>
                    </div>
                    <div style="width:55px;height:55px;background:rgba(255,255,255,0.2);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                        🎓
                    </div>
                </div>
                <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.2)">
                    <a href="{{ route('students.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem">
                        View All Students →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75" style="font-size:0.85rem">Total Subjects</p>
                        <h2 class="mb-0 fw-bold">{{ $totalSubjects }}</h2>
                    </div>
                    <div style="width:55px;height:55px;background:rgba(255,255,255,0.2);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                        📚
                    </div>
                </div>
                <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.2)">
                    <a href="{{ route('subjects.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem">
                        View All Subjects →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75" style="font-size:0.85rem">Total Exams</p>
                        <h2 class="mb-0 fw-bold">{{ $totalExams }}</h2>
                    </div>
                    <div style="width:55px;height:55px;background:rgba(255,255,255,0.2);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                        📝
                    </div>
                </div>
                <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.2)">
                    <a href="{{ route('exams.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem">
                        View All Exams →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card h-100" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 opacity-75" style="font-size:0.85rem">Total Results</p>
                        <h2 class="mb-0 fw-bold">{{ $totalResults }}</h2>
                    </div>
                    <div style="width:55px;height:55px;background:rgba(255,255,255,0.2);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                        📊
                    </div>
                </div>
                <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,0.2)">
                    <a href="{{ route('results.index') }}" class="text-white text-decoration-none" style="font-size:0.8rem">
                        View All Results →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-chart-pie me-2 text-danger"></i>Pass / Fail Ratio
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="passFailChart" width="250" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-chart-bar me-2 text-danger"></i>Grade Distribution
            </div>
            <div class="card-body">
                <canvas id="gradeChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Recent Results Table --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-clock me-2 text-danger"></i>Recent Results</span>
                <a href="{{ route('results.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Result
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
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
                                    <div style="width:35px;height:35px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:bold;font-size:0.8rem;margin-right:10px;">
                                        {{ strtoupper(substr($result->student->name, 0, 1)) }}
                                    </div>
                                    {{ $result->student->name }}
                                </div>
                            </td>
                            <td>{{ $result->subject->name }}</td>
                            <td><span class="badge bg-info">{{ $result->exam->name }}</span></td>
                            <td><strong>{{ $result->marks_obtained }}</strong></td>
                            <td>
                                <span class="badge" style="background:
                                    {{ in_array($result->grade, ['A+','A','A-']) ? '#28a745' :
                                       (in_array($result->grade, ['B+','B','B-']) ? '#17a2b8' :
                                       (in_array($result->grade, ['C+','C']) ? '#ffc107' : '#dc3545')) }}">
                                    {{ $result->grade }}
                                </span>
                            </td>
                            <td><strong>{{ $result->gpa }}</strong></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No results yet. Add your first result!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                backgroundColor: ['#28a745', '#dc3545'],
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
                    '#28a745','#28a745','#28a745',
                    '#17a2b8','#17a2b8','#17a2b8',
                    '#ffc107','#ffc107',
                    '#fd7e14',
                    '#dc3545'
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