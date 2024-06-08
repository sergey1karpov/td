<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListElementController;
use App\Http\Controllers\UserListsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/{user}', [IndexController::class, 'profile'])->name('profile');

    Route::get('/{user}/list/create', [UserListsController::class, 'create'])->name('list.create');
    Route::post('/{user}/list/create', [UserListsController::class, 'store'])->name('list.store');
    Route::get('/{user}/list/{list}/show', [UserListsController::class, 'show'])->name('list.show');
    Route::get('/{user}/list/{list}/edit', [UserListsController::class, 'edit'])->name('list.edit');
    Route::patch('/{user}/list/{list}/update', [UserListsController::class, 'update'])->name('list.update');
    Route::delete('/{user}/list/{list}/delete', [UserListsController::class, 'delete'])->name('list.delete');

    Route::post('/{user}/list/{list}/add-element', [ListElementController::class, 'store'])->name('list-element.store');
});
