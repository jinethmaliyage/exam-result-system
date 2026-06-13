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

        return view('dashboard', compact(
            'totalStudents', 'totalSubjects',
            'totalExams', 'totalResults', 'recentResults'
        ));
    }
}