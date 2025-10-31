<?php

use App\Http\Controllers\{HomeController, PerfilController};

use App\Http\Controllers\Users\ {
    ListUserController,
    StoreUserController,
    EditUserController,
    DeleteUserController,
    UpdateUserController,
    CreateUserController
};

use App\Http\Controllers\Perfis\ {
    ListPerfilController,
    StorePerfilController,
    EditPerfilController,
    DeletePerfilController,
    UpdatePerfilController,
    CreatePerfilController,
    ListToComboBoxController
};

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', HomeController::class)->name('home');

    ##ROTAS DE USUÁRIOS
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', ListUserController::class)->name('index');
        Route::get('/create', CreateUserController::class)->name('create');
        Route::get('/{user}', EditUserController::class)->name('edit');
        Route::delete('/{user}', DeleteUserController::class)->name('destroy');
        Route::post('/', StoreUserController::class)->name('store');
        Route::put('/{user}', UpdateUserController::class)->name('update');
    });

    ##ROTAS DE PERFIS##
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', ListPerfilController::class)->name('index');
        Route::get('/create', CreatePerfilController::class)->name('create');
        Route::get('/{role}', EditPerfilController::class)->name('edit');
        Route::delete('/{role}', DeletePerfilController::class)->name('destroy');
        Route::post('/', StorePerfilController::class)->name('store');
        Route::put('/{role}', UpdatePerfilController::class)->name('update');
        Route::get('/open-combo-box', ListToComboBoxController::class)->name('open-combo-box');
    });
});

