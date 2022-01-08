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

// Auth::routes(['verify' => true]);

//Landing page
Route::get('/', [ItemController::class, 'getAllItems']);

//View single item
Route::get('/item/{item}', [ItemController::class, 'getSingleItem']);

// Verified user group
Route::middleware(['verified'])->group(function () {
    //User dashboard
    Route::get(RouteServiceProvider::HOME, [DashboardController::class, 'getUserProfile'])->name('dashboard');

    //User profile
    Route::get('/user/{user}', [UserController::class, 'getPublicProfile']);

    //Add user to favorites
    Route::post('/user/{user}/add-to-favorites', [DashboardController::class, 'addToFavorites']);

    //Remove user from favorites
    Route::post('/user/{user}/remove-from-favorites', [DashboardController::class, 'removeFromFavorites']);

    //User messages
    Route::get('/received-messages', [DashboardController::class, 'getUserReceivedMessages']);
    Route::get('/sent-messages', [DashboardController::class, 'getUserSentMessages']);

    //User data
    Route::get('/user-information', [DashboardController::class, 'getUserData']);

    //User favorite list
    Route::get('/favorites', [DashboardController::class, 'getUserFavorites']);

    //To edit user data
    Route::get('/edit-user-information', [DashboardController::class, 'getUserDataForUpdate']);
    Route::post('/edit-user-information', [DashboardController::class, 'postUserDataForUpdate'])->name('user.info.edit');

    //Delete user
    Route::post('/user/{user}/delete', [UserController::class, 'deleteUser'])->name('user.delete');

    //Add item to sale
    Route::get('/add-item', [DashboardController::class, 'viewFormToAddItemToSale']);
    Route::post('/add-item', [DashboardController::class, 'addItemToSale'])->name('item.add');

    //Delete single item
    Route::post('/item/{item}/delete', [ItemController::class, 'deleteItem'])->name('item.delete');

    //Edit signle item
    Route::get('/item/{item}/edit', [ItemController::class, 'getItemDataForUpdate'])->name('item.edit');
    Route::post('/item/{item}/edit', [ItemController::class, 'postItemDataForUpdate'])->name('item.update');

    //Mark single item as sold
    Route::post('/item/{item}/update-sale-status', [ItemController::class, 'changeItemSaleStatus'])->name('item.sale.status');

    //User item list
    Route::get('/my-active-items', [ItemController::class, 'getUserActiveItems']);
    Route::get('/my-sold-items', [ItemController::class, 'getUserSoldItems']);

    //Any user active item list
    Route::get('/user/{user}/active-items', [ItemController::class, 'getSelectedUserItems']);

    //Write and send a message to any user
    Route::get('/user/{user}/compose-message', [DashboardController::class, 'viewFormToComposeMessage']);
    Route::post('/user/{user}/compose-message', [DashboardController::class, 'sendMessage'])->name('message.send');

    //View message
    Route::get('/message/{message}/read', [DashboardController::class, 'viewSingleMessage']);
    Route::post('/message/{message}/deleteSent', [DashboardController::class, 'deleteSentMessage'])->name('sent.message.delete');
    Route::post('/message/{message}/deleteReceived', [DashboardController::class, 'deleteReceivedMessage'])->name('received.message.delete');

    //Write and send a complait to administration
    Route::get('/compose-complaint', [ComplaintController::class, 'viewFormToComposeComplaint']);
    Route::post('/compose-complaint', [ComplaintController::class, 'postComplaint'])->name('complaint.send');

    //Add review
    Route::get('/user/{user}/add-review', [UserController::class, 'viewFormToAddReview']);
    Route::post('/user/{user}/add-review', [UserController::class, 'postFormToAddReview'])->name('review.add');

    //Edit review
    Route::get('/user/{user}/edit-review', [UserController::class, 'viewFormToEditReview']);
    Route::post('/user/{user}/edit-review', [UserController::class, 'postFormToEditReview'])->name('review.edit');

    //Delete review
    Route::post('/review/{review}/delete-review', [UserController::class, 'deleteReview'])->name('review.delete');

    //View reviews left about the user
    Route::get('/user/{user}/all-reviews', [UserController::class, 'getAllReviewsAboutUser']);

    //Change user password
    Route::get('/change-password', [UserController::class, 'viewFormToChangePassword']);
    Route::post('/change-password', [UserController::class, 'postFormToChangePassword'])->name('password.change');

});

// Admin route group
Route::middleware(['verified', 'admin'])->group(function () {
    //View blocked user list
    Route::get('/blocked-users', [UserController::class, 'getBlockedUsers']);

    //Block / unblock user
    Route::post('/user/{user}/update-system-availability', [UserController::class, 'updateSystemAvailability'])->name('user.update.availability');

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