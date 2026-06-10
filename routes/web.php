<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::resource('bets', BetController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('teams', TeamController::class);
Route::resource('users', UserController::class);
