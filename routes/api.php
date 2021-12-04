<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController
};

/** Cursos */

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{identify}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);