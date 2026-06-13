<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'type'        => 'required',
            'exam_date'   => 'required|date',
            'total_marks' => 'required|integer',
        ]);

        Exam::create($request->all());
        return redirect()->route('exams.index')
                         ->with('success', 'Exam added successfully!');
    }

    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name'        => 'required',
            'type'        => 'required',
            'exam_date'   => 'required|date',
            'total_marks' => 'required|integer',
        ]);

        $exam->update($request->all());
        return redirect()->route('exams.index')
                         ->with('success', 'Exam updated successfully!');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')
                         ->with('success', 'Exam deleted successfully!');
    }
}