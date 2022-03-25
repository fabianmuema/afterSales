<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::get('/customers/delete/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/update/{customer}', [CustomerController::class, 'update'])->name('customers.update');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.show');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/edit/{payment}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('/payments/update/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::get('/payments/delete/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});
