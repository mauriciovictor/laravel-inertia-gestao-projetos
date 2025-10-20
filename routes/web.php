<?php

use App\Http\Controllers\{UserController, HomeController, PerfilController};
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::resource('users', UserController::class)->except('show');
Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/open-combo-box', [PerfilController::class, 'openToComboBox'])->name('open-combo-box');
    Route::resource('/', PerfilController::class)->parameters(['' => 'role'])->except('show');
});
