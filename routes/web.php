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

use App\Http\Controllers\Projects\ {
    ListProjectsController,
    CreateProjectController,
    StoreProjectController,
    EditProjectController,
    UpdateProjectController,
    DeleteProjectController
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

    ##ROTAS DE PROJETOS##
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', ListProjectsController::class)->name('index');
        Route::get('/create', CreateProjectController::class)->name('create');
        Route::post('/', StoreProjectController::class)->name('store');
        Route::get('/{project}', EditProjectController::class)->name('edit');
        Route::put('/{project}', UpdateProjectController::class)->name('update');
        Route::delete('/{project}', DeleteProjectController::class)->name('destroy');
    });
});

