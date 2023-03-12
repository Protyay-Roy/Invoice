<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', function () {
    return view('index');
});

Route::match(['get', 'post'], 'create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
Route::view('invoice', 'invoice_list')->name('invoice-list');
Route::view('customer', 'customer')->name('customer-list');
Route::post('create-customer', [CustomerController::class, 'createCustomer'])->name('create-customer');
Route::get('update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::get('delete-customer/{id}', [CustomerController::class, 'destroy']);
