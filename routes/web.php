<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', function () {
    return view('web-start');
});

Route::get('/products', [ProductController::class, 'productPage']);

Route::get('/cart', [OrderController::class, 'viewCart']); 

Route::put('/clearCart', [OrderController::class, 'clearCart']);

Route::put('/removeItem/{id}', [OrderController::class, 'removeItem']); 

Route::put('/completePayment', [OrderController::class, 'completePayment']);

Route::put('/addLineItem/{id}', [OrderController::class, 'addLineItem']);

Route::get('/dashboard', [OrderController::class, 'getOrders'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/viewOrder/{id}', [OrderController::class, 'viewOrder']);

Route::get('/product-inventory', [ProductController::class, 'getInventory']);

Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']);

Route::get('/add-product', [ProductController::class, 'add']);

Route::get('/customers', [CustomerController::class, 'customerList']);

Route::get('/viewCustomer/{id}', [CustomerController::class, 'customerView']);

Route::post('/add-new-product', [ProductController::class, 'addNewProduct']);

Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);

Route::put('/deactivate-product/{id}', [ProductController::class, 'deactivate']);

Route::put('/updateOrder/{id}', [OrderController::class, 'updateOrder']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
