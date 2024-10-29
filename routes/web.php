<?php

use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [GoalController::class, 'index'])->name('goals.index');
Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy');

Route::get('/dashboard', [GoalController::class, 'dashboard'])->name('dashboard');

Route::resource('goals', GoalController::class);