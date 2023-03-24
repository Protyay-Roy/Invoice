@extends('layouts.layout')
@section('title')
    View Customer
@endsection
@section('content')
    <div id="body-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-lg-3 col-sm-12">
                    <div class="body-top-content">
                        <ul>
                            <li>All Customer</li>
                            <li>Active Customer</li>
                            <li>Inactive Customer</li>
                            <li>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Add customer
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content" style="margin-top: -25px;">
            <div class="row"  id="customer_view">
                <div class="col-12">
                    <h4 class="modal-title m-auto" id="exampleModalLabel">Customer Information</h4>
                </div>
                <div class="col-md-6 mt-1">
                    <ul>
                        <li>Name: <span class="view_name"></span></li>
                        <li>Company Name: <span class="view_com_name"></span></li>
                        <li>Type: <span class="view_type"></span></li>
                        <li>Email: <span class="view_email"></span></li>
                        <li>Phone no.: <span class="view_phone"></span></li>
                        <li>Address: <span class="view_address"></span></li>
                        <li>Info: <span class="view_info"></span></li>
                    </ul>
                </div>
                <div class="col-md-6">

                </div>
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
                        <tBody class="view_tBody">

                        </tBody>
                    </table>

                </div>
            </div>
            {{-- <div id="invoice_view">
                <div>
                    <ul>
                        <li>Name: <span class="view_name"></span></li>
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
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Note</th>
                            <th scope="col">Bank Name</th>
                        </tr>
                    </tHead>
                    <tBody class="view_tBody">

                    </tBody>
                </table>
            </div> --}}
        </div>
    </div>
@endsection
