<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\User\UserPageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\PermissionController;

Auth::routes();
Route::get('auth/google', [UserPageController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [UserPageController::class, 'handleGoogleCallback']);

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
    // Brands
    Route::resource('/brands', BrandController::class);
    Route::get('/brands/datatable/ssd', [BrandController::class, 'ssd'])->name('category-ssd');
    // products
    Route::resource('/products', ProductController::class);
    Route::get('/products/datatable/ssd', [ProductController::class, 'ssd'])->name('product-ssd');
    // orders
    Route::resource('/orders', OrderController::class);
    Route::get('/orders/datatable/ssd', [OrderController::class, 'ssd'])->name('order-ssd');
});
Route::middleware(['auth', 'role:customer|admin|manager'])->name('user.')->group(function () {
    Route::get('/', [UserPageController::class, 'home'])->name('home');
    Route::get('/shoes', [UserPageController::class, 'shop'])->name('shop');
    Route::get('/cart', [UserPageController::class, 'cart'])->name('cart');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
    Route::post('/orders', [UserOrderController::class, 'store'])->name('orders');
    Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('order_details');
    Route::post('/orders/ssd/summary', [AdminPageController::class, 'orderSummary'])->name('order-summary');
});