<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Enjoy the trip!</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://bootswatch.com/3/readable/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="shortcut icon" href="{{ Vite::image('favicon.ico') }}">
                

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--<link rel="stylesheet" href="css/app.css">-->
        @vite(['resources/css/app.css'])
        <script>
            var base_url = '{{ url('/') }}';
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home')  }}">Home</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    @auth 
                    <ul class="nav navbar-nav">
                        <li><p class="navbar-text">Logged in as:</p></li>
                        <li><p class="navbar-text">{{ Auth::user()->name }}</p></li>
                        <li><a href="{{ route('adminHome') }}">admin</a></li>
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
                    @endauth 
                    @guest 
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('login') }}">Sign in</a></li> 
                        <li><a href="{{ route('register') }}">Sign up</a></li> 
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Vite::image('ru.png') }}" alt="">
                            </a>
                            <ul class="dropdown-menu" id="languages">
                                <li>
                                        <button class="dropdown-item" data-langcode="en" style="border:none;background-color: #fff;">
                                        <img src="{{ Vite::image('en.png') }}" alt="">
                                    English</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endguest 
                </div><!--/.nav-collapse -->
            </div>
        </nav>  

        <div class="jumbotron">
            <div class="container">
                <h1>Enjoy the trip!</h1>
                <p>A platform for tourists and owners of tourist facilities. Find the original place for the holidays!</p>
                <p>Place your home on the site and let yourself be found by many tourists!</p>
                <form method="POST" <?php ?> action="{{ route('roomSearch') }}"  class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="city">City</label>
                        <input value="{{ old('city')  }}" name="city" type="text" class="form-control autocomplete" id="city" placeholder="City">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="day_in">Check in</label>
                        <input value="{{ old('check_in')  }}" name="check_in" type="text" class="form-control datepicker" id="check_in" placeholder="Check in">
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="day_out">Check out</label>
                        <input value="{{ old('check_out')  }}" name="check_out" type="text" class="form-control datepicker" id="check_out" placeholder="Check out">
                    </div>
                    <div class="form-group">
                        <select name="room_size" class="form-control">
                            <option>Room size</option>
                            
                            @for($i=1;$i<=5;$i++)
                                @if( old('room_size') == $i )
                                <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">Search</button>
                    {{ csrf_field() }}  
                </form>

            </div>
        </div>

        @yield('content')

        <div class="container-fluid">

            <!--<div class="row mobile-apps">

                <div class="col-md-6 col-xs-12">
                    <img src="{{ Vite::image('mobile-app.png') }}" alt="" class="img-responsive center-block">
                </div>

                <div class="col-md-6 col-xs-12">
                    <h1 class="text-center">Download mobile app.</h1>
                    <a href="#"><img class="img-responsive center-block"  src="{{ Vite::image('google.png') }}" alt=""></a><br><br>
                    <a href="#"><img class="img-responsive center-block" src="{{ Vite::image('apple.png') }}" alt=""></a><br><br>
                    <a href="#"><img class="img-responsive center-block" src="{{ Vite::image('windows.png') }}" alt=""></a>

                </div>

            </div>-->

            <hr>

            <footer>

                <p class="text-center">&copy; 2023 Enjoy the trip!, Inc.</p>

            </footer>

        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!--<script src="js/app.js"></script>-->
        @vite(['resources/js/app.js'])
        @stack('scripts') 
    </body>
</html>
