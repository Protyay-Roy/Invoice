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
                                <tbody class="bg-light">
                                    <tr>
                                        <td> {{ $bank_transection->debit }} </td>
                                        <td>{{ $bank_transection->credit }}</td>
                                        <td>{{ $bank_transection->debit - $bank_transection->credit }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="right_form">
                                <label for="exampleInputEmail1">Select Type</label>
                                <select name="" id="select_type" class="form-control">
                                    <option selected>Select</option>
                                </select>
                            </div>

                            <div class="date_group d-flex">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">from</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Username" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">to</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Username" aria-label="Username"
                                        aria-describedby="basic-addon1">
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
        <div class="container body_content" style="margin-top: -25px; min-height:130px">
            <div class="col-md-12">
                <table class="table table-bordered mb-5">
                    <tHead>
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Note</th>
                        </tr>
                    </tHead>
                    <tBody>
                        <tr>
                            <td>{{ $bank_transection->entry_date }}</td>
                            <td>{{ $bank_transection->debit }}</td>
                            <td>{{ $bank_transection->credit }}</td>
                            <td>{{ $bank_transection->note == 'N/A' ? 'Empty' : $bank_transection->note }}</td>
                        </tr>
                    </tBody>
                </table>

            </div>

        </div>
    </div>
@endsection