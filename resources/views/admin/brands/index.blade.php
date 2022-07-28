@extends('master.master')
@section('title')
    Brands
@endsection
@section('brand-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Brands</h3>
        </div>
        <div class="right">
            <a href="{{route('admin.brands.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  Create Brand
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
            <label for="brand_code" class="mb-2">Brand code</label>
            <input type="text" class="form-control" id='brand_code' name='brand_code'>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="" class="mb-2">.</label><br>
            <button class="btn btn-primary" id='search'>Search</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="brands-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand Code</th>
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
            var table = $('#brands-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/brands/datatable/ssd',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                        d.brand_code = $('input[name=brand_code]').val();
                    }
                },
                columns: [
                    { 
                        data: 'name',
                        name: 'name' 
                    },
                    {
                        data:'brand_code',
                        name:'brand_code',
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

            $("#brands-table").on('click', '.delete-btn', function(e) {
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
                            url: '/admin/brands/' + id,
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