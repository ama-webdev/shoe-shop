@extends('admin.master.master')
@section('title')
    Change Password
@endsection
@section('setting-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Change Password</h3>
        </div>
        <div class="right">
            {{-- <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>     --}}
        </div>
    </div>
@endsection
@section('content')
    <form action="{{route('admin.settings.update-password')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="old_password">Old Password</label>
            <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror @error('incorrect') is-invalid @enderror">
            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('incorrect')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
             @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
            @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Change</button>
        </div>
    </form>
@endsection
