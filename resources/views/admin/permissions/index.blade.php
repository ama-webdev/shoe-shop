@extends('master.master')
@section('title')
    Permission
@endsection
@section('permission-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Permission Management</h3>
        </div>
        <div class="right">
            {{-- <a href="{{route('admin.permissions.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  New permission
            </a>     --}}
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                <div class="card permission-card">
                    <div class="card-header">
                        <h5>{{$role->name}}</h5> 
                        @can('edit-admin-permission')
                            <a href="{{route('admin.roles.edit',$role->id)}}"><i class="fa-solid fa-ellipsis"></i></a>
                        @endcan
                    </div>
                    <div class="card-body permission-group">
                        @foreach ($permissions as $permission)
                            <div class="permission">
                                <input class="form-check-input" type="checkbox" disabled @if ($role->hasPermissionTo($permission->name)) checked @endif>
                                <label class="form-check-label me-2" for="manager"> {{$permission->name}} </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection