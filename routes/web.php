<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::resource('fixtures', FixtureController::class);
Route::resource('teams', TeamController::class);
