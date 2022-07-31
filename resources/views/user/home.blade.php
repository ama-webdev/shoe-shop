@extends('user.master.master')
@section('title')
Home
@endsection
@section('home-active')
active
@endsection
@section('content')
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="title">Free <br> Runner</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-8 col-8">
                <h5>All you need is <span>love</span> new shoes.</h5>
                <a href="{{route('user.shop')}}" class="shop-now">Shop Now</a>
            </div>
        </div>
    </div>
</header>

<style>
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background: transparent !important;
        color: black !important;
        border-bottom: 2px solid black !important;
        border-radius: 0px !important;
        border-color: #f2f2f2;
    }

    .nav-item {
        padding: 0 20px;
    }

    .product-detail {
        padding: 18px 30px;
        justify-content: space-between;

    }

    .border-line {
        border-bottom: 1px solid rgb(211, 212, 213);
    }

    ul li {
        margin-bottom: 12px;
    }
</style>

<body class="body">

    <div class="container py-5">
        <h3 class="mb-3 fw-bolder text-center">Our Favourites</h3>


        <div style="justify-content: center;" class="mb-3">


            <!-- Tabs navs -->
            <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-bs-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">FOR RUNNING</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">FOR EVERYDAY</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-bs-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">FOR SUMMER</a>
                </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass1.jpeg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Flyer</h3>
                                </div>
                                <p class="py-3">Light, Bouncy, Long Distance Runs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass1.jpeg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Flyer</h3>
                                </div>
                                <p class="py-3">Light, Bouncy, Long Distance Runs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass1.jpeg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Flyer</h3>
                                </div>
                                <p class="py-3">Light, Bouncy, Long Distance Runs</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Trail Runner SWT</h3>
                                </div>
                                <p class="py-3">Durable, Grippy, Off Road Terrain</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Trail Runner SWT</h3>
                                </div>
                                <p class="py-3">Durable, Grippy, Off Road Terrain</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Trail Runner SWT</h3>
                                </div>
                                <p class="py-3">Durable, Grippy, Off Road Terrain</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Dasher 2</h3>
                                </div>
                                <p class="py-3">Comfy, Breezy, Everyday Runs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Dasher 2</h3>
                                </div>
                                <p class="py-3">Comfy, Breezy, Everyday Runs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                            <div class="product-detail">
                                <div class="border-line">
                                    <h3 class="mb-3 fw-bolder">Tree Dasher 2</h3>
                                </div>
                                <p class="py-3">Comfy, Breezy, Everyday Runs</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Tabs content -->





        </div>

    </div>

    <div class="py-5">
        <div>
            <img src="{{asset('images/template/shoes.jpg')}}" alt="" height="650px">
        </div>
    </div>

    <div class="container text-center mb-5">
        <p class="fs-2 fw-bolder"> Big News For Little Feet</p>
        <div class="d-grid gap-2 col-6 mx-auto">
            <p>Our best-selling kids shoes are back and cuter than ever with even more styles and sizes from 5T to 3Y.</p>
        </div>
        <div class="d-grid gap-2 col-4 mx-auto">
            <button class="btn btn-dark" type="button"><a href="{{route('user.shop')}}" style="text-decoration: none; color: white;"> SHOP NOW </a></button>
        </div>

    </div>

</body>
<footer class="bg-dark text-white text-center text-lg-start">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Follow the Flock</h5>

                <p>
                    Exclusive offers, a heads up on new things, and sightings of Allbirds in the wild. Oh, we have cute sheep, too. #kmpg
                </p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-5">
                <h5 class="text-uppercase mb-3">Help</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">+959123456789</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">+959987654321</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">FAQ/Contact us</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">footwear@gmail.com</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-3">SHOP</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Everyday Sneakers</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Running Shoes</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Sandals</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Slip-Ons</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Water-Repellent Sneakers</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Hiking Shoes</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Flats</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">High Tops</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}" class="text-white">Slippers</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-white">FOOTWEAR</a>
    </div>
    <!-- Copyright -->
</footer>

<script>
    // $(document).ready(function() {
    //     $('.menu-list-item').click(function(e) {
    //         var category = $(this).data('category');
    //         history.pushState(null, '', `?category=${category}&brand=""&gender=""`);
    //         window.location.reload();
    //     })
    // })
</script>
@endsection