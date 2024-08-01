<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\clients\PageController;
use App\Http\Controllers\clients\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', [PageController::class, 'homePage']);
Route::get('/shop/{category_id}', [PageController::class, 'shopPage']);
Route::get('/detail-product/{product_id}', [PageController::class, 'detailPage']);
Route::get('/check-out', [PageController::class, 'detailPage']);
Route::post('/addToCart', [PageController::class, 'addToCart']);
Route::delete('/cartRemove/{id}', [PageController::class, 'removeFromCart']);
Route::get('/cart', [PageController::class, 'cartPage']);
Route::get('/check-out', [PageController::class, 'checkOutPage']);


Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth_login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'auth_register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('payment/create', [PaymentController::class, 'vnPay'])->name('payment.create');
Route::get('paymentCallback', [PaymentController::class, 'callBack'])->name('payment.callback');

Route::group(['middleware' => 'userAdmin', 'prefix' => 'panel'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::resource('/roles', RoleController::class)->except('show');
    Route::resource('/users', UserController::class)->except('show');
    Route::resource('/categories', CategoryController::class)->except('show');
    Route::resource('/products', ProductController::class)->except('show');
    Route::resource('/banners', BannerController::class)->except('show');

    Route::get('/orders', [OrderController::class, 'orders']);
    Route::get('/edit-order/{order_id}', [OrderController::class, 'editOrder']);
    Route::patch('/update-order/{order_id}', [OrderController::class, 'updateOrder']);
    Route::get('/detail-order/{order_id}', [OrderController::class, 'detailOrder']);
    Route::get('/generateInvoice/{order_id}', [InvoiceController::class, 'generateInvoice']);
});
