@extends('master.master')
@section('title')
    Users
@endsection
@section('user-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Create User</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <form action="{{route('admin.users.store')}}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
         <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
            @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="roles" class="mb-1 ">Roles</label><br>
            @can('create-admin-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="admin" name="roles[]" value="admin" @if(is_array(old('roles')) && in_array('admin', old('roles'))) checked @endif>
                <label class="form-check-label me-2" for="admin"> admin </label>
            @endcan
            @can('create-manager-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="manager" name="roles[]" value="manager" @if(is_array(old('roles')) && in_array('manager', old('roles'))) checked @endif>
                <label class="form-check-label me-2" for="manager"> manager </label>
            @endcan
            @can('create-customer-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="customer" name="roles[]" value="customer" @if(is_array(old('roles')) && in_array('customer', old('roles'))) checked @endif >
                <label class="form-check-label me-2" for="customer"> customer </label>
            @endcan
            @error('roles')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </form>
@endsection
