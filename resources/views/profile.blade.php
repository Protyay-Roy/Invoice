@php
    $active = 'profile';
    $user = auth()->user();
@endphp
@extends('layouts.layout')
@section('title')
    Profile
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
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h4 class="text-center">Profile</h4>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ route('update-profile') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" id="name" class="form-control" placeholder="Enter name" name="name"
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" class="form-control" placeholder="Enter Email" name="email"
                                        value="{{ $user->email }}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Current Password:</label>
                                    <input type="text" id="old_password" class="form-control" placeholder="Enter Current Password" name="old_password" required>
                                    @error('old_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password:</label>
                                    <input type="text" id="new_password" class="form-control" placeholder="Enter New Password" name="new_password" required>
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                                    <input type="text" id="confirm_password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password" required>
                                    @error('confirm_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button class="btn btn-success w-100 mb-5">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
