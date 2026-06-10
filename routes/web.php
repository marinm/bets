<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\OneTimeTokenController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/one-time-links/{secret}', [OneTimeTokenController::class, 'signIn'])->name('one-time-links.sign-in');
Route::get('/', fn () => view('welcome'));

Route::resource('bets', BetController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('teams', TeamController::class);
Route::resource('users', UserController::class);
Route::resource('one-time-tokens', OneTimeTokenController::class);
