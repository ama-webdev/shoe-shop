@extends('admin.master.master')
@section('title')
    Setting
@endsection
@section('setting-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Settings</h3>
        </div>
        <div class="right">
            {{-- <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>     --}}
        </div>
    </div>
@endsection
@section('content')
    <div class="settings">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{route('admin.settings.change-password')}}" class="list-group-item-link">Change Password</a>
            </li>
        </ul>
    </div>
@endsection
