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
                                        <td> {{ $transections->debit }} </td>
                                        <td>{{ $transections->credit }}</td>
                                        <td>{{ $transections->debit - $transections->credit }}</td>
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
    <div id="main-body">
        <div class="container body_content" style="margin-top: -25px; min-height:130px">
            <div class="col-md-12">
                <table class="table table-bordered mb-5">
                    <tHead>
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Note</th>
                            <th scope="col">Bank Name</th>
                        </tr>
                    </tHead>
                    <tBody>
                        <tr>
                            <td>{{ $transections->entry_date }}</td>
                            <td>{{ $transections->debit }}</td>
                            <td>{{ $transections->credit }}</td>
                            <td>{{ $transections->note == 'N/A' ? 'Empty' : $transections->note }}</td>
                            <td>{{ $transections->bank_name == null ? 'Empty' : $transections->bank_name }}</td>
                        </tr>
                    </tBody>
                </table>

            </div>

        </div>
    </div>
@endsection
