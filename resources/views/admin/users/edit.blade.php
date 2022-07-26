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
            <h3>Edit User</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <form action="{{route('admin.users.update',$user->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$user->name)}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email',$user->email)}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        {{-- <div class="form-group mb-3">
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
        </div> --}}
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="ACTIVE" @if($user->status=='ACTIVE') selected @endif>Active</option>
                <option value="INACTIVE" @if($user->status=='INACTIVE') selected @endif>Inactive</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="new-password">New Password (optional)</label>
            <input type="password" id="new-password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
        </div>
        <div class="form-group mb-3">
            <label for="roles" class="mb-1 ">Roles</label><br>
            @can('edit-admin-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="admin" name="roles[]" value="admin" @if(is_array(old('roles')) && in_array('admin', old('roles')) || $user->hasRole('admin')) checked @endif>
                <label class="form-check-label me-2" for="admin"> admin </label>
            @endcan
            @can('edit-manager-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="manager" name="roles[]" value="manager" @if(is_array(old('roles')) && in_array('manager', old('roles')) || $user->hasRole('manager')) checked @endif>
                <label class="form-check-label me-2" for="manager"> manager </label>
            @endcan
            @can('edit-customer-user')
                <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox" id="customer" name="roles[]" value="customer" @if(is_array(old('roles')) && in_array('customer', old('roles')) || $user->hasRole('customer')) checked @endif>
                <label class="form-check-label me-2" for="customer"> customer </label>
            @endcan
            @error('roles')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
@endsection
