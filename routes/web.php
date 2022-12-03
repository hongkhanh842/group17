<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\home\AuthController;
use App\Http\Controllers\home\CategoryController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\ProductController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

//AUTH ROUTES
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logging'])->name('logging');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');

Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');
Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/login', [\App\Http\Controllers\admin\AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\admin\AuthController::class, 'logging'])->name('admin.logging');
//___

//HOME ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('product')
    ->controller(ProductController::class)->name('product.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });

Route::prefix('category')
    ->controller(CategoryController::class)->name('category.')
    ->group(function () {
        Route::get('/show/{id}', 'show')->name('show');
    });
