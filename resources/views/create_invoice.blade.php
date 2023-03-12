@extends('layouts.layout')
@section('title')
    Create Invoice
@endsection
@section('content')
    <div id="main-body">
        <div class="container body_content">
            <div class="row">
                <div class="col-2 offset-2">
                    <input type="date" class="form-control">
                </div>
                <div class="col-4" id="search_dropdown">

                    <select data-live-search="true" class="w-100">
                        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                        <option data-tokens="mustard">Burger, Shake and a Smile</option>
                        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                    </select>


                </div>
                <div class="col-2">
                    <div>
                        <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                        <a class="btn btn-outline-success" href="customer.html">Add Customer</a>
                    </div>
                </div>
            </div>


            <hr class="mt-4">
            <div id="body-table">
                <table class="table table-bordered table-striped">
                    <thead class="table_head">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Size</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Width</th>
                            <th scope="col">Height</th>
                            <th scope="col">Square ft</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="attr_field">
                        <tr id="TableRow">
                            <td>
                                <input type="text" class="form-control" name="item[]" placeholder="Item">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="size[]" placeholder="Size">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="unit[]" placeholder="Unit">
                            </td>
                            <td>
                                <input type="text" class="form-control width" name="width[]" placeholder="Width">
                            </td>
                            <td>
                                <input type="text" class="form-control height" name="height[]" placeholder="Height">
                            </td>
                            <td>
                                <input type="text" class="form-control square_ft" name="square_ft[]"
                                    placeholder="Square ft" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control rate" name="rate[]" placeholder="Rate">
                            </td>
                            <td>
                                <input type="text" class="form-control price" name="price[]" placeholder="Price"
                                    readonly>
                            </td>
                            <td>
                                <button class="btn btn-primary mt-1" id="add_attribute">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-5">
                <div class="col-8"></div>
                <div class="col-3 pb-5">
                    <div class="sub_total d-flex">
                        <span>SubTotal:</span>
                        <input class="form-control" type="text" id="subtotal" name="subtotal" placeholder="SubTotal">
                    </div>
                    <div class="sub_total d-flex mt-4">
                        <span style="margin-right: 38px;">Credit:</span>
                        <input class="form-control" type="text" id="credit" name="credit" placeholder="Credit">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
