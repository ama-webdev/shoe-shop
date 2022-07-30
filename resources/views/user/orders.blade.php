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
            <h1 class="text-center mb-5">My Orders</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
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
                        <td>#{{$order->order_code}}</td>
                        <td>{{$count}}</td>
                        <td>{{number_format($total,2)}} Ks</td>
                        <td>{{$order->status}}</td>
                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s A')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection