<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\Admin\AdminPageController;


Auth::routes();
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::get('/users/datatable/ssd', [UserController::class, 'ssd'])->name('user-ssd');
});
Route::middleware(['auth', 'role:customer'])->name('user.')->group(function () {
    Route::get('/', [UserPageController::class, 'home'])->name('home');
});