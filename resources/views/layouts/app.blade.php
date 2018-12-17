<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  @yield('extraHead')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    {{date("l jS \of F Y h:i:s A")}}


                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Rent-A-Car
                        <!-- {{ config('app.name', 'Laravel') }} -->
                    </a>
                    <form action="{{url('/home/search')}}" method="GET">
                        <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}" placeholder="Search car" required autofocus>
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Left Side Of Navbar 
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
                -->
                <!-- Right Side Of Navbar -->

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        @can('isAdmin')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Manage <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('manage_user')}}">Users</a>
                                        <a href="{{route('manage_brand')}}">Brands</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    View <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('all_transaction')}}">View All Transaction</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li><a href="{{ url('/cart') }}">Cart</a></li>
                        <li><a href="{{ url('/myposts') }}">My Post</a></li>
                        welcome, {{ Auth::user()->name }}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/profile') }}">Profile</a>
                                    <a href="{{route ('transaction_history')}}">Transaction History</a>
                                    
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
