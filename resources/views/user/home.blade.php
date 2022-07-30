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
                <a href="" class="shop-now">Shop Now</a>
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
</style>

<body class="body">

    <div class="container mt-2">
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
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass1.jpeg')}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass1.jpeg')}}" class="img-thumbnail">
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass2.jpg')}}" class="img-thumbnail">
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/template/ass3.webp')}}" class="img-thumbnail">
                        </div>
                    </div>

                </div>
            </div>
            <!-- Tabs content -->





        </div>

    </div>

</body>
<footer>
    <div>
        <div>

        </div>
        <div>

        </div>
        <div>

        </div>
    </div>
    <div></div>
</footer>
@endsection