@php
    $active = 'daily_entry';
@endphp
@extends('layouts.layout')
@section('title')
    Daily Entry List
@endsection
@section('content')
    <div id="main-body">
        <div class="container body_content">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h4 class="text-center">Transition details</h4>
                    <div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Bank/Cash</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Transection::where('type', 'PAYMENT')->orderBy('transections.entry_date', 'DESC')->get() as $entry)
                                    <tr>
                                        <td>{{ $entry->entry_date }}</td>
                                        <td>
                                            <?php
                                                $customer = App\Models\Ledger::where('id', $entry->ledger_id)->first();
                                                echo $customer->name
                                            ?>
                                            {{-- {{ $customer->name }} --}}
                                        </td>
                                        <td>{{ $entry->bank_name }}</td>
                                        <td><?= number_format($entry->debit, 2, '.', ',') ?></td>
                                        <td><?= number_format($entry->credit, 2, '.', ',') ?></td>
                                        {{-- <td>{{ $entry->debit }}</td>
                                        <td>{{ $entry->credit }}</td> --}}
                                        <td>
                                            <a href="{{ route('edit-entry', $entry->id) }}" class="btn btn-primary" title="Edit Entry"><i class="fa-solid fa-pencil"></i></a>
                                            <button value="{{ $entry->id }}" id="delete_entry"
                                                class="btn btn-danger ml-1" title="Delete Entry"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
