<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\ProductController; 

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
    return view('welcome');
});

Route::get('/dashboard', [OrderController::class, 'getOrders'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/viewOrder/{id}', [OrderController::class, 'viewOrder']);

Route::get('/product-inventory', [ProductController::class, 'getInventory']);

Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']); 

Route::get('/add-product', [ProductControler::class, 'add']); 

Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']); 

Route::put('/deactivate-product/{id}', [ProductController::class, 'deactivate']);

Route::put('/updateOrder/{id}', [OrderController::class, 'updateOrder']); 


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
