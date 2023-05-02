@extends('layouts.layout')
@section('title')
    View Customer
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
                        <h5>Invoice to:</h5>
                        <table class="ml-2 invoice_view_info">
                            <tr>
                                <th>Company Name:</th>
                                <td> <span class="view_com_name"></span></td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td> <span class="view_name"></span></td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td> <span class="view_type"></span></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td> <span class="view_email"></span></td>
                            </tr>
                            <tr>
                                <th>Phone no.:</th>
                                <td> <span class="view_phone"></span></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td> <span class="view_address"></span></td>
                            </tr>
                            <tr>
                                <th>Information:</th>
                                <td> <span class="view_info"></span></td>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
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
                        </thead>
                        <tbody class="view_tBody"></tbody>
                    </table>
                    <p class="mb-5 mr-1 float-right">Total: <span class="view_total"></span></p>
                    <div class="clr"></div>
                    {{-- <p>Note: <span>Somthing....</span></p> --}}
                </div>
            </div>
        </div>
    </div>
    <div id="body-top">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row" id="customer_view">
                        <div class="col-12">
                            <h5 id="header_heading" class="text-center">Customer Information</h4>
                        </div>
                        <div class="col-md-6">
                            <table id="customer_info">
                                <tr>
                                    <th>Company Name:</th>
                                    <td>{{ $ledgers->company_name }}</td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $ledgers->name }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $ledgers->address }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $ledgers->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone no.:</th>
                                    <td>{{ $ledgers->phone }}</td>
                                </tr>
                            </table>
                            <table id="customer_transection_info">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-light">
                                    <tr>
                                        <td> {{ $debit }} </td>
                                        <td>{{ $credit }}</td>
                                        <td>{{ $balance }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ url('download-customer-pdf/' . $ledgers->id) }}" method="get">
                                @csrf
                                <div class="form-group" id="right_form">
                                    <label for="customer_transection_type">Select</label>
                                    <select name="type" id="customer_transection_type"
                                        class="form-control" view_id="{{ $ledgers->id }}">
                                        <option selected disabled>Select transection type</option>
                                        <option value="all">All</option>
                                        <option value="invoice">Invoice</option>
                                        <option value="payment">Payment</option>
                                    </select>
                                </div>

                                <div class="date_group d-flex">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">From</span>
                                        </div>
                                        <input type="text" id="from" class="form-control datepicker"
                                            value="{{ null }}" name="from">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">To</span>
                                        </div>
                                        <input type="text" id="to" class="form-control datepicker"
                                            value="{{ null }}" name="to">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-5 mx-auto">
                                        <div class="search_button_group">
                                            {{-- <a href="{{ url('download-customer-pdf/' . $ledgers->id) }}"
                                            class="btn btn-dark mr-1">Download</a> --}}
                                            <button class="btn btn-dark">Download</button>

                                            <button class="btn btn-warning ml-1" id="customer_search_view"
                                                view_id="{{ $ledgers->id }}">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content" style="margin-top: -25px; min-height:130px;padding-bottom: 10px">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col-md-12">
                <table class="table table-bordered mb-5">
                    <thead style="text-transform:uppercase">
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Calan</th>
                            <th scope="col">Cheque</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="get_customer_transection">
                        @include('view_transection')
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
