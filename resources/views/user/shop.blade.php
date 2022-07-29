@extends('user.master.master')
@section('title')
    Shop
@endsection
@section('shoe-active')
    active
@endsection
@section('style')
    <style>
         .pagination > li > a,
        .pagination > li > span {
            color: var(--text-color); // use your own color here
        }

        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover {
            background-color: var(--text-color);
            border-color: var(--text-color);
        }
    </style>
@endsection
@section('content')
<div class="content">
    <div class="menu">
        <h5>Categories</h5>
        <div class="menu-list">
            @foreach ($categories as $category)
                <a href="#" class="menu-list-item">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="main">
        <div class="main-nav">
            <select name="brand" id="brand" class="form-select me-3">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="">{{$brand->name}}</option>
                @endforeach
            </select>
            <div class="filter me-3">
                <a href="" class="btn btn-outline-dark"><i class="fa-solid fa-arrow-up-short-wide"></i></a>
            </div>
            <div class="btn-group">
                <a href="" class="btn btn-dark">Men</a>
                <a href="" class="btn btn-outline-dark">Women</a>
            </div>
        </div>
        <div class="main-content">
            <div class="container">
                <div class="row pt-1 products-wrapper infinite-scroll">
                    <p style="margin:0;padding:0;font-weight:bold;padding:.75rem">{{$products->total()}} shoes found.</p>
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mb-3">
                            <div class="shoe-card">
                                <div class="header">
                                    <img src="{{asset($product->image)}}" alt="">
                                </div>
                                <div class="body">
                                    <p class="shoe-name">{{$product->name}} (<span class="shoe-code">#{{$product->product_code}}</span>)</p>
                                    <p class="shoe-brand">{{$product->brand->name}}</p>
                                    <p class="shoe-price">{{number_format($product->price)}}ks</p>

                                    <div class="colors">
                                        @foreach ($product->colors as $color)
                                            <div>
                                                <input type="checkbox" name="colors[]" value="" id=""
                                                    class="d-none colorCheck">
                                                <label for="" class="color" style="background-color:{{$color->name}}"></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="quick-add">
                                        <h5>Quick add</h5>
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="sizes">
                                        @foreach ($product->sizes as $size)
                                        <div>
                                            <input type="checkbox" name="sizes[]" value="" id=""
                                            class="d-none sizeCheck">
                                            <label for="" class="size">{{$size->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
       
    </script>
@endsection