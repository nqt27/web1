<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use Illuminate\Auth\Events\Login;

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

Route::get('/', function () {
    return app(HomeController::class)->index();
})->name('home');

Route::middleware(['auth'])->group(function () {
    //admin
    Route::get('/admin', function () {
        return app(AdminController::class)->index();
    })->name('admin');
    //////////////////    MENU   ////////////////////////////////////
    Route::get('/admin/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/admin/addMenu', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::post('/admin/addsubmenu', [MenuController::class, 'addSub'])->name('menu.addSub');
    Route::post('/admin/updateOrder', [MenuController::class, 'updateOrder'])->name('menu.updateOrder');
    Route::get('/admin/submenu/{id}', [MenuController::class, 'submenu'])->name('menu.submenu');

    ///////////   PRODUCTS   /////////////////////////
    Route::get('/admin/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/admin/add-product', [ProductController::class, 'add'])->name('product.add');
    Route::post('/admin/addProduct', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/product-detail/{id}', [ProductController::class, 'show_update'])->name('product.show-update');
    Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::put('/admin/product-status/{id}', [ProductController::class, 'update_status'])->name('product.update_status');
    Route::post('/admin/delete-all', [ProductController::class, 'deleteAll'])->name('product.deleteAll');


    Route::get('/admin/news', function () {
        return app(AdminController::class)->news();
    })->name('news');
    Route::get('/admin/add-news', function () {
        return app(AdminController::class)->addNews();
    })->name('addNews');

    Route::get('/admin/logo', function () {
        return app(AdminController::class)->logo();
    })->name('logo');

    Route::get('/admin/seo-page', function () {
        return app(AdminController::class)->seo();
    })->name('seo');

    Route::get('/admin/logo', [LogoController::class, 'index'])->name('logo');
    Route::post('/admin/logo', [LogoController::class, 'store'])->name('logo.store');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [LoginController::class, 'forgot'])->name('forgot');
