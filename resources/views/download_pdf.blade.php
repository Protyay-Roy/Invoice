<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="modal-content px-4">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Invoice</h4>
        </div>

        <div id="invoice_view">
            <p class="pl-1 pt-3">Date: <span class="view_date"></span></p>
            <hr>
            <div>
                <h6>Invoice to:</h6>
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
            <table class="table table-bordered mb-5">
                <tHead>
                    <tr>
                        <th scope="col">Entry date</th>
                        <th scope="col">Item</th>
                        <th scope="col">Size</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Width</th>
                        <th scope="col">Height</th>
                        <th scope="col">Square ft</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Amount</th>
                    </tr>
                </tHead>
                <tBody class="view_tBody">
                    @foreach ($transections as $transection)
                        @foreach ($transection->getInvoiceItems as $invoice_items)
                            <tr>
                                <td>{{ $invoice_items->entry_date }}</td>
                                <td>{{ $invoice_items->item }}</td>
                                <td>{{ $invoice_items->size }}</td>
                                <td>{{ $invoice_items->unit }}</td>
                                <td>{{ $invoice_items->width }}</td>
                                <td>{{ $invoice_items->height }}</td>
                                <td>{{ $invoice_items->square_ft }}</td>
                                <td>{{ $invoice_items->rate }}</td>
                                <td>{{ $invoice_items->price }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tBody>
            </table>

            <p class="mb-5 mr-1 float-right">Total: {{ $transection->credit }}</p>
            <div class="clr"></div>
            <p>Note: <span>Somthing....</span></p>
        </div>
    </div>
</body>

</html>
