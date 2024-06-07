<?php

use App\Http\Controllers\UserListsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/{user}/list/create', [UserListsController::class, 'create'])->name('list.create');
Route::post('/{user}/list/create', [UserListsController::class, 'store'])->name('list.store');
