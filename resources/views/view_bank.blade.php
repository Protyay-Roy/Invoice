@extends('layouts.layout')
@section('title')
    View Bank
@endsection
@section('content')
    <div id="body-top">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row" id="customer_view">
                        <div class="col-12">
                            <h5 id="header_heading" class="text-center">Bank Information</h4>
                        </div>
                        <div class="col-md-6">
                            <table id="customer_info">
                                <tr>
                                    <th>Bank Name:</th>
                                    <td>{{ $bank->name }}</td>
                                </tr>
                                <tr>
                                    <th>Account No:</th>
                                    <td>{{ $bank->account_number }}</td>
                                </tr>
                                <tr>
                                    <th>Brance:</th>
                                    <td>{{ $bank->branch }}</td>
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
                                <tbody class="bg-light">bank_transections
                                    <tr>
                                        <td> {{ $debit }} </td>
                                        <td>{{ $credit }}</td>
                                        <td>{{ $balance }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="date_group d-flex">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">From</span>
                                    </div>
                                    <input type="text" value="{{ date('d-m-y') }}"  class="form-control datepicker" id="from">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">To</span>
                                    </div>
                                    <input type="text" value="{{ date('d-m-y') }}"  class="form-control datepicker" id="to" >
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col-md-5 mx-auto">
                                    <div class=" search_button_group">
                                        <button class="btn btn-dark mr-1">Download</button>
                                        <button class="btn btn-success ml-1" id="bank_search_view"
                                            view_id="{{ $bank->id }}">View</button>
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
    <div id="main-body" class="pb-5">
        <div class="container body_content" style="margin-top: -25px; min-height:130px;padding-bottom: 10px">
            <div class="col-md-12">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="get_bank_transection">
                        @include('view_bank_transection')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
