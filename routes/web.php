<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\MainController;
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

//admin login
Route::get('/admin/login', [LoginController::class, 'index'])->name('get-login'); //get view login
Route::post('/login-admin', [LoginController::class, 'LoginAdmin'])->name('login-admin'); //login

//yeu cau dang nhap
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('dashboard'); //dashboard

        //category
        Route::prefix('categories')->group(function () {
            Route::get('/add', [CategoryController::class, 'create']);
            Route::post('/save', [CategoryController::class, 'save'])->name('save-cate');
            Route::get('/list', [CategoryController::class, 'index']);
            Route::get('edit/{category}', [CategoryController::class, 'showEdit']);
            Route::post('edit/{category}', [CategoryController::class, 'update'])->name('update-cate');
            Route::DELETE('/delete', [CategoryController::class, 'delete'])->name('delete-category');
        });


        //products
        Route::prefix('products')->group(function () {
            Route::get('/add', [ProductController::class, 'create']);
            Route::post('/add', [ProductController::class, 'store']);
            Route::get('/list', [ProductController::class, 'index']);
            Route::get('/edit/{product}', [ProductController::class, 'show'])->name('edit_product');
            Route::post('/edit/{product}', [ProductController::class, 'update'])->name('update_product');
            Route::DELETE('/delete', [ProductController::class, 'destroy'])->name('delete-product');
        });


        //slider
        Route::prefix('slider')->group(function () {
            Route::get('/add', [SliderController::class, 'create']);
            Route::post('/add', [SliderController::class, 'store']);
            Route::get('/list', [SliderController::class, 'index'])->name('list_slider');
            Route::get('/edit/{slider}', [SliderController::class, 'show'])->name('edit_slider');
            Route::post('/edit/{slider}', [SliderController::class, 'update'])->name('update_slider');
            Route::DELETE('/delete', [SliderController::class, 'destroy'])->name('delete-slider');
        });

        //upload
        Route::post('/upload/storage', [UploadController::class, 'store']);
    });
});

Route::get('/home', [MainController::class, 'index'])->name('home');
Route::post('/load-products', [MainController::class, 'LoadProducts']);
Route::get('category/{id}/{slug}.html', [CategoryController::class, 'indexHome'])->name('cate-home');
Route::get('product-detail/{id}/{slug}.html', [ProductController::class, 'ProductDetails'])->name('product-detail');
Route::get('add-to-cart', [CartController::class, 'index'])->name('add-cart');
Route::get('cart', [CartController::class, 'show'])->name('cart');
Route::post('/update-cart', [CartController::class, 'update']);
Route::get('/delete-cart/{id}', [CartController::class, 'destroy'])->name('cart-delete');
