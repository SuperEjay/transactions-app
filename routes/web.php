<?php

use Illuminate\Support\Facades\Route;

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
    return view('app');
});

Route::controller(App\Http\Controllers\CustomerController::class)
    ->prefix('customers')
    ->group(function () {
        Route::get('/', 'index')->name('customers.index');
        Route::get('/create', 'create')->name('customers.create');
        Route::post('/', 'store')->name('customers.store');
        Route::put('/{customer}', 'update')->name('customers.update');
        Route::get('/{customer}', 'edit')->name('customers.edit');
        Route::delete('/{customer}', 'destroy')->name('customers.destroy');
    });


Route::controller(App\Http\Controllers\InvoiceController::class)
    ->prefix('invoices')
    ->group(function () {
        Route::get('/', 'index')->name('invoices.index');
        Route::get('/create', 'create')->name('invoices.create');
        Route::post('/', 'store')->name('invoices.store');
        Route::get('/{invoice}/discount', 'discount')->name('invoices.discount');
        Route::put('/{invoice}/discount', 'applyDiscount')->name('invoices.applyDiscount');
        Route::get('/{invoice}', 'edit')->name('invoices.edit');
        Route::put('/{invoice}', 'update')->name('invoices.update');
        Route::delete('/{invoice}', 'destroy')->name('invoices.destroy');
    });
