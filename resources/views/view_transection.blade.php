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
        <td>{{ $transection->debit }}</td>
        <td>{{ $transection->credit }}</td>
        <td>{{ $total_balance }}</td>
        <td>{{ $transection->note == 'N/A' ? 'Empty' : $transection->note }}</td>
        <td>{{ $transection->bank_name == null ? 'Empty' : $transection->bank_name }}</td>
        @if ($transection->type == 'INVOICE' && $status == 'view')
            <td>
                <button class="btn btn-success" id="view_invoice" value="{{ $transection->id }}" title="View"><i class="fa-regular fa-eye"></i></button>
                <a href="{{ url('edit-invoice/' . $transection->id) }}" class="btn btn-info ml-1" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                <button value="{{ $transection->id }}" id="delete_invoice" class="btn btn-danger ml-1" title="Delete"><i class="fa-solid fa-trash"></i></button>
            </td>
        @endif
    </tr>
@endforeach
