@extends('layouts.layout')
@section('title')
    Edit Daily Entry
@endsection
@section('content')
    <div id="main-body">
        <div class="container body_content">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('edit-entry', $transection->id) }}" method="post">
                @csrf
                <div id="body-table">
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
                    <table class="table table-bordered table-striped">
                        <thead class="table_head">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Note</th>
                                <th scope="col">Bank</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <tr id="TableRow">
                                <td>
                                    <input type="text" class="form-control" name="date[]" id="datepicker"
                                        value="{{ $transection->entry_date }}" required>
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </td>
                                <td>
                                    <select name="type[]" class="form-control entry_type" required>
                                        <option selected disabled value="">Select payment type</option>
                                        <option value="customer">Customer Payment</option>
                                        <option value="supplier">Supplier Payment</option>
                                        <option value="bank">Bank Payment</option>
                                    </select>
                                    @error('entry_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select name="profile[]" class="form-control profile" required>
                                        <option selected disabled value=""> Select Profile</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="debit[]" placeholder="Debit"
                                        value="{{ $transection->debit }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="credit[]" placeholder="Credit"
                                        value="{{ $transection->credit }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="note[]" placeholder="Note"
                                        value="{{ $transection->note == 'N/A' ? '' : $transection->note }}">
                                </td>
                                <td>
                                    <select name="bank_name[]" id="bank_name" class="form-control">
                                        <option selected disabled>Select your bank</option>
                                        @foreach (App\Models\Bank::get() as $bank)
                                            <option
                                                {{ !empty($transection->bank_name) && $transection->bank_name == $bank->name ? 'selected' : '' }}
                                                value="{{ $bank->name }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success float-right mb-5">Save</button>
                <div class="clr"></div>
            </form>
        </div>
    </div>
@endsection
