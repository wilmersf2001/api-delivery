<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryAvailabilityController;
use App\Http\Controllers\TakeOrderController;
use App\Http\Controllers\MyOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/establishments', [EstablishmentController::class, 'index']);
    Route::get('/establishments/{establishment}', [EstablishmentController::class, 'show']);

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::post('/cart/product-add/{product}', [CartController::class, 'store'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::put('/available', [DeliveryAvailabilityController::class, 'updateAviability']);
    Route::put('/coordinates', [DeliveryAvailabilityController::class, 'updateCoordinates']);
    Route::put('/order/take/{order}', [TakeOrderController::class, 'takeOrder']);

    Route::get('/my-order', [MyOrderController::class, 'index']);
    Route::put('/my-order/{order}', [MyOrderController::class, 'stateUpdate']);
});
