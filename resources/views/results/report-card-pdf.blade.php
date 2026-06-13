<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Card - {{ $student->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }

        .header {
            background: #1a1a2e;
            color: white;
            text-align: center;
            padding: 25px;
            margin-bottom: 20px;
        }

        .header h1 { font-size: 24px; margin-bottom: 5px; }
        .header p { font-size: 12px; opacity: 0.8; }

        .student-info {
            background: #f8f9fa;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-left: 4px solid #e94560;
        }

        .student-info table { width: 100%; }
        .student-info td { padding: 5px 10px; font-size: 13px; }
        .student-info td strong { color: #1a1a2e; }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a2e;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e94560;
        }

        table.results {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.results th {
            background: #1a1a2e;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        table.results td {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 12px;
        }

        table.results tr:nth-child(even) { background: #f8f9fa; }

        .grade-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11px;
            color: white;
        }

        .grade-a { background: #28a745; }
        .grade-b { background: #17a2b8; }
        .grade-c { background: #ffc107; color: #333; }
        .grade-f { background: #dc3545; }

        .gpa-box {
            background: #1a1a2e;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            width: 200px;
            float: right;
            margin-bottom: 20px;
        }

        .gpa-box p { font-size: 11px; opacity: 0.7; margin-bottom: 5px; }
        .gpa-box h2 { font-size: 28px; color: #e94560; }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            font-size: 11px;
            color: #999;
        }

        .clearfix::after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>🎓 EduResult Pro</h1>
        <p>Official Academic Report Card</p>
    </div>

    {{-- Student Info --}}
    <div class="student-info">
        <table>
            <tr>
                <td><strong>Student Name:</strong> {{ $student->name }}</td>
                <td><strong>Student ID:</strong> {{ $student->student_id }}</td>
            </tr>
            <tr>
                <td><strong>Class:</strong> {{ $student->class }}</td>
                <td><strong>Year:</strong> {{ $student->year }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> {{ $student->email }}</td>
                <td><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    {{-- Results Table --}}
    <div class="section-title">Exam Results</div>
    <table class="results">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Exam</th>
                <th>Type</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>GPA</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $index => $result)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $result->subject->name }}</td>
                <td>{{ $result->exam->name }}</td>
                <td>{{ $result->exam->type }}</td>
                <td>{{ $result->marks_obtained }} / {{ $result->exam->total_marks }}</td>
                <td>
                    <span class="grade-badge
                        {{ in_array($result->grade, ['A+','A','A-']) ? 'grade-a' :
                           (in_array($result->grade, ['B+','B','B-']) ? 'grade-b' :
                           (in_array($result->grade, ['C+','C']) ? 'grade-c' : 'grade-f')) }}">
                        {{ $result->grade }}
                    </span>
                </td>
                <td>{{ $result->gpa }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:20px;color:#999;">
                    No results found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Average GPA --}}
    <div class="clearfix">
        <div class="gpa-box">
            <p>Average GPA</p>
            <h2>{{ number_format($averageGpa, 2) }}</h2>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>This is an officially generated report card from EduResult Pro System.</p>
        <p>Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
    </div>

</body>
</html>
