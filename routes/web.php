<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListElementController;
use App\Http\Controllers\UserListsController;
use App\Http\Middleware\CheckAdminOrModerRoleMiddleware;
use App\Http\Middleware\CheckAdminRoleMiddleware;
use App\Http\Middleware\ShowListMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/{user}', [IndexController::class, 'profile'])->name('profile')->middleware(CheckAdminRoleMiddleware::class); //админ

    Route::get('/{user}/list/create', [UserListsController::class, 'create'])->name('list.create')->middleware(CheckAdminRoleMiddleware::class); //админ
    Route::post('/{user}/list/create', [UserListsController::class, 'store'])->name('list.store')->middleware(CheckAdminRoleMiddleware::class); //админ
    Route::get('/{user}/list/{list}/show', [UserListsController::class, 'show'])->name('list.show')->middleware(ShowListMiddleware::class); //админ, модер, ридер
    Route::get('/{user}/list/{list}/edit', [UserListsController::class, 'edit'])->name('list.edit')->middleware(CheckAdminRoleMiddleware::class); //админ
    Route::patch('/{user}/list/{list}/update', [UserListsController::class, 'update'])->name('list.update')->middleware(CheckAdminRoleMiddleware::class); //админ
    Route::delete('/{user}/list/{list}/delete', [UserListsController::class, 'delete'])->name('list.delete')->middleware(CheckAdminRoleMiddleware::class); //админ

    Route::post('/{user}/list/{list}/add-element', [ListElementController::class, 'store'])->name('list-element.store')->middleware(CheckAdminRoleMiddleware::class); //админ
    Route::get('/{user}/list/{list}/element/{element}', [ListElementController::class, 'show'])->name('list-element.show')->middleware(ShowListMiddleware::class); //админ, модер, ридер
    Route::get('/{user}/list/{list}/element/{element}/edit', [ListElementController::class, 'edit'])->name('list-element.edit')->middleware(CheckAdminOrModerRoleMiddleware::class); //админ, модер
    Route::patch('/{user}/list/{list}/element/{element}/update', [ListElementController::class, 'update'])->name('list-element.update')->middleware(CheckAdminOrModerRoleMiddleware::class); //админ, модер
    Route::delete('/{user}/list/{list}/element/{element}/delete-image', [ListElementController::class, 'deleteImage'])->name('list-element.delete-image')->middleware(CheckAdminOrModerRoleMiddleware::class); //админ, модер
    Route::delete('/{user}/list/{list}/element/{element}/delete', [ListElementController::class, 'delete'])->name('list-element.delete')->middleware(CheckAdminRoleMiddleware::class); //админ

    Route::post('/{user}/list/{list}/share', [ListElementController::class, 'shareList'])->name('share')->middleware(CheckAdminRoleMiddleware::class); //админ
});
