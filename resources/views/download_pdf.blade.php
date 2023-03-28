<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style>table th{font-size: 13px !important;font-weight: 600 !important;}table td {padding: 3px 3px 3px 10px !important;font-size: 13px !important;}.customer_info td{margin-left: 15px}</style>
</head>

<body>
    <div class="row">
        <div class="container">
            <div class="modal-content mb-3">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Invoice</h4>
                </div>
                <div class="modal-body">
                    <p class="pl-1 pt-3">Date: {{ date('d-m-y') }}</p>
                    <hr>
                    <div>
                        <h6>Invoice to:</h6>
                        <table class="ml-2 customer_info">
                            <tr>
                                <th>Company Name:</th>
                                <td>{{ $transections->getCustomer->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td>{{ $transections->getCustomer->name }}</td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>{{ $transections->getCustomer->type == 1 ? 'Customer' : 'Supplier' }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $transections->getCustomer->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone no.:</th>
                                <td>{{ $transections->getCustomer->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $transections->getCustomer->address }}</td>
                            </tr>
                            <tr>
                                <th>Information:</th>
                                <td>{{ $transections->getCustomer->info }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div>
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
                        @foreach ($transections->getInvoiceItems as $invoice_items)
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
                    </tBody>
                </table>

                <p class="mb-5 mr-1 float-right">Paid: {{ $transections->credit == null ? 0 : $transections->credit }}
                </p>
                <div class="clr"></div>
                {{-- <p>Note: <span>Somthing....</span></p> --}}
            </div>

        </div>
    </div>
</body>

</html>
