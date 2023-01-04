<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('anasayfa');
Route::get('/anasayfa', [HomeController::class, 'index'])->name('anasayfa');

Route::get('/send-location', [HomeController::class, 'sendLocation'])->name('send-locations');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('profile-get');
    Route::post('/', [AdminController::class, 'konumGetir'])->name('profile-post');
});
