@extends('admin.master.master')
@section('title')
    Products
@endsection
@section('product-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Products</h3>
        </div>
        <div class="right">
            <a href="{{route('admin.products.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  New Product
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="products">
        <div class="row mb-5 d-flex">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="name" class="mb-2">Name</label>
                <input type="text" class="form-control" id='name' name='name'>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="product_code" class="mb-2">Product Code</label>
                <input type="text" class="form-control" id='product_code' name='product_code'>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="category_id" class="mb-2">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="0">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="brand_id" class="mb-2">Brand</label>
                <select name="brand_id" id="brand_id" class="form-select">
                    <option value="0">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="gender_id" class="mb-2">Gender</label>
                <select name="gender_id" id="gender_id" class="form-select">
                    <option value="0">Select gender</option>
                    @foreach ($genders as $gender)
                        <option value="{{$gender->id}}">{{$gender->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label for="" class="mb-2">.</label><br>
                <button class="btn btn-primary" id='search'>Search</button>
            </div>  
        </div>
        <div class="table-responsive">
            <table class="table table-bordered cellspacing="0"
  width="100%" id="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Product Code</th>
                        <th>Price ( MMK )</th>
                        <th>Sizes</th>
                        <th>Colors</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Gender</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var table = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/products/datatable/ssd',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                        d.product_code = $('input[name=product_code]').val();
                        d.brand_id=$('#brand_id').val();
                        d.gender_id=$('#gender_id').val();
                        d.category_id=$('#category_id').val();

                    }
                },
                columns: [
                    { 
                        data: 'image',
                        name: 'image' 
                    },
                    { 
                        data: 'name',
                        name: 'name' 
                    },
                    {
                        data:'product_code',
                        name:'product_code',
                    },
                    {
                        data:'price',
                        name:'price',
                    },
                    { 
                        data: 'sizes',
                        name: 'sizes',
                        colspan:2
                    },
                    { 
                        data: 'colors',
                        name: 'colors' 
                    },
                    { 
                        data: 'category',
                        name: 'category' 
                    },
                    {
                        data: 'brand',
                        name: 'brand' 
                    },
                    {
                        data: 'gender',
                        name: 'gender' 
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
                    9,'desc'
                ],
                
            });

            $('#search').click(function(e){
                table.draw();
                e.preventDefault();
            })

            $("#products-table").on('click', '.delete-btn', function(e) {
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
                            url: '/admin/products/' + id,
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
