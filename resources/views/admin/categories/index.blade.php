@extends('master.master')
@section('title')
    Categories
@endsection
@section('category-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Categories</h3>
        </div>
        <div class="right">
            <a href="{{route('admin.categories.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  Create Category
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="row mb-5 d-flex">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="name" class="mb-2">Name</label>
            <input type="text" class="form-control" id='name' name='name'>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="" class="mb-2">.</label><br>
            <button class="btn btn-primary" id='search'>Search</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="categories-table">
        <thead>
            <tr>
                <th>Name</th>
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
            var table = $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/categories/datatable/ssd',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                    }
                },
                columns: [
                    { 
                        data: 'name',
                        name: 'name' 
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
                    2,'desc'
                ]
            });

            $('#search').click(function(e){
                table.draw();
                e.preventDefault();
            })

            $("#categories-table").on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/categories/' + id,
                            type: 'DELETE',
                            success: function() {
                                table.ajax.reload();
                            },
                            statusCode:{
                                403:function(){
                                    window.location.reload();
                                }
                            }
                        })
                    }
                })
            })
        });
    </script>
@endsection