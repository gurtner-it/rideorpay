<?php

use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [GoalController::class, 'index'])->name('index');
Route::get('/dashboard', [GoalController::class, 'dashboard'])->name('dashboard');

Route::resource('goals', GoalController::class);