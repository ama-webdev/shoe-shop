@extends('admin.master.master')
@section('title')
    Dashboard
@endsection
@section('dashboard-active')
    active
@endsection
@section('style')
    <style>
        a{
            text-decoration: none;
            color: var(--text-muted);
        }
        a:hover{
            color: var(--text-color);
        }
        a .d-card{
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        a .d-card div{
           text-align: left;
           width:100%;
           padding-left: 1rem;
        }
        a .d-card div h5{
            font-weight: bold;
        }
        a .d-card div span{
            font-weight: bold;
        }
    </style>
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Dashboard</h3>
        </div>
        <div class="right">
            <a href="#" class="btn btn-outline-dark">
                <i class="fa-solid fa-scale-balanced"></i>  Sale
            </a>    
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-12">
            <a href="{{route('admin.users.index')}}">
                <div class="d-card">
                    <i class="fas fa-users fa-3x"></i>
                    <div>
                        <h5>Users</h5><span>{{$user_count}}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-12">
            <a href="{{route('admin.products.index')}}">
                <div class="d-card">
                    <i class="fa-solid fa-tag fa-3x"></i>
                    <div>
                        <h5>Products</h5><span>{{$product_count}}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-12">
            <a href="">
                <div class="d-card">
                    <i class="fa-solid fa-inbox fa-3x"></i>
                    <div>
                        <h5>Inbox</h5><span>23</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12 col-12">
            <a href="{{route('admin.orders.index')}}">
                <div class="d-card">
                    <i class="fa-solid fa-cart-arrow-down fa-3x"></i>
                    <div>
                        <h5>Orders</h5><span>{{$order_count}}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <canvas id="order-chart" style="width:100%;"></canvas>
        </div>
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

            $.ajax({
                type: "POST",
                url: "/orders/ssd/summary",
                data: "",
                dataType: "json",
                success: function (response) {
                    var xValues = ["Jan", "Feb", "March","Apl","May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                    var yValues = JSON.parse(response.data);
                    var colors=[];
                    for (let i = 0; i < 12; i++) {
                        colors[i]='#'+(Math.random() * 0xFFFFFF << 0).toString(16).padStart(6, '0');
                    }
                    var barColors = colors;

                    new Chart("order-chart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            backgroundColor: '#555',
                            data: yValues
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                            display: true,
                            text: "Order Summary"
                            }
                        }
                    });
                }
            });
            
        });
    </script>
@endsection
