<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingsController;

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


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/movies/{movie}', [HomeController::class, 'show'])->name('movies.show');
Route::post('/booking.store', [BookingsController::class, 'store'])->name('booking.store');
Route::get('/booking.index', [BookingsController::class, 'index'])->name('booking.index');


Auth::routes();

