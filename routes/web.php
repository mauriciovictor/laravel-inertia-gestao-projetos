<?php

use App\Http\Controllers\{UserController, HomeController, PerfilController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', HomeController::class)->name('home');
    Route::resource('users', UserController::class)->except('show');
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/open-combo-box', [PerfilController::class, 'openToComboBox'])->name('open-combo-box');
        Route::resource('/', PerfilController::class)->parameters(['' => 'role'])->except('show');
    });
});

