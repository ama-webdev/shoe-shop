@extends('master.master')
@section('title')
    Product Detail
@endsection
@section('product-active')
    active
@endsection
@section('style')
    <style>
        .product .product-name{
            text-transform: capitalize;
        }
        .table{
            margin: 0;
        }
        .table th,td{
            text-align: left !important;
            padding: 1rem;
            white-space: normal;
        }
        .table ul li{
            margin-bottom: 1rem;
        }
        .detail-head{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail-head a{
            font-size: 1.2rem;
        }
        .detail-td ul li, .detail-td ol li{
            list-style-type: disc;
        }
    </style>
@endsection

@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Product Detail</h3>
        </div>
        <div class="right">
            <a href="" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i>  Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="product">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-12 col-12 tex-center">
                <img src="{{asset($product->image)}}" alt="">
            </div>
            <div class="col-lg-8 col-md-7 col-sm-12 col-12">
                <table class="table table-bordered product-table">
                    <tr>
                        <th>Name</th>
                        <td colspan="3" class="product-name">{{$product->name}}</td>
                    </tr>
                    <tr>
                        <th>Code</th>
                        <td colspan="3">#{{$product->product_code}}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td colspan="3">{{number_format($product->price,2)}} MMK</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td colspan="3">{{$product->category->name}}</td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td colspan="3">{{$product->brand->name}}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td style="text-transform: capitalize" colspan="3">{{$product->gender->name}}</td>
                    </tr>
                    <tr>
                        <th>Colors</th>
                        <td colspan="3">
                            <div class="colors">
                                @foreach ($product->colors as $color)
                                    <div class="color" style="background-color:{{$color->name}}"></div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Sizes</th>
                        <td colspan="3">
                            <div class="sizes">
                                @foreach ($product->sizes as $size)
                                    <button class="size">{{$size->name}}</button>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Detail</th>
                        <td style="word-break:break-all;" colspan="3" class="detail-td">{!!$product->detail!!}</td>
                    </tr>
                    <tr>
                        <th>Action</th>
                        <td colspan="3">
                            <a href="" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger delete-btn" data-id="{{$product->unique_code}}">Delete</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(".product-table").on('click', '.delete-btn', function(e) {
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
                                window.location.href='/admin/products';
                            },
                            // statusCode:{
                            //     403:function(){
                            //         window.location.reload();
                            //     }
                            // }
                        })
                    }
                })
            })
        });
    </script>
@endsection
