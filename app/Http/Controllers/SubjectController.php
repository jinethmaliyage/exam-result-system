<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'code'         => 'required|unique:subjects',
            'credit_hours' => 'required|integer',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index')
                         ->with('success', 'Subject added successfully!');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'         => 'required',
            'credit_hours' => 'required|integer',
        ]);

        $subject->update($request->all());
        return redirect()->route('subjects.index')
                         ->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')
                         ->with('success', 'Subject deleted successfully!');
    }
}