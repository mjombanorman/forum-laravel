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
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
         <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/notify/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        @yield('styles')
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
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('forum')}}">Home</a></li>
                             
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
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

        </div>
        @if($errors->count()>0)
        <div class="container">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="container">

            <div class="col-md-4">
                <a href="{{route('discussion.create')}}" class="form-control btn btn-primary">
                    Create a New Discussion
                </a>
                <div class="panel panel-default">
                    @if(Auth::check())
                    @if(Auth::user()->admin)
                      <div class="panel-heading">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{route('all.channels')}}">All Channels</a></li>
                             <li class="list-group-item"><a href="{{route('forum',['filter'=>'me'])}}">My Discussions</a></li>
                             <li class="list-group-item"><a href="{{route('forum',['filter'=>'answered'])}}">Answered Discussions</a></li>
                              <li class="list-group-item"><a href="{{route('forum',['filter'=>'unanswered'])}}">Unanswered Discussions</a></li>
                        </ul>
                    </div>
                    @endif
                      @endif
                    <div class="panel-heading">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{route('forum')}}">Home</a></li>
                             <li class="list-group-item"><a href="{{route('forum',['filter'=>'me'])}}">My Discussions</a></li>
                             <li class="list-group-item"><a href="{{route('forum',['filter'=>'answered'])}}">Answered Discussions</a></li>
                              <li class="list-group-item"><a href="{{route('forum',['filter'=>'unanswered'])}}">Unanswered Discussions</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">

                        <ul class="list-group">
                            @foreach($channels as $channel)
                            <li class="list-group-item"><a href="{{route('channel',['slug'=>$channel->slug])}}">{{$channel->title}}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>


            <div class="col-md-8">
                @yield('content')
            </div>
        </div>



        <!-- Scripts -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/notify/toastr.min.js') }}"></script>
        <script>

                                               @if (Session::has('success'))
                                                       toastr.success('{{Session::get('success')}}')
                                                       @endif
        </script>
@yield('scripts')
    </body>
</html>
