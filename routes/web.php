<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;

Route::get('/', [StudentsController::class, 'index'])->name('students.index');

// Rutas para estudiantes
Route::get('/students', [StudentsController::class, 'index'])->name('students.index');

Route::get('/student/create', [StudentsController::class, 'create'])->name('student.create');
Route::post('/student/store', [StudentsController::class, 'store'])->name('student.store');

Route::get('/student/{id}/view', [StudentsController::class, 'view'])->name('student.view');

Route::get('/student/{id}/edit', [StudentsController::class, 'edit'])->name('student.edit');
Route::put('/student/{id}/update', [StudentsController::class, 'update'])->name('student.update');

Route::delete('/student/{id}/delete', [StudentsController::class, 'destroy'])->name('student.delete');


Route::get('/student/{id}/delete', [StudentsController::class, 'destroy'])->name('student.delete.get');
