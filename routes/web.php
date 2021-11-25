<?php

use App\Http\Controllers\DashboardController;
use App\Providers\RouteServiceProvider;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get(RouteServiceProvider::HOME, [DashboardController::class, 'getPublicProfile'])->middleware(['verified'])->name('dashboard');

Route::get('/messages', function () {
    return view('messages');
});

Route::get('/change-user-information', [DashboardController::class, 'getUserData'])->middleware(['verified']);

require __DIR__.'/auth.php';
