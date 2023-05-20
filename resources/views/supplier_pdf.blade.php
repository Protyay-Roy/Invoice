@php
    $balance_transections = App\Models\Transection::where('ledger_id', $id)->get();

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $ledgers->name }}</title>
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
        .table_head{
            background: #1e2896;
            color: #ffffff
        }
    </style>
</head>

{{-- <body>
    <table>
        <tr>
            <th>Name:</th>
            <td>{{ $ledgers->name }}</td>
        </tr>
        <tr>
            <th>Phone no.:</th>
            <td>{{ $ledgers->phone }}</td>
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
                <th scope="col">Bank Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transections as $transection)
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
                    <td>{{ $transection->note == 'N/A' ? 'Empty' : $transection->note }}</td>
                    <td>{{ $transection->bank_name == null ? 'Empty' : $transection->bank_name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body> --}}

<body style="width: 100%; padding:0px; margin:0px">

    <p style="font-weight: 800; font-size: 22px; margin-bottom: 0px">M/S R.K. TRADING</p>
    <p style="font-weight: 700; font-size: 15px; margin-bottom: 0px">IMPORTER, EXPORTER & GENERAL MERCHANT</p>
    <p style="font-weight: 500; font-size: 16px; margin-bottom: 0px">DHARANDA, DINAJPUR ROAD, BANGL HILI, HAKIMPUR, DINAJPUR, BANGLADESH.</p>
    <p style="font-weight: 400; font-size: 15px; margin-bottom: 0px">Phone: 01711-413307 - 01711286437</p>
    <p style="font-weight: 400; font-size: 15px; margin-bottom: 0px">Email: <a href="rktrading65@yahoo.com" style="text-decoration: none; color: #444444">rktrading65@yahoo.com</a></p>

    <br>
    <p style="font-weight: 400; font-size: 14px; margin-bottom: 5px">M/S H R ROSHID</p>
    <p style="font-weight: 400; font-size: 14px; margin-bottom: 5px">
        Party's report: {{ $type }}
        @if ($from != null)

        <span class="ml-3">Form: ( {{$from}} ) &nbsp;&nbsp; To: ( {{$to}} )</span>

        @endif
    </p>
    <p style="font-weight: 400; font-size: 14px; margin-bottom: 5px">Party's Report Created: <?= date('l jS \of F Y h:i:s A'); ?></p>
    <table class="table table-bordered mb-5">
        <thead class="table_head">
            <tr>
                <th scope="col">Entry date</th>
                <th scope="col">Information</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">Calan</th>
                <th scope="col">Bank/Cheque</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transections as $transection)
                @php
                    $invoic_items = DB::table('invoice_items')
                        ->where('transection_id', $transection->id)
                        ->get();
                @endphp



                @foreach ($invoic_items as $items)
                    @php
                        $total_balance += $items->price;
                    @endphp
                    <tr>

                        <td>{{ $transection->entry_date }}</td>
                        <td>

                            <b>{{ $items->item }} </b>
                            <b>{{ $items->size }}</b>
                            (W)
                            : <b>{{ $items->width }}</b>
                            (H): <b>{{ $items->height }}</b>
                            (SQft): <b>{{ $items->square_ft }}</b>
                            <br>

                            (PCS): <b>{{ $items->qty }}</b>
                            (Total SQft): <b>{{ $items->total_square_ft }}</b>
                            (Rate): <b>{{ $items->rate }}</b>


                        </td>

                        <td>{{ number_format($items->price, 2, '.', ',') }}</td>
                        <td>0</td>
                        <td>{{ $transection->calan }}</td>
                        <td>-</td>
                    </tr>
                @endforeach

                @php

                    $total_balance -= $transection->credit;

                @endphp



                <tr>

                    <td>{{ $transection->entry_date }}</td>
                    <td>PAYMENT</td>
                    <td> 0 </td>
                    <td><?= number_format($transection->credit, 2, '.', ',') ?></td>
                    <td>-</td>

                    <td>{{ $transection->bank_name }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><span class="float-right font-weight-bold">Total:</span></td>
                <td class=" font-weight-bold">{{ $debit }}</td>
                <td class=" font-weight-bold">{{ $credit }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-center">Balance: {{ $balance }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
