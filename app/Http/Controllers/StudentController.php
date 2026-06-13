<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'name'       => 'required',
            'email'      => 'required|email|unique:students',
            'class'      => 'required',
            'year'       => 'required|integer',
        ]);

        Student::create([
            'student_id' => $request->student_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'class'      => $request->input('class'),
            'year'       => $request->year,
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        $results = $student->results()->with(['subject', 'exam'])->get();
        return view('students.show', compact('student', 'results'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'class' => 'required',
            'year'  => 'required|integer',
        ]);

        $student->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'class' => $request->input('class'),
            'year'  => $request->year,
        ]);

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully!');
    }
}