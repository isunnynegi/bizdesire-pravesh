<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProfileController, HomeController, CartController};
use App\Http\Controllers\Admin\{AuthenticatedSessionController, DashboardController, ProductController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('landing');

Route::middleware('auth')->group(function () {
    /** Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Cart */
    Route::get('/add-to-cart/{id}', [CartController::class, 'addtocart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/updateitem/{action}/{itemid}', [CartController::class, 'update'])->name('cart.itemupdate');

});

require __DIR__.'/auth.php';

Route::middleware('guest:admin')->group(function(){
    Route::get('/admin-login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/admin-login', [AuthenticatedSessionController::class, 'store'])->name('admin.loggedin');
});

Route::middleware('auth:admin')->name('admin.')->group(function(){
    Route::post('/admin-logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    /** Product crud operation */
    Route::get('/admin-product', [ProductController::class, 'index'])->name('product_index');
    Route::get('/admin-product/create', [ProductController::class, 'create'])->name('product_create');
    Route::post('/admin-product/create', [ProductController::class, 'store'])->name('product_store');
    Route::get('/admin-product/edit/{id}', [ProductController::class, 'edit'])->name('product_edit');
    Route::put('/admin-product/edit/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::post('/admin-product/delete/{id}', [ProductController::class, 'destroy'])->name('product_delete');
});