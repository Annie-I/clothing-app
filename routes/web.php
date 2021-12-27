<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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

//Landing page
Route::get('/', [ItemController::class, 'getAllItems']);

Auth::routes(['verify' => true]);

//User dashboard
Route::get(RouteServiceProvider::HOME, [DashboardController::class, 'getUserProfile'])->middleware(['verified'])->name('dashboard');

//User profile
Route::get('/user/{user}', [UserController::class, 'getPublicProfile'])->middleware(['verified']);

//Add user to favorites
Route::post('/user/{user}/add-to-favorites', [DashboardController::class, 'addToFavorites'])->middleware(['verified']);

//Remove user from favorites
Route::post('/user/{user}/remove-from-favorites', [DashboardController::class, 'removeFromFavorites'])->middleware(['verified']);

//User messages
Route::get('/received-messages', [DashboardController::class, 'getUserReceivedMessages'])->middleware(['verified']);

Route::get('/sent-messages', function () {
    return view('sent-messages');
})->middleware(['verified']);

//User data
Route::get('/user-information', [DashboardController::class, 'getUserData'])->middleware(['verified']);

//User favorite list
Route::get('/favorites', [DashboardController::class, 'getUserFavorites'])->middleware(['verified']);

//To edit user data
Route::get('/edit-user-information', [DashboardController::class, 'getUserDataForUpdate'])->middleware(['verified']);
Route::post('/edit-user-information', [DashboardController::class, 'postUserDataForUpdate'])->middleware(['verified'])->name('user.info.edit');

//Delete user
Route::post('/user/{user}/delete', [UserController::class, 'deleteUser'])->middleware(['verified'])->name('user.delete');

//Add item to sale
Route::get('/add-item', [DashboardController::class, 'viewFormToAddItemToSale'])->middleware(['verified']);

Route::post('/add-item', [DashboardController::class, 'addItemToSale'])->middleware(['verified'])->name('item.add');

//View single item
Route::get('/item/{item}', [ItemController::class, 'getSingleItem'])->middleware(['verified']);

//Delete single item
Route::post('/item/{item}/delete', [ItemController::class, 'deleteItem'])->middleware(['verified'])->name('item.delete');

//Edit signle item
Route::get('/item/{item}/edit', [ItemController::class, 'getItemDataForUpdate'])->middleware(['verified'])->name('item.edit');
Route::post('/item/{item}/edit', [ItemController::class, 'postItemDataForUpdate'])->middleware(['verified'])->name('item.update');

//Mark single item as sold
Route::post('/item/{item}/update-sale-status', [ItemController::class, 'changeItemSaleStatus'])->middleware(['verified'])->name('item.sale.status');

//User item list
Route::get('/my-active-items', [ItemController::class, 'getUserActiveItems'])->middleware(['verified']);
Route::get('/my-sold-items', [ItemController::class, 'getUserSoldItems'])->middleware(['verified']);

//Any user active item list
Route::get('/user/{user}/active-items', [ItemController::class, 'getSelectedUserItems'])->middleware(['verified']);

require __DIR__.'/auth.php';