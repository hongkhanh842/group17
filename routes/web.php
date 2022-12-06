<?php

use App\Http\Controllers\home\AuthController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Socialite route
Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.redirect');

Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');
//

//AUTH ROUTES
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logging'])->name('logging');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('admin/login', [\App\Http\Controllers\admin\AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\admin\AuthController::class, 'logging'])->name('admin.logging');*/

Route::get('/mail/{email}', [MailController::class, 'index'])->name('mail');
//___
