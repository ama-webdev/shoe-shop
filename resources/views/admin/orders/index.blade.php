@extends('admin.master.master')
@section('title')
    Orders
@endsection
@section('order-active')
    active
@endsection
@section('content-header')
    <div class="content-header">
        <div class="left">
            <h3>Orders</h3>
        </div>
        <div class="right">
            {{-- <a href="{{route('admin.categories.create')}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>  Create Category
            </a>     --}}
        </div>
    </div>
@endsection
@section('content')
    <div class="row mb-5 d-flex">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="order_code" class="mb-2">Order code</label>
            <input type="text" class="form-control" id='order_code' name='order_code'>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="status" class="mb-2">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="confirm">CONFIRM</option>
                <option value="delivering">DELIVERING</option>
                <option value="delivered">DELIVERED</option>
                <option value="cancel">CANCEL</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <label for="" class="mb-2">.</label><br>
            <button class="btn btn-primary" id='search'>Search</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="orders-table">
            <thead>
                <tr>
                    <th>Order Code</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var table = $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/orders/datatable/ssd',
                    data: function (d) {
                        d.order_code = $('input[name=order_code]').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [
                    {
                        data:'order_code',
                        name:'order_code',
                    },
                    {
                        data:'qty',
                        name:'qty',
                    },
                    {
                        data:'total',
                        name:'total',
                    },
                    {
                        data:'status',
                        name:'status',
                    },
                    { 
                        data: 'created_at',
                        name: 'created_at' 
                    },
                    { 
                        data: 'updated_at',
                        name: 'updated_at' 
                    },
                    // { 
                    //     data: 'action',
                    //     name: 'action' 
                    // },
                    
                ],
                order:[
                    5,'desc'
                ]
            });

            $('#search').click(function(e){
                table.draw();
                e.preventDefault();
            })
        });
    </script>
@endsection