<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todos</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                /*margin-bottom: 30px;*/
            }

            .navbar {
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;
            }

            .content-box {
                padding: 0 16px 0 16px;
            }
        </style>
    </head>
    <body>
        
            
            

            <div class="contianer">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                              <a class="navbar-brand" href="{{ route('home') }}">Todos</a>
                        </div>
                        <div class="collapse navbar-collapse" id="nav-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                
                            <li><a href="{{ route('todo.show', ['assign' => 'all']) }}">All</a></li>
                            <li><a href="{{ route('todo.show', ['assign' => 'incomplete']) }}">Incomplete</a></li>
                            <li><a href="{{ route('todo.show', ['assign' => 'complete']) }}">Completed</a></li>
                            <li><a href="#">About</a></li>
                            @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @else
                                    {{-- dd(Auth::user()->avatar) --}}
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><img src="{{ Auth::user()->avatar }}" width="20px">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li>
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
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    
    @yield('scripts')

    </body>
</html>
