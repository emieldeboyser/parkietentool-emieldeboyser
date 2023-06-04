<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CreateSubscriptionController;
use App\Http\Controllers\DeedsController;
use App\Http\Controllers\WebhookController;
use App\View\Components\MollieController;
use Mollie\Api\Resources\Profile;

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

// root route
Route::get('/', [MainController::class, 'index'])->name('welcome');

// authentication
Route::get('/login', [AuthController::class, 'index'])->name('news.index');
Route::post('/login', [AuthController::class, 'login']);
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');

// order view
Route::get('/order', [OrderController::class, 'index'])->name('order.index');

// profile
Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
Route::get('/profile/orders/{reference}', [ProfileController::class, 'show'])->name('profile.show');

Route::post('/profile/settings', [ProfileController::class, 'update']);
Route::post('/profile/settings/picture', [ProfileController::class, 'updatePicture']);
Route::get('/profile/lidgeld', [ProfileController::class, 'lidgeld'])->name('profile.lidgeld');

// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add']);
Route::get('/cart/deleteItem/{itemId}', [CartController::class, 'deleteItem']);
// Route::post("/cart/checkout", [CartController::class, 'store']);

// deeds
Route::get('/deeds', [DeedsController::class, 'index'])->name('deeds.index');
Route::get('/deeds/{reference}', [DeedsController::class, 'show'])->name('deeds.show');
Route::get('/deeds/{reference}/pdf', [DeedsController::class, 'createPDF'])->name('deeds.pdf');


// mollie
Route::get('/cart/checkout', [CheckOutController::class, 'checkout'])->name('checkout');
Route::get('/cart/checkout/succes', [CheckOutController::class, 'succes'])->name('checkout.succes');
Route::get('/cart/checkout/succesCash', [CheckOutController::class, 'cashIndex'])->name('checkout.succes.cash');
Route::get('/cart/checkout/succesBank', [CheckOutController::class, 'bankIndex'])->name('checkout.succes.bank');

Route::post('/webhooks/mollie', [WebhookController::class, 'handle'])->name('webhooks.mollie');
Route::post('/webhooks/subscription', [WebhookController::class, 'handleSubscription'])->name('webhooks.mollie.subscription');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
