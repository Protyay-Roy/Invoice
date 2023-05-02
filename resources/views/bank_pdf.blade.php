@php
    $balance_transections = App\Models\Bank_transection::where('bank_id', $id)->get();

    $debit = 0;
    $credit = 0;
    $balance = 0;
    foreach ($balance_transections as $transection) {
        $debit += $transection->debit;
        $credit += $transection->credit;
        $balance = $debit - $credit;
    }
    $balance = number_format($balance, 2, '.', ',');
    $debit = number_format($debit, 2, '.', ',');
    $credit = number_format($credit, 2, '.', ',');
@endphp

<!DOCTYPE html>
<html lang="en">

{{-- <body>
    <div class="row">
        <div class="container">

            <div class="col-12">
                <h5 id="header_heading" class="text-center">Bank Information</h4>
            </div>
            <div class="col-12">
                <table>
                    <tr>
                        <th>Bank Name:</th>
                        <td>{{ $bank->name }}</td>
                    </tr>
                    <tr>
                        <th>Account No:</th>
                        <td>{{ $bank->account_number }}</td>
                    </tr>
                    <tr>
                        <th>Brance:</th>
                        <td>{{ $bank->branch }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-12">
                <table class="table float-right" style="width: 50%; margin-left:400px; margin-top:-70px">
                    <thead class="table-dark">
                        <tr>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">bank_transections
                        <tr>
                            <td> {{ $debit }} </td>
                            <td>{{ $credit }}</td>
                            <td>{{ $balance }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="clr"></div>
            </div>
            <div class="col-12 mt-3">
                <table class="table table-bordered mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Entry date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bank_transections as $transection)
                            @php
                                if (!empty($transection->debit) || $transection->debit != 0) {
                                    $total_balance += $transection->debit;
                                }
                                if (!empty($transection->credit) || $transection->credit != 0) {
                                    $total_balance -= $transection->credit;
                                }
                            @endphp
                            <tr>
                                <td>{{ $transection->entry_date }}</td>
                                <td>{{ $transection->type }}</td>
                                <td>{{ $transection->debit }}</td>
                                <td>{{ $transection->credit }}</td>
                                <td>{{ $total_balance }}</td>
                                <td>{{ $transection->note == 'N/A' ? 'Empty' : $bank_transection->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body> --}}


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $bank->name }}</title>
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

        .customer_info td {
            margin-left: 15px
        }

        .clr {
            clear: both;
        }

        .table {
            margin-bottom: 8px !important
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Bank Name:</th>
            <td>{{ $bank->name }}</td>
        </tr>
        <tr>
            <th>Account No:</th>
            <td>{{ $bank->account_number }}</td>
        </tr>
        <tr>
            <th>Brance:</th>
            <td>{{ $bank->branch }}</td>
        </tr>
    </table>
    <table class="table float-right" style="width: 50%; margin-top:-40px">
        <thead class="table-dark">
            <tr>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody class="bg-light">
            <tr>
                <td> {{ $debit }} </td>
                <td>{{ $credit }}</td>
                <td>{{ $balance }}</td>
            </tr>
        </tbody>
    </table>
    <div class="clr"></div>
    <table class="table table-bordered mb-5">
        <thead class="bg-success">
            <tr>
                <th scope="col">Entry date</th>
                <th scope="col">Type</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">Balance</th>
                <th scope="col">Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bank_transections as $transection)
                @php
                    if (!empty($transection->debit) || $transection->debit != 0) {
                        $total_balance += $transection->debit;
                    }
                    if (!empty($transection->credit) || $transection->credit != 0) {
                        $total_balance -= $transection->credit;
                    }
                @endphp
                <tr>
                    <td>{{ $transection->entry_date }}</td>
                    <td>{{ $transection->type }}</td>
                    <td><?= number_format($transection->debit, 2, '.', ',') ?></td>
                    <td><?= number_format($transection->credit, 2, '.', ',') ?></td>
                    <td>{{ number_format($total_balance, 2, '.', ',') }}</td>
                    <td>{{ $transection->note == 'N/A' ? 'Empty' : $bank_transection->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
