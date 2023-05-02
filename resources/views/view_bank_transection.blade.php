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
        <td>{{ $transection->note }}</td>
    </tr>
@endforeach
