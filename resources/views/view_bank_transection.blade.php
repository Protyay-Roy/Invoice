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
        <td>{{ $transection->debit }}</td>
        <td>{{ $transection->credit }}</td>
        <td>{{ $total_balance }}</td>
        <td>{{ $transection->note == 'N/A' ? 'Empty' : $bank_transection->note }}</td>
        <td></td>
    </tr>
@endforeach
