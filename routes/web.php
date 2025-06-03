<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home']);
Route::post('/generate-exercises', [MainController::class, 'generateExercises'])->name('generateExercises');
Route::get('/print-exercises', [MainController::class, 'printExercises'])->name('generateExercprintExercisesises');
Route::get('/export-exercises', [MainController::class, 'exportExercises'])->name('exportExercises');
