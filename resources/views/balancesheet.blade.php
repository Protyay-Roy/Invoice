<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        table th {
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        table td {
            padding: 0px 5px !important;
            font-size: 11px !important;
        }

        table thead tr th {
            padding: 0 5px 2px !important
        }

        .table_head {
            background: #1e2896;
            color: #ffffff
        }
    </style>
</head>

<body>
    <div class="row d-flex">
        <div class="col-6">
            logo
        </div>
        <div class="col-6 float-right">
            <p class="pl-1 float-right">Date: <small>{{ date('d-m-y') }}</small></p>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>

    <div class="clr"></div>
    {{-- <div class="col-12">
        <table class="ml-2 customer_info">
            <tr>
                <th>Name:</th>
                <td>{{ $transections->getCustomer->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $transections->getCustomer->email }}</td>
            </tr>
            <tr>
                <th>Phone no.:</th>
                <td>{{ $transections->getCustomer->phone }}</td>
            </tr>
            </tr>
        </table>
    </div> --}}
    <table class="table table-bordered mb-3">
        <thead class="table_head">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone No.</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">Balance</th>
            </tr>
        </thead>
        <tbody class="view_tBody">
            @foreach ($customers as $customer)
                @php

                    $debit = 0;
                    $credit = 0;
                    $balance = 0;
                    foreach ($customer->getTransectionId as $transection) {
                        $debit += $transection->debit;
                        $credit += $transection->credit;
                    }
                    $balance = ($debit - $credit);

                    $balance = number_format($balance, 2, '.', ',');
                    $debit = number_format($debit, 2, '.', ',');
                    $credit = number_format($credit, 2, '.', ',');
                @endphp
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $debit }}</td>
                    <td>{{ $credit }}</td>
                    <td>{{ $balance }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </p>
    <div class="clr"></div>
</body>

</html>
