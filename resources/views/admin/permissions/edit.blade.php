@extends('admin.master.master')
@section('title')
    Edit Permission
@endsection
@section('permission-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Edit Permission</h3>
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
            <form action="{{route('admin.roles.update',$role->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card permission-card">
                    <div class="card-header">
                        <h5>{{$role->name}}</h5> 
                    </div>
                    <div class="card-body permission-group">
                        {{-- <input type="hidden" name="role_id" value="{{$role->id}}"> --}}
                        @foreach ($permissions as $permission)
                            <div class="permission">
                                <input class="form-check-input" type="checkbox" value="{{$permission->name}}" name="permissions[]" @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                <label class="form-check-label me-2" for="manager"> {{$permission->name}} </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group mt-3">
                        <button class="btn btn-primary m-0">Save</button>
                    </div>
            </form>
        </div>
    </div>
@endsection