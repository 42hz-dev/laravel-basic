<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

//Route::resource('jobs', JobController::class, [
//    // 'except' => ['edit'] // edit route 제거
//    //'only' => ['index', 'show', 'create'] // index, show, create route 만 사용
//]);

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store');
    Route::get('/jobs/{job}/edit', 'edit');
    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});


Route::view('/contact', 'contact');
