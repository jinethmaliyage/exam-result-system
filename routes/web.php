<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('students', StudentController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('exams', ExamController::class);
Route::resource('results', ResultController::class);

Route::get('/report-card/{studentId}', [ResultController::class, 'reportCard'])
     ->name('results.report-card');