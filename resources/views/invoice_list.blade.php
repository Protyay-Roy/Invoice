@extends('layouts.layout')
@section('title')
    Invoice List
@endsection
@section('content')
    <!-- invoice view Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content px-4">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="invoice_view">
                    <p class="pl-1 pt-3">Date: <span class="view_date"></span></p>
                    <hr>
                    <div>
                        <h6>Invoice to:</h6>
                        <ul>
                            <li>Name: <span class="view_name">hii</span></li>
                            <li>Company Name: <span class="view_com_name"></span></li>
                            <li>Type: <span class="view_type"></span></li>
                            <li>Email: <span class="view_email"></span></li>
                            <li>Phone no.: <span class="view_phone"></span></li>
                            <li>Address: <span class="view_address"></span></li>
                            <li>Info: <span class="view_info"></span></li>
                        </ul>
                    </div>
                    <table class="table table-bordered mb-5">
                        <tHead>
                            <tr>
                                <th scope="col">Entry date</th>
                                <th scope="col">Item</th>
                                <th scope="col">Size</th>
                                <th scope="col">Width</th>
                                <th scope="col">Height</th>
                                <th scope="col">Square ft</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Square ft</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </tHead>
                        <tBody class="view_tBody">

                        </tBody>
                    </table>

                    <p class="mb-5 mr-1 float-right">Total: <span class="view_total"></span></p>
                    <div class="clr"></div>
                    <p>Note: <span>Somthing....</span></p>

                    <button id="pdf_link" class="btn btn-success float-right mt-2 mb-4 mr-3">Download pdf</button>
                    <div class="clr"></div>

                </div>
            </div>
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h2>Transition details</h2>
                    <div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>name</th>
                                    <th>BANK/CASH</th>
                                    <th>DEBIT</th>
                                    <th>CREDIT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Transection::where('type', 'INVOICE')->get() as $invoice)
                                    <tr>
                                        <td>{{ $invoice->entry_date }}</td>
                                        <td>{{ $invoice->getCustomer->name }}</td>
                                        <td>{{ $invoice->bank_name }}</td>
                                        <td>{{ $invoice->debit }}</td>
                                        <td>{{ $invoice->credit }}</td>
                                        <td>
                                            <button class="btn btn-success" id="view_invoice"
                                                value="{{ $invoice->id }}">View</button>
                                            <a href="{{ url('edit-invoice/' . $invoice->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <button value="{{ $invoice->id }}" id="delete_invoice"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
