<?php

use App\Http\Controllers\{UserController, HomeController, PerfilController};
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::resource('users', UserController::class)->except('show');
Route::resource('roles', PerfilController::class)->except('show');
