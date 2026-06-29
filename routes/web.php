<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FixtureBetController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\FixtureSettleController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\OneTimeTokenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNameController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\UserTimezoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('feed'))->name('home');
Route::get('/login', fn () => redirect()->route('sessions.create'))->name('login');
Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');

Route::post('/logout', function () {
    auth()->logout();

    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/feed', FeedController::class)->name('feed');
    Route::get('/fixtures/{fixture}/bets', [FixtureBetController::class, 'index'])->name('fixture-bets.index');
    Route::post('/fixtures/{fixture}/bets', [FixtureBetController::class, 'store'])->name('fixture-bets.store');
    Route::get('/fixtures/{fixture}/bets/create', [FixtureBetController::class, 'create'])->name('fixture-bets.create');
    Route::get('/leaderboard', LeaderboardController::class)->name('leaderboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/name/edit', [UserNameController::class, 'edit'])->name('profile.name.edit');
    Route::post('/profile/name', [UserNameController::class, 'store'])->name('profile.name.store');
    Route::get('/profile/timezone/edit', [UserTimezoneController::class, 'edit'])->name('profile.timezone.edit');
    Route::put('/profile/timezone', [UserTimezoneController::class, 'update'])->name('profile.timezone.update');
    Route::get('/password/edit', [UserPasswordController::class, 'edit'])->name('user-password.edit');
    Route::put('/password', [UserPasswordController::class, 'update'])->name('user-password.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-menu', fn () => view('admin-menu'))->name('admin-menu');
    Route::resource('bets', BetController::class);
    Route::resource('fixtures', FixtureController::class);
    Route::post('/fixtures/{fixture}/settle', FixtureSettleController::class)->name('fixtures.settle');
    Route::resource('teams', TeamController::class);
    Route::resource('users', UserController::class);
    Route::resource('one-time-tokens', OneTimeTokenController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
});
