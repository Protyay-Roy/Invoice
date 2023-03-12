<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function createInvoice()
    {
        return view('create_invoice');
    }
}
