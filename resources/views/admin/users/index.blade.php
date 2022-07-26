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
            <h3>Users</h3>
        </div>
        <div class="right">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  Create User
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="row mb-5 d-flex">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="role" class="mb-2">Role</label>
            <select name="" class="form-select" id="role">
                <option value="0">Select role</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
         <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="0">Select status</option>
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="name" class="mb-2">Name</label>
            <input type="text" class="form-control" id='name' name='name'>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="email" class="mb-2">Email</label>
            <input type="text" class="form-control" id='email' name='email'>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="" class="mb-2">.</label><br>
            <button class="btn btn-primary" id='search'>Search</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            let token = document.head.querySelector('meta[name="csrf-token"]')
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN': token.content
                    }
                })
            }

            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/users/datatable/ssd',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    { 
                        data: 'name',
                        name: 'name' 
                    },
                    { 
                        data: 'email',
                        name: 'email' 
                    },
                    { 
                        data: 'status',
                        name: 'status' 
                    },
                    {
                        data:'role',
                        name:'role',
                    },
                    { 
                        data: 'created_at',
                        name: 'created_at' 
                    },
                    { 
                        data: 'updated_at',
                        name: 'updated_at' 
                    },
                    { 
                        data: 'action',
                        name: 'action',
                        searchable:false,
                        sortable:false, 
                    },
                ],
                order:[
                    4,'desc'
                ]
            });

            $('#search').click(function(e){
                table.draw();
                e.preventDefault();
            })
        });
    </script>
@endsection