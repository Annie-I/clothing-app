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

// Landing page
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

//User dashboard
Route::get(RouteServiceProvider::HOME, [DashboardController::class, 'getUserProfile'])->middleware(['verified'])->name('dashboard');

//User profile
Route::get('/user/{user}', [DashboardController::class, 'getPublicProfile'])->middleware(['verified']);

//User messages
Route::get('/messages', function () {
    return view('messages');
})->middleware(['verified']);

//User data
Route::get('/user-information', [DashboardController::class, 'getUserData'])->middleware(['verified']);

//User favorite list
Route::get('/favorites', function () {
    return view('favorites');
})->middleware(['verified']);

//To edit user data
Route::get('/edit-user-information', [DashboardController::class, 'getUserDataForUpdate'])->middleware(['verified']);
Route::post('/edit-user-information', [DashboardController::class, 'postUserDataForUpdate'])->middleware(['verified'])->name('user.info.edit');;

require __DIR__.'/auth.php';