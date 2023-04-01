@extends('layouts.layout')
@section('title')
    Bank List
@endsection
@section('content')
    <div id="body-top">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
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
                </div>
            </div>
            <!--bank add Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-bank') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Bank Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter bank name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account number:</label>
                                    <input type="text" class="form-control" placeholder="Enter account number"
                                        name="account_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Branch:</label>
                                    <input type="text" class="form-control" placeholder="Enter branch" name="branch" required>
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
                                <input type="submit" value="Save" class="btn btn-success" style="box-shadow: none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--bank update/edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit & Update Bank Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/create-bank') }}" method="post">
                            @csrf
                            <input type="hidden" name="update_id" id="bank_id" value="">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Bank Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter bank name"
                                        name="name" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account number:</label>
                                    <input type="text" class="form-control" placeholder="Enter account number"
                                        name="account_number" id="account_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Branch:</label>
                                    <input type="text" class="form-control" placeholder="Enter branch" name="branch"
                                        id="branch" required>
                                </div>
                                <div class="mb-3">
                                    <label for="info" class="form-label">Information:</label>
                                    <input type="text" class="form-control" placeholder="Enter info" name="info"
                                        id="info">
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
                            <li class="text-dark">{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Add Bank
            </button>
            <div class="clr"></div>
            <div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Information</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Bank::get() as $bank)
                            <tr>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->account_number }}</td>
                                <td>{{ $bank->branch }}</td>
                                <td>{{ $bank->info }}</td>
                                <td>
                                    <button class="btn btn-success" id="view_bank"
                                        value="{{ $bank->id }}">View</button>
                                    <button class="btn btn-info" id="edit_bank"
                                        value="{{ $bank->id }}">edit</button>
                                    <button class="btn btn-danger" id="delete_bank"
                                        value="{{ $bank->id }}">delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
