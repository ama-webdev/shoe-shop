@extends('admin.master.master')
@section('title')
    Order Detail
@endsection
@section('order-active')
    active
@endsection
@section('style')
  <style>
    .card-header h5{
        font-weight: bold;
    }
    img{
        width: 100px;
    }
    .card-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .sizes,.colors{
        justify-content: center;
    }
  </style>
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Order Detail</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-primary back-btn">
                <i class="fas fa-undo"></i> Back
            </a>    
        </div>
    </div>
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">#{{$order->order_code}}</h5> 
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>Image</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Qty</th>
                                    <th>Price (Ks)</th>
                                    <th>Total (Ks)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($order->order_details as $order_detail)
                                @php
                                    $total+=$order_detail->qty*$order_detail->product->price;
                                @endphp
                                    <tr>
                                        <td>{{$order_detail->product->product_code}}</td>
                                        <td>
                                            <img src="{{asset($order_detail->product->image)}}" alt="">
                                        </td>
                                        <td>
                                            <div class="sizes">
                                                <div class="size">{{$order_detail->size->name}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="colors">
                                                <div class="color" style="background-color:{{$order_detail->color->name}}"></div>
                                            </div>
                                        </td>
                                        <td>
                                            {{$order_detail->qty}}
                                        </td>
                                        <td>
                                            {{$order_detail->product->price}}
                                        </td>
                                        <td>
                                            {{number_format($order_detail->product->price * $order_detail->qty,2)}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">Grand Total</td>
                                    <td>{{number_format($total)}} ks</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection