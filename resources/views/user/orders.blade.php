@extends('user.master.master')
@section('title')
    Cart
@endsection
@section('cart-active')
    active
@endsection
@section('style')
  <style>
    .card-header h5{
        font-weight: bold;
    }
  </style>
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center  ">
            <div class="col-lg-8 col-md-10 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Your Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Code</th>
                                    <th>Qty</th>
                                    <th>Total (Ks)</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($orders as $order)
                                @php
                                    $total=0;
                                    $count=0;
                                    foreach ($order->order_details as $order_detail) {
                                        $total+=$order_detail->product->price;
                                        $count++;
                                    }
                                @endphp
                                    
                                <tr>
                                    <td>{{$i}}</td>
                                    <td><a href="{{route('user.order_details',$order->unique_code)}}">#{{$order->order_code}}</a></td>
                                    <td>{{$count}}</td>
                                    <td>{{number_format($total,2)}}</td>
                                    <td style="text-transform:uppercase">{{$order->status}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s A')}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$orders->links()}}
                </div>
            </div>
            
        </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection