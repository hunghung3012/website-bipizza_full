<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatAIController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');;
Route::get('/cart', function () {
    return view('cart');
})->name('cart');;
Route::get('/menu', function () {
    return view('menu');
})->name('menu');;
Route::get('/login', function () {
    return view('login');
})->name('login');;
Route::get('/order', function () {
    return view('order');
})->name('order');;
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::prefix('/adminui')->name('adminui.')->group(
    function () {
        Route::get('/product/list', function () {
            return view('admin.product.list');
        })->name('list');
        Route::get('/product/add', function () {
            return view('admin.product.add');
        })->name('add');
        // listProductAdmin
    }
);
// Xóa cart
Route::get('/destroyCart', function () {
    Cart::destroy();
});


Route::get('/detail_product/{id}', [ProductController::class, "detailProduct"])->name('detail_product');
Route::get('/renderMenu', [ProductController::class, "renderMenu"])->name('renderMenu');
Route::get('/renderHome', [ProductController::class, "renderHome"])->name('renderHome');
Route::post('/addCart', [ProductController::class, "addCart"])->name('addCart')->middleware('checkLoginUser');
Route::get('/renderCart', [ProductController::class, "renderCart"])->name('renderCart')->middleware('checkLoginUser');
// Xóa sản phẩm
Route::get('/deleteProduct/{id}', [ProductController::class, "deleteProduct"])->name('deleteProduct')->middleware('checkLoginUser');


Route::get('/renderOrder/{condition?}', [OrderController::class, "renderOrder"])->name('renderOrder')->middleware('checkLoginUser');
Route::get('/renderOrder/cancelOrder/{condition?}', [OrderController::class, "cancelOrder"])->name('cancelOrder')->middleware('checkLoginUser');
// Xử lý thanh toán(thêm sản phẩm vào hóa đơn)
Route::post('/processOder', [OrderController::class, "processOder"])->name('processOder');

// Theem Binh luan
Route::post('/detail_product/addComment', [CommentController::class, "addComment"])->name('addComment')->middleware('checkLoginUser');
Route::post('/detail_product/addReponseComment', [CommentController::class, "addReponseComment"])->name('addReponseComment')->middleware('checkLoginUser');
Route::post('/detail_product/showReponseComment', [CommentController::class, "showReponseComment"])->name('showReponseComment');
// admin
Route::get('/admin', function () {
    return view('admin.layouts.layout2');
});

// ->middleware('checkLoginUser')
Route::prefix('/admin')->name('admin.')->middleware('checkLoginAdmin')->group(
    function () {
        // Product
        Route::get('/product/list/{condition?}', [ProductController::class, "listProductAdmin"])->name('product.list');
        Route::get('/product/add', [ProductController::class, "addProductPageAdmin"])->name('product.add');
        Route::post('/product/add', [ProductController::class, "addProductAdmin"])->name('product.postadd');
        Route::get('/product/edit/{id}', [ProductController::class, "editProductPageAdmin"])->name('product.edit');
        Route::post('/product/edit', [ProductController::class, "editProductAdmin"])->name('product.postedit');
        Route::get('/product/delete/{id}', [ProductController::class, "deleteProductAdmin"])->name('product.delete');

        // Category
        Route::get('/category/list/{condition?}', [CategoryController::class, "listCategoryAdmin"])->name('category.list');
        Route::get('/category/add', [CategoryController::class, "addCategoryPageAdmin"])->name('category.add');
        Route::post('/category/add', [CategoryController::class, "addCategoryAdmin"])->name('category.postadd');
        Route::get('/category/edit/{id}', [CategoryController::class, "editCategoryPageAdmin"])->name('category.edit');
        Route::post('/category/edit', [CategoryController::class, "editCategoryAdmin"])->name('category.postedit');
        Route::get('/category/delete/{id}', [CategoryController::class, "deleteCategoryAdmin"])->name('category.delete');

        // User
        Route::get('/user/list/{condition?}', [UserController::class, "listUserAdmin"])->name('user.list');
        Route::get('/user/add', [UserController::class, "addUserPageAdmin"])->name('user.add');
        Route::post('/user/add', [UserController::class, "addUserAdmin"])->name('user.postadd');
        Route::get('/user/edit/{id}', [UserController::class, "editUserPageAdmin"])->name('user.edit');
        Route::post('/user/edit', [UserController::class, "editUserAdmin"])->name('user.postedit');
        Route::get('/user/delete/{id}', [UserController::class, "deleteUserAdmin"])->name('user.delete');

        // order
        Route::get('/order/list/{condition?}', [OrderController::class, "listOrderAdmin"])->name('order.list');
        Route::get('/order/list_all/{condition?}', [OrderController::class, "listOrderAllAdmin"])->name('order.list_all');
        Route::get('/order/list_deli/', [OrderController::class, "listOrderDeliAdmin"])->name('order.list_deli');
        Route::get('/order/list_approve/', [OrderController::class, "listOrderApproveAdmin"])->name('order.list_approve');
        Route::get('/order/cancel/{id}', [OrderController::class, "cancelOrderAdmin"])->name('order.cancel');
        Route::post('/order/cancel', [OrderController::class, "cancelOrderEmailAdmin"])->name('order.cancel_with_email');
        Route::get('/order/approve/{id}', [OrderController::class, "approveOrderAdmin"])->name('order.approve');
        Route::get('/order/detail/{id}', [OrderController::class, "detailOrderAdmin"])->name('order.detail');
        Route::post('/order/edit', [OrderController::class, "editOrderAdmin"])->name('order.postedit');
        Route::get('/order/detail', [OrderController::class, "detailOrderAdmin"])->name('detailorder');

        // Coupon
        Route::get('/coupon/list/{condition?}', [CouponController::class, "listCouponAdmin"])->name('coupon.list');
        Route::get('/coupon/add', [CouponController::class, "addCouponPageAdmin"])->name('coupon.add');
        Route::post('/coupon/add', [CouponController::class, "addCouponAdmin"])->name('coupon.postadd');
        Route::get('/coupon/edit/{id}', [CouponController::class, "editCouponPageAdmin"])->name('coupon.edit');
        Route::post('/coupon/edit', [CouponController::class, "editCouponAdmin"])->name('coupon.postedit');
        Route::get('/coupon/delete/{id}', [CouponController::class, "deleteCouponAdmin"])->name('coupon.delete');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, "dashboardPageAdmin"])->name('dashboard');
    }
);
// Login

Route::get('/logout', [LoginController::class, "logout"])->name('logout');
Route::get('/login', [LoginController::class, "pageLogin"])->name('pageLogin');
Route::post('/checkUserLogin', [LoginController::class, "checkUserLogin"])->name('checkUserLogin');
Route::post('/addUser', [LoginController::class, "addUser"])->name('addUser');

// Login admin
Route::get('/admin/login', [LoginController::class, "pageLoginAdmin"])->name('pageLoginAdmin');
Route::post('/admin/login', [LoginController::class, "loginAdmin"])->name('loginAdmin');
Route::get('/admin/logout', [LoginController::class, "logoutAdmin"])->name('logoutAdmin');

// Delivery
Route::get('/delivery/list', [OrderController::class, "pageListDeli"])->name('pageListDeli');
Route::post('/delivery/submit', [OrderController::class, "deliUpdateStatus"])->name('deliUpdateStatus');
Route::post('/delivery/cancel', [OrderController::class, "deliCancelOrder"])->name('deliCancelOrder');
Route::get('/getSubTotal', [OrderController::class, "getSubTotal"])->name('pageListDeli');

// ChageQuality
Route::post('/renderCart/chageQuantity',[ProductController::class,"ajaxchageQuantity"])->name('ajax-chageQuantity');
// CheckCoupon
Route::post('/renderCart/checkCoupon',[OrderController::class,"ajaxcheckCoupon"]);

// Chat Ai
Route::get('/gpt',[ChatAIController::class,"index"]);
Route::post('/gpt',[ChatAIController::class,"processQuesion"]);

// forget pass
Route::post('/forget_pass',[LoginController::class,"forget_pass"])->name('forget_pass');
Route::get('/regain_pass',[LoginController::class,"regain_pass"])->name('regain_pass');
Route::post('/setNewPass',[LoginController::class,"setNewPass"])->name('setNewPass');
