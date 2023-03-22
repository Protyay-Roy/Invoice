@extends('layouts.layout')
@section('title')
    Daily Entry List
@endsection
@section('content')
    <div id="main-body">
        <div class="container body_content">
            <div class="row">
                <div class="col-12">
                    <h2>Transition details</h2>
                    <div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>name</th>
                                    <th>BANK/CASH</th>
                                    <th>DEBIT</th>
                                    <th>CREDIT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Transection::where('type','PAYMENT')->get() as $entry)
                                    <tr>
                                        <td>{{ $entry->entry_date }}</td>
                                        <td>{{ $entry->getCustomer->name }}</td>
                                        <td>{{ $entry->bank_name }}</td>
                                        <td>{{ $entry->debit }}</td>
                                        <td>{{ $entry->credit }}</td>
                                        <td>
                                            <a href="{{ route('edit-entry', $entry->id) }}" class="btn btn-primary">Edit</a>
                                            <button value="{{ $entry->id }}" id="delete_entry" class="btn btn-danger">Delete</button>
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
