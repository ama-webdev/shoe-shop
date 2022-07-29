@extends('admin.master.master')
@section('title')
    Permission
@endsection
@section('permission-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>New Permission</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.permissions.store')}}" method="POST">
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
                <div class="form-group">
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection