@extends('admin.master.master')
@section('title')
    Create Category
@endsection
@section('category-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Create Category</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <form action="{{route('admin.categories.store')}}" method="POST">
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
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </form>
@endsection
