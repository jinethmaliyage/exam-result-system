<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $subjectFilter = $request->get('subject_id');
        $examFilter    = $request->get('exam_id');

        $results = Result::with(['student', 'subject', 'exam'])
            ->when($subjectFilter, function($query) use ($subjectFilter) {
                $query->where('subject_id', $subjectFilter);
            })
            ->when($examFilter, function($query) use ($examFilter) {
                $query->where('exam_id', $examFilter);
            })
            ->get();

        $subjects = Subject::all();
        $exams    = Exam::all();

        return view('results.index', compact(
            'results', 'subjects', 'exams',
            'subjectFilter', 'examFilter'
        ));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $exams    = Exam::all();
        return view('results.create', compact('students', 'subjects', 'exams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'     => 'required',
            'subject_id'     => 'required',
            'exam_id'        => 'required',
            'marks_obtained' => 'required|numeric|min:0',
        ]);

        $exam = Exam::findOrFail($request->exam_id);
        $percentage = ($request->marks_obtained / $exam->total_marks) * 100;
        $gpa   = $this->calculateGPA($percentage);
        $grade = $this->calculateGrade($percentage);

        Result::create([
            'student_id'     => $request->student_id,
            'subject_id'     => $request->subject_id,
            'exam_id'        => $request->exam_id,
            'marks_obtained' => $request->marks_obtained,
            'gpa'            => $gpa,
            'grade'          => $grade,
        ]);

        return redirect()->route('results.index')
                         ->with('success', 'Result added successfully!');
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return redirect()->route('results.index')
                         ->with('success', 'Result deleted successfully!');
    }

    public function reportCard($studentId)
    {
        $student = Student::findOrFail($studentId);
        $results = Result::with(['subject', 'exam'])
                         ->where('student_id', $studentId)->get();
        $averageGpa = $results->avg('gpa');
        return view('results.report-card', compact('student', 'results', 'averageGpa'));
    }

    public function downloadPDF($studentId)
    {
        $student = Student::findOrFail($studentId);
        $results = Result::with(['subject', 'exam'])
                         ->where('student_id', $studentId)->get();
        $averageGpa = $results->avg('gpa');

        $pdf = Pdf::loadView('results.report-card-pdf',
                    compact('student', 'results', 'averageGpa'));

        return $pdf->download('report-card-'.$student->student_id.'.pdf');
    }

    private function calculateGPA($percentage)
    {
        if ($percentage >= 90) return 4.0;
        if ($percentage >= 80) return 3.7;
        if ($percentage >= 75) return 3.3;
        if ($percentage >= 70) return 3.0;
        if ($percentage >= 65) return 2.7;
        if ($percentage >= 60) return 2.3;
        if ($percentage >= 55) return 2.0;
        if ($percentage >= 50) return 1.7;
        if ($percentage >= 40) return 1.0;
        return 0.0;
    }

    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 75) return 'A-';
        if ($percentage >= 70) return 'B+';
        if ($percentage >= 65) return 'B';
        if ($percentage >= 60) return 'B-';
        if ($percentage >= 55) return 'C+';
        if ($percentage >= 50) return 'C';
        if ($percentage >= 40) return 'D';
        return 'F';
    }
}