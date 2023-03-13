<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SupplierController;
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
// CUSTOMER ROUTE
Route::view('customer', 'customer')->name('customer-list');
Route::post('create-customer', [CustomerController::class, 'createCustomer'])->name('create-customer');
Route::get('update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::get('delete-customer/{id}', [CustomerController::class, 'destroy']);
// SUPPLIER ROUTE
Route::view('supplier', 'supplier')->name('supplier-list');
Route::post('create-supplier', [SupplierController::class, 'createSupplier'])->name('create-supplier');
Route::get('update-supplier/{id}', [SupplierController::class, 'updateSupplier']);
Route::get('delete-supplier/{id}', [SupplierController::class, 'destroy']);
