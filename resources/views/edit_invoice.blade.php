@extends('layouts.layout')
@section('title')
    Edit Invoice
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
            <form action="{{ url('edit-invoice/' . $transections->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-3 offset-2 d-flex">
                        <label for="datepicker" class="pt-2 mr-2">Date:</label>

                        <input type="text" id="datepicker" name="entry_date" class="form-control"
                            value="{{ $transections->entry_date }}">
                    </div>
                    <div class="col-4" id="search_dropdown">

                        <select data-live-search="true" class="w-100" name="ledger_id">
                            {{-- <option data-tokens="" disabled selected>Select customer</option> --}}
                            @foreach (App\Models\Ledger::where('type', 1)->get() as $customer)
                                <option data-tokens="{{ $customer->id }}" value="{{ $customer->id }}"
                                    {{ !empty($transections->getCustomer->name) && $customer->name == $transections->getCustomer->name ? 'selected' : '' }}>
                                    {{ $customer->name }}</option>
                            @endforeach
                        </select>
                        {{-- {{$transections->getCustomer->name}} --}}

                    </div>
                </div>


                <hr class="mt-4">
                <div id="body-table">
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
                                <th scope="col">
                                    <button class="btn btn-primary" id="add_invoice" style="padding: 2px 8px">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            @foreach ($transections->getInvoiceItems as $item)
                                <tr id="TableRow">
                                    <td>
                                        <input type="text" class="form-control" name="item[]"
                                            value="{{ $item->item }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="size[]"
                                            value="{{ $item->size }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control width" name="width[]"
                                            value="{{ $item->width }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control height" name="height[]"
                                            value="{{ $item->height }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control square_ft" name="square_ft[]"
                                            value="{{ $item->square_ft }}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control qty" name="qty[]"
                                            value="{{ $item->qty }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total_square_ft" name="total_square_ft[]"
                                            value="{{ $item->total_square_ft }}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control rate" name="rate[]"
                                            value="{{ $item->rate }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control price" name="price[]"
                                            value="{{ $item->price }}" readonly>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger mt-2" id="remove_invoice_row"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="row mt-5">
                    <div class="col-8"></div>
                    <div class="col-3 pb-5">
                        <div class="sub_total d-flex">
                            <span>SubTotal:</span>
                            <input class="form-control" type="text" id="subtotal" name="subtotal" placeholder="SubTotal"
                                value="{{ $transections->debit }}">
                        </div>
                        <div class="sub_total d-flex mt-4">
                            <span style="margin-right: 38px;">Credit:</span>
                            <input class="form-control" type="text" id="credit" name="credit" placeholder="Credit"
                                value="{{ $transections->credit }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-4">
                        <div class="mb-2">
                            <label for="note" class="form-label">Note:</label>
                            <input type="text" class="form-control" placeholder="Enter note" name="note"
                                value="{{ $transections->note }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank:</label>
                            <select name="bank_name" id="bank" class="form-control">
                                <option selected disabled>Select Bank</option>
                                @foreach (App\Models\Bank::get() as $bank)
                                    <option value="{{ $bank->name }}"
                                        {{ !empty($transections->bank_name) && $transections->bank_name == $bank->name ? 'selected' : '' }}>
                                        {{ $bank->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="float-right mb-5 btn btn-success">Save</button>
                    </div>
                </div> --}}

                <div class="row mt-5">
                    <div class="col-8"></div>
                    <div class="col-3 pb-5">
                        <div class="sub_total d-flex">
                            <span>SubTotal:</span>
                            <input class="form-control" type="text" id="subtotal" name="subtotal"
                                placeholder="SubTotal" value="{{ $transections->debit }}">
                        </div>
                        <div class="sub_total d-flex mt-4">
                            <span style="margin-right: 38px;">Paid:</span>
                            <input class="form-control" type="text" id="credit" name="credit" placeholder="Paid" value="{{ $transections->credit }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-2">
                        <div class="mb-2">
                            <label for="note" class="form-label">Cheque:</label>
                            <input type="text" class="form-control" placeholder="Enter Cheque" name="cheque" value="{{ $transections->note }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-6">
                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank:</label>
                            <select name="bank_name" id="bank" class="form-control">
                                <option selected disabled>Select Bank</option>
                                @foreach (App\Models\Bank::get() as $bank)
                                    <option value="{{ $bank->name }}"
                                        {{ !empty($transections->bank_name) && $transections->bank_name == $bank->name ? 'selected' : '' }}>
                                        {{ $bank->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="float-right mb-5 mr-1 btn btn-success">Save</button>
                <div class="clr"></div>
            </form>
        </div>
    </div>
@endsection
