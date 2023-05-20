@php
    $active = 'daily_entry';
@endphp
@extends('layouts.layout')
@section('title')
    Create Daily Entry
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
            @if (Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('add-edit-daily_entry') }}" method="post" id="entry_form">
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
                        <thead class="table_head" style="text-transform: uppercase">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Debit</th>
                                <th scope="col">Credit</th>
                                <th scope="col">Cheque</th>
                                <th scope="col">Bank</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <tr id="TableRow">
                                <td>
                                    <input type="text" value="{{ date('Y-m-d') }}" id="datepicker"
                                        class="form-control datepicker" name="date[]" required>
                                </td>
                                <td>
                                    <select name="type[]" class="form-control entry_type" required>
                                        <option selected disabled value="">Select payment type</option>
                                        <option value="customer">Customer Payment</option>
                                        <option value="supplier">Supplier Payment</option>
                                        <option value="bank">Bank Payment</option>
                                    </select>
                                </td>
                                <div id="ajax_profile">
                                    <td>
                                        <select name="profile[]" class="form-control profile" required>
                                            <option selected disabled value="">Select profile</option>
                                        </select>
                                    </td>
                                </div>

                                <td>
                                    <input type="text" class="form-control" name="debit[]" placeholder="Debit">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="credit[]" placeholder="Credit">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="note[]" placeholder="Cheque">
                                </td>

                                {{-- <td id="search_dropdown">
                                    <select name="bank_name[]" id="bank_name" data-live-search="true" class="w-auto">
                                        <option data-tokens="" disabled selected value="">Select Bank</option>
                                        @foreach (App\Models\Bank::get() as $bank)
                                            <option value="{{ $bank->name }}"> {{ $bank->name }} </option>
                                        @endforeach
                                    </select>
                                </td> --}}

                                <td>
                                    <input type="text" class="form-control" name="bank_name[]" placeholder="Bank">
                                </td>

                                    {{-- <td class="bank_td">
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank">
                                        <div id="search_bank_name">
                                        </div>
                                    </td> --}}
                                <td>
                                    <button class="btn btn-primary mt-1" id="add_entry">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success float-right mb-5" id="save">Save</button>
                <div class="clr"></div>
            </form>
        </div>
    </div>
@endsection
