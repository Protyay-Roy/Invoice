@extends('layouts.layout')
@section('title')
    Customer List
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


            <!--customer add Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-customer') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" placeholder="Enter address" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="number" class="form-control" placeholder="Enter phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter company name"
                                        name="company_name">
                                </div>
                                <div class="mb-3">
                                    <label for="info" class="form-label">Information:</label>
                                    <input type="text" class="form-control" placeholder="Enter info" name="info">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="debit" class="form-label">Debit:</label>
                                            <input type="text" class="form-control" placeholder="Enter debit"
                                                name="debit">
                                        </div>
                                        <div class="col-6">
                                            <label for="credit" class="form-label">Credit:</label>
                                            <input type="text" class="form-control" placeholder="Enter credit"
                                                name="credit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-success">Save</button> --}}
                                <input type="submit" value="Save" class="btn btn-success" style="box-shadow: none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!--customer update/edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit & Update Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-customer') }}" method="post">
                            @csrf
                            <input type="hidden" name="update_id" id="customer_id" value="">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                                        name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Enter address" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="number" class="form-control" id="phone" placeholder="Enter phone"
                                        name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" id="company_name"
                                        placeholder="Enter company name" name="company_name">
                                </div>
                                <div class="mb-3">
                                    <label for="info" class="form-label">Information:</label>
                                    <input type="text" class="form-control" id="info" placeholder="Enter info"
                                        name="info">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="debit" class="form-label">Debit:</label>
                                            <input type="text" class="form-control" id="debit"
                                                placeholder="Enter debit" name="debit">
                                        </div>
                                        <div class="col-6">
                                            <label for="credit" class="form-label">Credit:</label>
                                            <input type="text" class="form-control" id="credit"
                                                placeholder="Enter credit" name="credit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-success">Save</button> --}}
                                <input type="submit" value="Update" class="btn btn-success" style="box-shadow: none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- customer view Modal -->
            {{-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div>
                            <button class="btn btn-success float-right mt-2 mb-4 mr-3">Download pdf</button>
                            <table class="table mb-5">
                                <tr>
                                    <th>Name:</th>
                                    <td id="view_name"></td>
                                    <th>Company name:</th>
                                    <td id="view_company_name">></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td id="view_email">></td>
                                    <th>Phone no.:</th>
                                    <td id="view_phone">></td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td id="view_address">></td>
                                    <th>Note:</th>
                                    <td id="view_info">></td>
                                </tr>
                                <tr>
                                    <th>Debit:</th>
                                    <td id="view_debit">></td>
                                    <th>Credit:</th>
                                    <td id="view_credit">></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content px-4">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Customer Information</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div id="invoice_view" class="mt-1">
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
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div id="main-body">
        <div class="container body_content" style="margin-top: -25px;">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-dark">{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Company</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Ledger::where('type', 1)->get() as $customer)
                            <tr>
                                <td>{{ $customer->company_name }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->info }}</td>
                                <td>
                                    {{-- <a href="#" class="btn btn-primary">view</a> --}}
                                    <button class="btn btn-info" id="view_customer"
                                        value="{{ $customer->id }}">View</button>
                                    <button class="btn btn-warning" id="edit_customer"
                                        value="{{ $customer->id }}">edit</button>
                                    <button class="btn btn-danger" id="delete_customer"
                                        value="{{ $customer->id }}">delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
