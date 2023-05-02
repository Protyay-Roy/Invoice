@extends('layouts.layout')
@section('title')
    Supplier List
@endsection
@section('content')
    <div id="body-top">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="body-top-content">
                        <ul>
                            <li> <a href="#">All Supplier</a> </li>
                            <li> <a href="#">Active Supplier</a>  </li>
                            <li> <a href="#">Inactive Supplier</a> </li>
                            <li>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Add Supplier
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--supplier add Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Supplier Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-supplier') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" placeholder="Enter email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" placeholder="Enter address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" placeholder="Enter phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter company name"
                                        name="company_name" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="info" class="form-label">Information:</label>
                                    <input type="text" class="form-control" placeholder="Enter info" name="info">
                                </div> --}}
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
                                <input type="submit" value="Save" class="btn btn-success" style="box-shadow: none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--supplier update/edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit & Update Supplier Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-supplier') }}" method="post">
                            @csrf
                            <input type="hidden" name="update_id" id="supplier_id" value="">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                                        name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Enter address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Enter phone"
                                        name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name:</label>
                                    <input type="text" class="form-control" id="company_name"
                                        placeholder="Enter company name" name="company_name" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="info" class="form-label">Information:</label>
                                    <input type="text" class="form-control" id="info" placeholder="Enter info"
                                        name="info">
                                </div> --}}
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
                                <input type="submit" value="Update" class="btn btn-success" style="box-shadow: none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                            <li>{{ $error }}</li>
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
                            {{-- <th scope="col">Note</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Ledger::where('type', 2)->get() as $supplier)
                            <tr>
                                <td>
                                    <a href="{{ url('view-supplier/'.$supplier->id) }}">{{ $supplier->company_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ url('view-supplier/'.$supplier->id) }}">{{ $supplier->name }}</a>
                                </td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->phone }}</td>
                                {{-- <td>{{ $supplier->info }}</td> --}}
                                <td>
                                    <button class="btn btn-success" id="view_supplier"
                                        value="{{ $supplier->id }}" title="View Supplier"><i class="fa-regular fa-eye"></i></button>
                                    <button class="btn btn-info ml-1" id="edit_supplier"
                                        value="{{ $supplier->id }}" title="Edit Supplier"><i class="fa-solid fa-pencil"></i></button>
                                    <button class="btn btn-danger ml-1" id="delete_supplier"
                                        value="{{ $supplier->id }}" title="Delete Supplier"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
