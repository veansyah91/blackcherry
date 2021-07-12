<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle{{ request()->is('master/*') ? ' active' :'' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Master</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item{{ request()->is('master/customer') ? ' active' : '' }}" href="{{ route('customer') }}">Pelanggan</a>
                                    <a class="dropdown-item{{ request()->is('master/product') ? ' active' : '' }}" href="{{ route('product') }}">Produk</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle{{ request()->is('outcome/*') ? ' active' :'' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pengeluaran</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item{{ request()->is('outcome/daily') ? ' active' : '' }}" href="{{ route('daily-outcome') }}">Harian</a>
                                    <a class="dropdown-item{{ request()->is('outcome/daily-detail') ? ' active' : '' }}" href="{{ route('daily-outcome-detail') }}">Rincian Harian</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item{{ request()->is('outcome/monthly') ? ' active' : '' }}" href="{{ route('monthly-outcome') }}">Bulanan</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle{{ request()->is('income/*') ? ' active' :'' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pendapatan</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item{{ request()->is('income/invoice') ? ' active' : '' }}" href="{{ route('income-invoice') }}">Invoice</a>
                                    <a class="dropdown-item{{ request()->is('income/daily') ? ' active' : '' }}" href="{{ route('daily-income') }}">Harian</a>
                                    <a class="dropdown-item{{ request()->is('income/monthly') ? ' active' : '' }}" href="{{ route('monthly-income') }}">Bulanan</a>
                                    
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    
                                </div>
                            </li>
                        </ul>
                    @endauth
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @role("admin")
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle{{ request()->is('user/*') ? ' active' :'' }}{{ request()->is('role') ? ' active' :'' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Pengguna
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item{{ request()->is('user/data') ? ' active' :'' }}" href="{{ route('user') }}">
                                            Semua Pengguna
                                        </a>
                                        <a class="dropdown-item{{ request()->is('role') ? ' active' :'' }}" href="{{ route('role') }}">
                                            Role
                                        </a>
                                        <a class="dropdown-item{{ request()->is('user-role') ? ' active' :'' }}" href="{{ route('user-role') }}">
                                            Role Pengguna
                                        </a>
                                    </div>
                                </li>
                            @endrole
                            
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item{{ request()->is('user/change-password') ? ' active' :'' }}" href="{{ route('change-password') }}">
                                        Ubah Password
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>
</html>
