<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalExams = Exam::count();
        $totalResults = Result::count();
        $recentResults = Result::with(['student', 'subject', 'exam'])
                                ->latest()->take(5)->get();

        // Chart Data - Pass/Fail
        $passCount = Result::where('grade', '!=', 'F')->count();
        $failCount = Result::where('grade', 'F')->count();

        // Chart Data - Grade Distribution
        $gradeData = [
            'A+' => Result::where('grade', 'A+')->count(),
            'A'  => Result::where('grade', 'A')->count(),
            'A-' => Result::where('grade', 'A-')->count(),
            'B+' => Result::where('grade', 'B+')->count(),
            'B'  => Result::where('grade', 'B')->count(),
            'B-' => Result::where('grade', 'B-')->count(),
            'C+' => Result::where('grade', 'C+')->count(),
            'C'  => Result::where('grade', 'C')->count(),
            'D'  => Result::where('grade', 'D')->count(),
            'F'  => Result::where('grade', 'F')->count(),
        ];

        return view('dashboard', compact(
            'totalStudents', 'totalSubjects',
            'totalExams', 'totalResults',
            'recentResults', 'passCount',
            'failCount', 'gradeData'
        ));
    }
}