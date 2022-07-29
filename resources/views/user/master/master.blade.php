<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('style')

</head>

<body>

    <div class="wrapper">
        <div class="overlay"></div>
        <div class="mobile-nav">
            <div class="header">
                <img src="{{asset('images/template/mobile-nav-logo.jpg')}}" alt="">
            </div>
            <div class="body">
                <ul>
                    <li>
                        <a href="{{route('user.home')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('user.shop')}}">Shoes</a>
                    </li>
                    @guest
                    <li>
                        <a href="">Login</a>
                    </li>
                    <li>
                        <a href="">Register</a>
                    </li>
                    @endguest
                    @auth
                    <li>
                        <a href="">Logout</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
        <nav class="top-nav">
            <div class="top-nav-toggler">
                <div class="bars">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="logo">
                <img src="{{asset('images/template/user-page-logo.jpg')}}" alt="">
            </div>
            <div class="menu">
                <ul>
                    <li id="home"><a href="{{route('user.home')}}" class="@yield('home-active')">Home</a></li>
                    <li id="shoes"><a href="{{route('user.shop')}}" class="@yield('shoe-active')">Shoes</a></li>
                    @guest
                    <li id="shoes"><a href="" class="@yield('login-active')">Login</a></li>
                    <li id="shoes"><a href="" class="@yield('register-active')">Register</a></li>
                    @endguest
                    <li id="shopping cart"><a href=""><i class="fas fa-shopping-cart"></i></a></li>
                    <li id="user"><a href=""><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- infinite scroll --}}
    <script src="{{asset('js/infinite.js')}}"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- js -->
    <script src="{{asset('js/user.js')}}"></script>
    @yield('script')
</body>

</html>