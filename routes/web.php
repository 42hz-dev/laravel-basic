<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');

//Route::resource('jobs', JobController::class, [
//    // 'except' => ['edit'] // edit route 제거
//    // 'only' => ['index', 'show', 'create'] // index, show, create route 만 사용
//]);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}', [JobController::class, 'show'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); // Use Policy
    // ->can('edit-job', 'job'); // Use Gate
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
