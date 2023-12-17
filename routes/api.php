<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/order/approve/{id}',[OrderController::class,"ajaxApproveOrderAdmin"])->name('ajax-order.approve');
Route::get('/order/deli/{id}',[OrderController::class,"ajaxDeliOrderAdmin"])->name('ajax-order.deli');
Route::post('/order/cancel',[OrderController::class,"ajaxCancelOrderAdmin"])->name('ajax-order');
Route::post('/order/cancelWithEmail',[OrderController::class,"ajaxCancelEmailOrderAdmin"])->name('ajax-order-email');

// Menu
Route::post('/menu',[ProductController::class,"ajaxMenuFilter"])->name('ajax-order');

// CheckQuantity

// Route::get('/cart/chageQuantity',[ProductController::class,"ajaxchageQuantity"])->name('ajax-chageQuantity');
// test
Route::post('/cart/getSubTotal',[OrderController::class,"getSubTotal"])->name('ajax-checkCoupan');
// dash board
Route::get('/dashboard',[DashboardController::class,"data_chart_dashboard"])->name('ajax-dashboard');