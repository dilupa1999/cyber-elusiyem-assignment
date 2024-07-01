<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\studentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::prefix('/Student')->group(function () {



    Route::get('/students', [StudentController::class, 'index'])->name('Student.index');
    Route::post('/students/store', [StudentController::class, 'store'])->name('Student.store');
    Route::get('/list', [StudentController::class, 'list'])->name('Student.list');
    Route::delete('/students/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

    Route::get('/{task_id}/done', [studentController::class, 'done'])->name('student.done');

    Route::get('/{task_id}/studentUpdate', [studentController::class, 'studentUpdate'])->name('Student.studentUpdate');



    Route::get('/edit', [studentController::class, 'edit'])->name('student.edit');
    Route::post('/{task_id}/update', [studentController::class, 'update'])->name('student.update');
    Route::post('/{task_id}/get', [studentController::class, 'get'])->name('Student.get');
});

require __DIR__.'/auth.php';
