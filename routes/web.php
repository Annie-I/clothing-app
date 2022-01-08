<?php

use App\Http\Controllers\ComplaintController;
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
Route::get('/sent-messages', [DashboardController::class, 'getUserSentMessages'])->middleware(['verified']);

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
Route::get('/item/{item}', [ItemController::class, 'getSingleItem']);

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

//Write and send a message to any user
Route::get('/user/{user}/compose-message', [DashboardController::class, 'viewFormToComposeMessage'])->middleware(['verified']);
Route::post('/user/{user}/compose-message', [DashboardController::class, 'sendMessage'])->middleware(['verified'])->name('message.send');

//View message
Route::get('/message/{message}/read', [DashboardController::class, 'viewSingleMessage'])->middleware(['verified']);
Route::post('/message/{message}/deleteSent', [DashboardController::class, 'deleteSentMessage'])->middleware(['verified'])->name('sent.message.delete');
Route::post('/message/{message}/deleteReceived', [DashboardController::class, 'deleteReceivedMessage'])->middleware(['verified'])->name('received.message.delete');

//Write and send a complait to administration
Route::get('/compose-complaint', [ComplaintController::class, 'viewFormToComposeComplaint'])->middleware(['verified']);
Route::post('/compose-complaint', [ComplaintController::class, 'postComplaint'])->middleware(['verified'])->name('complaint.send');

//Add review
Route::get('/user/{user}/add-review', [UserController::class, 'viewFormToAddReview'])->middleware(['verified']);
Route::post('/user/{user}/add-review', [UserController::class, 'postFormToAddReview'])->middleware(['verified'])->name('review.add');

//Edit review
Route::get('/user/{user}/edit-review', [UserController::class, 'viewFormToEditReview'])->middleware(['verified']);
Route::post('/user/{user}/edit-review', [UserController::class, 'postFormToEditReview'])->middleware(['verified'])->name('review.edit');

//Delete review
Route::post('/review/{review}/delete-review', [UserController::class, 'deleteReview'])->middleware(['verified'])->name('review.delete');

//View reviews left about the user
Route::get('/user/{user}/all-reviews', [UserController::class, 'getAllReviewsAboutUser'])->middleware(['verified']);

//Change user password
Route::get('/change-password', [UserController::class, 'viewFormToChangePassword'])->middleware(['verified']);
Route::post('/change-password', [UserController::class, 'postFormToChangePassword'])->middleware(['verified'])->name('password.change');

// Admin route group
Route::middleware(['verified', 'admin'])->group(function () {
    //View blocked user list
    Route::get('/blocked-users', [UserController::class, 'getBlockedUsers']);

    //Block / unblock user
    Route::post('/user/{user}/update-system-availability', [UserController::class, 'updateSystemAvailability'])->middleware(['verified'])->name('user.update.availability');

    //Admin complaint lists
    Route::get('/new-complaint-list', [ComplaintController::class, 'getNewComplaints']);
    Route::get('/in-progress-complaint-list', [ComplaintController::class, 'getInProgressComplaints']);
    Route::get('/closed-complaint-list', [ComplaintController::class, 'getClosedComplaints']);

    //View complaint
    Route::get('/complaint/{complaint}/view', [ComplaintController::class, 'getSingleComplaint']);

    //Edit complaint status
    Route::get('/complaint/{complaint}/edit', [ComplaintController::class, 'viewFormToEditComplaint']);
    Route::post('/complaint/{complaint}/edit', [ComplaintController::class, 'postFormToEditComplaint'])->name('complaint.status.update');
});

require __DIR__.'/auth.php';