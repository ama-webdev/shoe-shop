<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;

Auth::routes();
Route::prefix('admin')->middleware(['auth', 'role:admin|manager'])->name('admin.')->group(function () {
    Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');
    // users
    Route::resource('/users', UserController::class);
    Route::get('/users/datatable/ssd', [UserController::class, 'ssd'])->name('user-ssd');
    // permission
    Route::get('/roles/{id}/edit', [PermissionController::class, 'roleEdit'])->name('roles.edit');
    Route::put('/roles/{id}/upadte', [PermissionController::class, 'roleUpdate'])->name('roles.update');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    // setting
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/settings/change-password', [SettingController::class, 'changePassword'])->name('settings.change-password');
    Route::put('/settings/update-password', [SettingController::class, 'updatePassword'])->name('settings.update-password');
    // categories
    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/datatable/ssd', [CategoryController::class, 'ssd'])->name('category-ssd');
});
Route::middleware(['auth', 'role:customer'])->name('user.')->group(function () {
    Route::get('/', [UserPageController::class, 'home'])->name('home');
});