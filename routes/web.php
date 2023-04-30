<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DailyEntryController;
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

// Route::get('/', function () {
//     return view('index');
// });

// CUSTOMER ROUTE
Route::view('customer', 'customer')->name('customer-list');
Route::post('create-customer', [CustomerController::class, 'createCustomer'])->name('create-customer');
Route::get('update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::get('view-customer/{id}', [CustomerController::class, 'viewCustomer']);
Route::get('delete-customer/{id}', [CustomerController::class, 'destroy']);
// CUSTOMER INVOICE VIEW AND DELETE
Route::get('view-customer/view-invoice/{id}', [InvoiceController::class, 'viewInvoice']);
Route::get('view-customer/delete-invoice/{id}', [InvoiceController::class, 'destroy']);

// SUPPLIER ROUTE
Route::view('supplier', 'supplier')->name('supplier-list');
Route::post('create-supplier', [SupplierController::class, 'createSupplier'])->name('create-supplier');
Route::get('update-supplier/{id}', [SupplierController::class, 'updateSupplier']);
Route::get('view-supplier/{id}', [SupplierController::class, 'viewSupplier']);
Route::get('delete-supplier/{id}', [SupplierController::class, 'destroy']);

// INVOICE ROUTE
Route::view('/', 'invoice_list')->name('invoice-list');
Route::match(['get', 'post'], 'create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
Route::match(['get', 'post'], 'edit-invoice/{id}', [InvoiceController::class, 'editInvoice']);
Route::get('delete-invoice/{id}', [InvoiceController::class, 'destroy']);
Route::get('view-invoice/{id}', [InvoiceController::class, 'viewInvoice']);

// BANK ROUTE
Route::view('bank', 'bank')->name('bank-list');
Route::post('create-bank', [BankController::class, 'createBank'])->name('create-bank');
Route::get('update-bank/{id}', [BankController::class, 'updateBank']);
Route::get('view-bank/{id}', [BankController::class, 'viewBank']);
Route::get('delete-bank/{id}', [BankController::class, 'destroy']);

// DAILY ENTRY ROUTE
// Route::view('daily_entry-list', 'create_daily_entry')->name('daily_entry');
Route::view('daily_entry-list', 'entry_list')->name('daily_entry-list');
Route::get('profile/{type}', [DailyEntryController::class, 'getProfile']);
Route::get('{route}/profile/{type}', [DailyEntryController::class, 'getEditProfile']);
Route::get('get_bank', [DailyEntryController::class, 'getBank']);
Route::match(['get', 'post'], 'add-edit-daily_entry', [DailyEntryController::class, 'addEditEntry'])->name('add-edit-daily_entry');
Route::match(['get', 'post'], 'edit-daily_entry/{id}', [DailyEntryController::class, 'editEntry'])->name('edit-entry');
Route::get('delete-entry/{transection}', [InvoiceController::class, 'destroy']);

// DOWNLOAD PDF
Route::get('download-pdf/{id}', [InvoiceController::class, 'downloadPDF']);
Route::get('download-customer-pdf/{id}', [CustomerController::class, 'downloadPDF']);
Route::get('download-supplier-pdf/{id}', [SupplierController::class, 'downloadPDF']);
Route::get('download-bank-pdf/{id}', [BankController::class, 'downloadPDF']);

// Route::view('pdf', 'download_pdf');


