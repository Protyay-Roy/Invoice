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

                <div>
                    {{-- <button class="btn btn-success float-right mt-2 mb-4 mr-3">Download pdf</button> --}}

                    <p class="pl-1 pt-2">Date: <span class="view_date"></span></p>

                    <hr>
                    <div>
                        <p>Invoice to:</p>
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
                    {{-- <table class="table mb-5">
                        <tr>
                            <th>Name:</th>
                            <td id="view_name"></td>
                            <th>Company name:</th>
                            <td id="view_company_name"></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td id="view_email"></td>
                            <th>Phone no.:</th>
                            <td id="view_phone"></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td id="view_address"></td>
                            <th>Note:</th>
                            <td id="view_info"></td>
                        </tr>
                        <tr>
                            <th>Debit:</th>
                            <td id="view_debit"></td>
                            <th>Credit:</th>
                            <td id="view_credit"></td>
                        </tr>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content">
            <div class="row">
                <div class="col-12">
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
