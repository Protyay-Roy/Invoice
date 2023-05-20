{{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit & Update Supplier Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/create-supplier') }}" method="post">
@csrf
<input type="hidden" name="update_id" id="supplier_id" value="">
<div class="modal-body">
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone:</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="company_name" class="form-label">Company Name:</label>
        <input type="text" class="form-control" id="company_name" placeholder="Enter company name" name="company_name" required>
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="debit" class="form-label">Debit:</label>
                <input type="text" class="form-control" id="debit" placeholder="Enter debit" name="debit">
            </div>
            <div class="col-6">
                <label for="credit" class="form-label">Credit:</label>
                <input type="text" class="form-control" id="credit" placeholder="Enter credit" name="credit">
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <input type="submit" value="Update" class="btn btn-success" style="box-shadow: none">
</div>
</form>
</div>
</div>
</div> --}}

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
            <td>{{ number_format($total_balance, 2, '.', ',') }}</td>
            <td>
                {{$transection->calan}}
            </td>
            <td>-</td>

            <td>
                <button class="btn btn-success" id="view_invoice" value="{{ $transection->id }}" title="View"><i
                        class="fa-regular fa-eye"></i></button>
                <a href="{{ url('edit-invoice/' . $transection->id) }}" class="btn btn-info ml-1" title="Edit"><i
                        class="fa-solid fa-pencil"></i></a>
                <button value="{{ $transection->id }}" id="delete_invoice" class="btn btn-danger ml-1" title="Delete"><i
                        class="fa-solid fa-trash"></i></button>
            </td>

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
        <td>{{ number_format($total_balance, 2, '.', ',') }}</td>
        <td>-</td>

        <td>{{ $transection->bank_name }}</td>



        @if ($transection->type == 'INVOICE' && $status == 'view')
            <td>
                <button class="btn btn-success" id="view_invoice" value="{{ $transection->id }}" title="View"><i
                        class="fa-regular fa-eye"></i></button>
                <a href="{{ url('edit-invoice/' . $transection->id) }}" class="btn btn-info ml-1" title="Edit"><i
                        class="fa-solid fa-pencil"></i></a>
                <button value="{{ $transection->id }}" id="delete_invoice" class="btn btn-danger ml-1"
                    title="Delete"><i class="fa-solid fa-trash"></i></button>
            </td>
        @elseif ($transection->type == 'PAYMENT' && $status == 'view')
            <td>
                <button class="btn btn-success" id="view_invoice" value="{{ $transection->id }}" title="View"
                    disabled><i class="fa-regular fa-eye"></i></button>
                <a href="{{ url('edit-daily_entry/' . $transection->id) }}" class="btn btn-info ml-1" title="Edit"><i
                        class="fa-solid fa-pencil"></i></a>
                <button value="{{ $transection->id }}" id="delete_entry" class="btn btn-danger ml-1" title="Delete"><i
                        class="fa-solid fa-trash"></i></button>
            </td>
        @elseif ($transection->type == 'OPENING BALANCE' && $status == 'view')
            <td>
                <button class="btn btn-success" id="view_invoice" value="{{ $transection->id }}" title="View"
                    disabled><i class="fa-regular fa-eye"></i></button>

                <button class="btn btn-info ml-1" id="edit_supplier" value="{{ $transection->ledger_id }}"
                    title="Edit Supplier" disabled><i class="fa-solid fa-pencil"></i></button>

                <button value="{{ $transection->id }}" id="delete_entry" class="btn btn-danger ml-1" title="Delete"
                    disabled><i class="fa-solid fa-trash"></i></button>
            </td>
        @endif
    </tr>
@endforeach
