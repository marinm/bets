<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\OneTimeTokenController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');

Route::post('/logout', function () {
    auth()->logout();

    return redirect('/');
})->name('logout');

Route::resource('bets', BetController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('teams', TeamController::class);
Route::resource('users', UserController::class);
Route::resource('one-time-tokens', OneTimeTokenController::class);
