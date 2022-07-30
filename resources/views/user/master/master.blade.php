<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <li>
                        <a href="{{route('user.orders')}}">Orders</a>
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
                        <a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Logout</a>
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
                    <li id="shopping-cart"><a href="{{route('user.cart')}}" class="@yield('cart-active')"><i class="fas fa-shopping-cart"></i><span class="item-count">0</span></a></li>
                    <li class="nav-item dropdown" id="user">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="logout-user-btn">{{ Auth::user()->name }}</span> <i class="fas fa-user ms-2"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.orders') }}">
                                Orders
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- sweet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- js -->
    <script src="{{asset('js/user.js')}}"></script>
    @yield('script')
</body>

</html>