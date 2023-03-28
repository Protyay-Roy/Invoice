@extends('layouts.layout')
@section('title')
    View Customer
@endsection
@section('content')
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
                            <div class="form-group" id="right_form">
                                <label for="customer_transection_type">Select</label>
                                <select name="customer_transection_type" id="supplier_transection_type" class="form-control"
                                    view_id="{{ $ledgers->id }}">
                                    <option selected disabled>Select transection type</option>
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
                                        value="{{ null }}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">To</span>
                                    </div>
                                    <input type="text" id="to" class="form-control datepicker"
                                        value="{{ null }}">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-5 mx-auto">
                                    <div class=" search_button_group">
                                        <button class="btn btn-dark mr-1">Download</button>
                                        <button class="btn btn-success ml-1" id="supplier_search_view"
                                            view_id="{{ $ledgers->id }}">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content" style="margin-top: -25px; min-height:130px;padding-bottom: 10px">
            <div class="col-md-12">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Note</th>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    {{-- @foreach ($transections as $transection)
                            @php

                                if (!empty($transection->debit) || $transection->debit != 0) {
                                    $total_balance += $transection->debit;
                                }
                                if (!empty($transection->credit) || $transection->credit != 0) {
                                    $total_balance -= $transection->credit;
                                }
                            @endphp
                            <tr>
                                <td>{{ $transection->entry_date }}</td>
                                <td>{{ $transection->type }}</td>
                                <td>{{ $transection->debit }}</td>
                                <td>{{ $transection->credit }}</td>
                                <td>{{ $total_balance }}</td>
                                <td>{{ $transection->note == 'N/A' ? 'Empty' : $transection->note }}</td>
                                <td>{{ $transection->bank_name == null ? 'Empty' : $transection->bank_name }}</td>
                                <td>
                                    @if ($transection->type == 'INVOICE')
                                        <a href="{{ url('edit-invoice/' . $transection->id) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    <tbody id="get_supplier_transection">
                        @include('view_transection')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
