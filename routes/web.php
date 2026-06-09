<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::resource('teams', TeamController::class);
