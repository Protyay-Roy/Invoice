@extends('layouts.layout')
@section('title')
    Create Invoice
@endsection
@section('content')
    <div id="main-body">
        <div class="container body_content">
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
            <form action="{{ route('create-invoice') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-3 offset-2 d-flex">
                        <label for="datepicker" class="pt-2 mr-2">Date:</label>

                        <input type="text" id="datepicker" name="entry_date" class="form-control datepicker"
                            value="{{ date('d-m-Y') }}">
                    </div>
                    <div class="col-4" id="search_dropdown">
                        <select data-live-search="true" class="w-100" name="ledger_id" required>
                            <option data-tokens="" disabled selected value="">Select customer</option>
                            @foreach (App\Models\Ledger::where('type', 1)->get() as $customer)
                                <option data-tokens="{{ $customer->id }}" value="{{ $customer->id }}">
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="row">
                    <div class="col-12">
                        <div id="body-table responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table_head">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Width</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Square ft</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Square ft</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <tr id="TableRow">
                                        <td>
                                            <input type="text" class="form-control" name="item[]" placeholder="Item" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="size[]" placeholder="Size" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control width" name="width[]"
                                                placeholder="Width" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control height" name="height[]"
                                                placeholder="Height" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control square_ft" name="square_ft[]"
                                                placeholder="Square ft" readonly required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control qty" name="qty[]"
                                                placeholder="Quantity" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total_square_ft"
                                                name="total_square_ft[]" placeholder="Total Square ft" readonly required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control rate" name="rate[]"
                                                placeholder="Rate" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control price" name="price[]"
                                                placeholder="Price" readonly required>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary mt-1" id="add_invoice">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="row mt-5">
                    <div class="col-8"></div>
                    <div class="col-3 pb-5">
                        <div class="sub_total d-flex">
                            <span>SubTotal:</span>
                            <input class="form-control" type="text" id="subtotal" name="subtotal"
                                placeholder="SubTotal" readonly>
                        </div>
                        <div class="sub_total d-flex mt-4">
                            <span style="margin-right: 38px;">Paid:</span>
                            <input class="form-control" type="text" id="credit" name="credit" placeholder="Paid">
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="row">
                    <div class="col-4 offset-6">
                        <div class="mb-2">
                            <label for="note" class="form-label">Cheque:</label>
                            <input type="text" class="form-control" placeholder="Enter Cheque" name="cheque">
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="row">
                    <div class="col-4 offset-6">
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank:</label>
                            <select name="bank_name" id="bank_name" class="form-control">
                                <option selected disabled>Select Bank</option>
                                @foreach (App\Models\Bank::get() as $bank)
                                    <option value="{{ $bank->name }}"> {{ $bank->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}
                {{-- <button class="float-right mb-5 mr-1 btn btn-success">Save</button>
                <div class="clr"></div> --}}
                <table class="float-right fix-invoice-table">
                    <tr>
                        <th>SubTotal: </th>
                        <td>
                            <input class="form-control" type="text" id="subtotal" name="subtotal"
                                placeholder="SubTotal" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Paid: </th>
                        <td>
                            <input class="form-control" type="text" id="credit" name="credit" placeholder="Paid">
                        </td>
                    </tr>
                    <tr>
                        <th>Cheque: </th>
                        <td>
                            <input type="text" class="form-control" placeholder="Enter Cheque" name="cheque">
                        </td>
                    </tr>
                    <tr>
                        <th>Bank: </th>
                        <td>
                            <select name="bank_name" id="bank_name" class="form-control">
                                <option selected disabled>Select Bank</option>
                                @foreach (App\Models\Bank::get() as $bank)
                                    <option value="{{ $bank->name }}"> {{ $bank->name }} </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="clr"></div>
                <button class="float-right mb-5 mr-1 btn btn-success">Save</button>
                <div class="clr"></div>
            </form>
        </div>
    </div>

@endsection
