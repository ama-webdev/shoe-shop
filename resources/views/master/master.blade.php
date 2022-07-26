<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('name')</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">  
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- datatable --}}

  
    <link rel="stylesheet" href="  https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/template.css')}}">
</head>

<body>
    <div class="wrapper">
        <div class="overlay"></div>
        <div class="sidebar">
            <div class="header">
                <img src="{{asset('images/template/logo2.webp')}}" alt="shoe shop">
            </div>
            <div class="body">
                <ul>
                    <li class="dashboard-active">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa-solid fa-chart-line"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="@yield('user-active')">
                        <a href="{{route('admin.users.index')}}">
                            <i class="fa-solid fa-user-pen"></i>
                            Users
                        </a>
                    </li>
                    <li class="@yield('permission-active')">
                        <a href="{{route('admin.permissions')}}">
                            <i class="fa-solid fa-lock"></i>
                            Permission
                        </a>
                    </li>
                    <li class="@yield('category-active')">
                        <a href="">
                            <i class="fa-solid fa-clipboard-list"></i>
                            Categories
                        </a>
                    </li>
                    <li class="@yield('product-active')">
                        <a href="">
                           <i class="fa-solid fa-tag"></i>
                            Products
                        </a>
                    </li>
                    <li class="@yield('sale-active')">
                        <a href="">
                            <i class="fa-solid fa-scale-balanced"></i>
                            Sale
                        </a>
                    </li>
                     <li class="@yield('order-active')">
                        <a href="">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                            Orders
                        </a>
                    </li>
                    <li class="@yield('inbox-active')">
                        <a href="">
                            <i class="fa-solid fa-inbox"></i>
                            Inbox
                        </a>
                    </li>
                    <li class="@yield('setting-active')">
                        <a href="{{route('admin.settings')}}">
                            <i class="fa-solid fa-cog"></i>
                            Setting
                        </a>
                    </li>
                    <li class="@yield('signout-active')">
                        <a class="dropdown-item logout p-0" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out"></i>Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="top-nav">
                <div class="left">
                    <i class="fas fa-bars sidebar-toggler"></i>
                </div>
                <div class="right">
                    <div class="auth-user">
                        <span>{{Auth::user()->name}}</span>
                        <i class="fas fa-user-circle fa-2x"></i>
                    </div>
                    <div class="auth-user-menu">
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}" class="logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container-fluid content-wrapper">
                <div class="row">
                    <div class="col-12">
                        @yield('content-header')
                    </div>
                </div>
                <div class="row main-content">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- <footer>
                developed by ayeminaung
            </footer> --}}
        </div>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{-- sweet alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap JavaScript -->
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- js -->
    <script src="{{asset('js/template.js')}}"></script>
    @yield('script')
    <script>
        $(document).ready(function () {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        @if (session('created'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('created') }}"
            })
        @endif
        @if (session('updated'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('updated') }}"
            })
        @endif
        });
    </script>
</body>

</html>