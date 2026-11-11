<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
// Admin Controllers
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/producto/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/categoria/{id}', [ShopController::class, 'category'])->name('shop.category');

Route::get('/nosotros', [PageController::class, 'about'])->name('pages.about');
Route::get('/contacto', [PageController::class, 'contact'])->name('pages.contact');

Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');

// Cart / Wishlist functionality
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/eliminar', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout/{provider}', [PaymentController::class, 'start'])
    ->where('provider', 'paypal')
    ->name('payments.start');
Route::post('/checkout/paypal/capture/{order}', [PaymentController::class, 'capturePaypal'])
    ->middleware('signed')
    ->name('payments.paypal.capture');
Route::get('/pago/confirmacion/{order}', [PaymentController::class, 'success'])
    ->name('payments.success');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth middleware in the future)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categorias', CategoryController::class);
    Route::resource('productos', ProductController::class);
    Route::resource('pedidos', OrderController::class);
    Route::resource('usuarios', UserController::class);
});
