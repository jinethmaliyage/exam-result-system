<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Result System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            position: fixed;
            top: 0; left: 0;
            padding: 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-brand h4 {
            color: #e94560;
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .sidebar-brand p {
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
        }

        .sidebar-brand .brand-icon {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #e94560, #0f3460);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.5rem;
            color: white;
        }

        .sidebar-menu { padding: 20px 0; }

        .menu-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 10px 20px 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            margin: 2px 10px;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(233,69,96,0.2);
            color: #e94560;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            width: 35px;
            height: 35px;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 0.9rem;
        }

        .sidebar-menu a:hover i,
        .sidebar-menu a.active i {
            background: rgba(233,69,96,0.3);
            color: #e94560;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .top-navbar {
            background: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-navbar h5 {
            color: #1a1a2e;
            font-weight: 600;
            margin: 0;
            flex: 1;
        }

        .top-navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-badge {
            background: linear-gradient(135deg, #e94560, #c62a47);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .content-area { padding: 30px; }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .card-header {
            background: white;
            border-bottom: 2px solid #f0f2f5;
            padding: 20px 25px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .btn-primary {
            background: linear-gradient(135deg, #e94560, #c62a47);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #c62a47, #a01f38);
            transform: translateY(-1px);
        }

        .btn-warning { border-radius: 8px; }
        .btn-danger { border-radius: 8px; }
        .btn-info { border-radius: 8px; }
        .btn-success { border-radius: 8px; }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #1a1a2e;
            border: none;
            padding: 15px;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #f0f2f5;
        }

        .table tbody tr:hover { background: #f8f9ff; }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 0.2rem rgba(233,69,96,0.15);
        }

        .alert {
            border: none;
            border-radius: 10px;
        }

        .badge { border-radius: 6px; padding: 6px 10px; }

        .page-header {
            background: linear-gradient(135deg, #1a1a2e, #0f3460);
            color: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .page-header h3 { margin: 0; font-weight: 700; }
        .page-header p { margin: 5px 0 0; opacity: 0.7; font-size: 0.9rem; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #1a1a2e; }
        ::-webkit-scrollbar-thumb { background: #e94560; border-radius: 3px; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="fas fa-graduation-cap"></i></div>
        <h4>EduResult Pro</h4>
        <p>Result Management System</p>
    </div>
    <div class="sidebar-menu">
        <div class="menu-label">Main Menu</div>
        <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="menu-label">Academic</div>
        <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}">
            <i class="fas fa-user-graduate"></i> Students
        </a>
        <a href="{{ route('subjects.index') }}" class="{{ request()->is('subjects*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Subjects
        </a>
        <a href="{{ route('exams.index') }}" class="{{ request()->is('exams*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i> Exams
        </a>

        <div class="menu-label">Results</div>
        <a href="{{ route('results.index') }}" class="{{ request()->is('results*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i> All Results
        </a>
        <a href="{{ route('results.create') }}" class="{{ request()->is('results/create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i> Add Result
        </a>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    <div class="top-navbar">
        <h5>@yield('page-title', 'Dashboard')</h5>
        <div class="nav-right">
            <span class="nav-badge"><i class="fas fa-circle text-success me-1" style="font-size:8px"></i> System Active</span>
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>