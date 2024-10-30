<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\RideController;

Route::get('/', [GoalController::class, 'index'])->name('goals.index');
Route::get('/goals/create', [GoalController::class, 'create'])->name('goals.create');
Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy');

Route::get('/strava', [RideController::class, 'showConnectPage'])->name('strava.connect');
Route::get('/strava/redirect', [RideController::class, 'redirectToStrava'])->name('strava.redirect');
Route::get('/strava/callback', [RideController::class, 'handleStravaCallback'])->name('strava.callback');
Route::get('/rides/import', [RideController::class, 'importRides'])->name('rides.import');




Route::get('/dashboard', [GoalController::class, 'dashboard'])->name('dashboard');
