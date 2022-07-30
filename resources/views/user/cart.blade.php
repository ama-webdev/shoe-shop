@extends('user.master.master')
@section('title')
    Cart
@endsection
@section('cart-active')
    active
@endsection
@section('style')
   <style>
        .card{
            box-shadow: var(--box-shadow)
        }
        .card img{
            width:100px;
        }
        .table{
            vertical-align: middle;
            /* border: 1px solid #ddd; */
        }
        .card-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 1.25rem;
        }
        .card-header h5,.card-header span{
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        .qty-wrapper{
            width: 100%;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: .5rem
        }
        .qty-wrapper button{
            background:none;
            outline: none;
            border: 1px solid var(--text-color);
            padding: 0 .5rem;
            border-radius: 5px;
        }
        .qty-wrapper input[type="number"]{
            width: 70px;
            border: 1px solid var(--text-color);
            border-radius: 5px;
            text-align: center;
            outline: none;
        }
        .card-footer{
            display: flex;
            justify-content: space-between;
            align-content: center;
            padding: 1rem;
        }
        table tbody tr:last-child{
            /* border-top: 1px solid #ddd; */
        }
        table thead{
            border-bottom: 1px solid #ddd;
        }
        table thead tr.table-heading th{
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .sizes,.colors{
            margin: 0;
            padding: 0;
        }
        .sizes .size{
            width: 30px;
            height: 30px;
        }
        .sizes .size:hover{
            color: var(--text-color);
            background-color: var(--white)
        }
        .colors .color{
            width: 30px;
            height: 30px;
        }
        .colors .color:hover{
            outline:none;
            border:1px solid var(--text-color);
            transform:scale(1)
        }
        .remove-item{
            font-size: 1.3rem;
            color: crimson;
            cursor: pointer;
        }
   </style>
@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Shopping cart</h5>
                        <span><span class="item-count">0</span> Items</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="table-heading">
                                        <th>Code</th>
                                        <th>Image</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="cart-table-body">
                                    {{-- <tr>
                                        <td>#P00001</td>
                                        <td><img src="{{asset('images/products/product.jpg')}}" alt=""></td>
                                        <td>
                                            <div class="sizes">
                                                <div class="size">9</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="colors">
                                                <div class="color" style="#FF0000"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="qty-wrapper">
                                                <button class="minus"><i class="fas fa-minus"></i></button>
                                                <input type="number" class="qty" disabled value="4">
                                                <button class="plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>40,000</td>
                                        <td>120,000</td>
                                        <td>
                                            <i class="fas fa-times remove-item"></i>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.shop')}}" class="btn text-primary">
                            <i class="fa-solid fa-left-long"></i>
                            Back To Shop
                        </a>
                         <div class="btn-grup">
                            <a href="#" class="clear_cart btn btn-danger"><i class="fas fa-times"></i></a>
                            <a href="#" class="btn btn-success order-now">Order Now</a>
                         </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                
            </div> --}}
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            showCart()

            // plus item
            $(".cart-table-body").on('click','.plus', function () {
                var parent=$(this).parent();
                var row_id=$(".qty",parent).data('row_id');

                var cart=JSON.parse(localStorage.getItem('cart'))
                cart[row_id].qty+=1;
                localStorage.setItem('cart',JSON.stringify(cart));
                showCart();
                showCartCount()
            });

            // minus item
            $(".cart-table-body").on('click','.minus', function () {
                var parent=$(this).parent();
                var row_id=$(".qty",parent).data('row_id');

                var cart=JSON.parse(localStorage.getItem('cart'))
                if(cart[row_id].qty==1){
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
                                var cart=JSON.parse(localStorage.getItem('cart'))
                                cart.splice(row_id,1);
                                localStorage.setItem('cart',JSON.stringify(cart));
                                showCart();
                                showCartCount()
                        }
                    })
                }else{
                    cart[row_id].qty-=1;
                    localStorage.setItem('cart',JSON.stringify(cart));
                    showCart();
                    showCartCount()
                }
            });

            // show cart count
            function showCartCount() {
                var count = 0;
                var cart = JSON.parse(localStorage.getItem('cart'));
                if (cart) {
                    $.each(cart, function (i, v) {
                        count += v.qty;
                    });
                }
                $(".item-count").text(count);
            }

            // show cart
            function showCart()
            {
                var html=``;
                var total=0;
                var cart=JSON.parse(localStorage.getItem('cart'));
                if(cart){
                    if(cart.length>0){
                        $.each(cart, function (i, v) { 
                             html+=`
                                    <tr>
                                        <td>#${v.product_code}</td>
                                        <td><img src="${v.image}" alt=""></td>
                                        <td>
                                            <div class="sizes">
                                                <div class="size">${v.size_name}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="colors">
                                                <div class="color" style="background-color:${v.color_name}"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="qty-wrapper">
                                                <button class="minus"><i class="fas fa-minus"></i></button>
                                                <input type="number" class="qty" data-row_id="${i}" disabled value="${v.qty}">
                                                <button class="plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>${v.price}</td>
                                        
                                        <td>${v.price * v.qty}</td>
                                        <td>
                                            <i class="fas fa-times remove-item" data-row_id="${i}"></i>
                                        </td>
                                    </tr>
                             `;
                             total+=v.price * v.qty;
                        });
                        html+=`
                            <tr>
                                <th colspan="6">Grand Total</th>
                                <th>${total} ks</th>
                            </tr>
                        `;
                    }else{
                        html+=`
                        <tr>
                            <td colspan="8">
                                <h5 class="text-center" style="color: #555; font-weight:bold;margin-top:2rem;opacity:.5;">No Data</h5>
                            </td>
                        </tr>
                        `;
                        $(".card-footer").addClass('d-none');
                        $("thead").addClass('d-none')

                    }
                }else{
                       html+=`
                        <tr>
                            <td colspan="8">
                                <h5 class="text-center" style="color: #555; font-weight:bold;margin-top:2rem;opacity:.5;">No Data</h5>
                            </td>
                        </tr>
                        `;
                    $(".card-footer").addClass('d-none');
                    $("thead").addClass('d-none')

                }
                $("table tbody").html(html);

            }

            // remove item
            $(".cart-table-body").on('click','.remove-item', function () {
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
                        var row_id=$(this).data('row_id');
                        var cart=JSON.parse(localStorage.getItem('cart'))
                        cart.splice(row_id,1);
                        localStorage.setItem('cart',JSON.stringify(cart));
                        showCart();
                        showCartCount()
                    }
                })
            });

            // order now
            $(".order-now").click(function(e){
                e.preventDefault();
                var cart = JSON.parse(localStorage.getItem('cart'));
                if(cart){
                    if(cart.length>0){
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Confirm'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    url: "/orders",
                                    data: {data:JSON.stringify(cart)},
                                    dataType: 'json',
                                    success: function (data) {
                                        clearCart();
                                        Swal.fire({
                                            // position: 'top-end',
                                            icon: 'success',
                                            title: data.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    },
                                    error:function(data){
                                        console.log(data.error)
                                    }
                                });
                            }
                        })
                    }
                }
            })

            // clear cart btn
            $(".clear_cart").click(function(e){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Your cart will be clear.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if(result.isConfirmed){
                        e.preventDefault();
                        clearCart();
                    }
                })
                
            })

            // clear cart
            function clearCart()
            {
                localStorage.removeItem('cart');
                showCart();
                showCartCount();
            }
        });
    </script>
@endsection