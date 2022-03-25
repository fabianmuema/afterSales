<?php

use App\Http\Controllers\CustomerController;
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
    Route::get('/dashboard', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::get('/customers/delete/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::post('/customers/update/{customer}', [CustomerController::class, 'update'])->name('customers.update');
});
