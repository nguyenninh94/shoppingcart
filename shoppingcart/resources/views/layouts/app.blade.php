<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
    
    <!--facebook comment-->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=355243024843814";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
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
                        <li>
                        <select name="" id="languageSwitcher" style="width:100px;height:30px;margin-top: 10px">
                            <option value="vi" {{ Session::get('locale') == 'vi' ? 'selected' : '' }}>Vietnamese</option>
                            <option value="en" {{ Session::get('locale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="jp" {{ Session::get('locale') == 'jp' ? 'selected' : '' }}>Japanese</option>
                            <option value="de" {{ Session::get('locale') == 'de' ? 'selected' : '' }}>German</option>
                            <option value="fr" {{ Session::get('locale') == 'fr' ? 'selected' : '' }}>French</option>
                            <option value="ch" {{ Session::get('locale') == 'ch' ? 'selected' : '' }}>Chinese</option>
                            <option value="rs" {{ Session::get('locale') == 'rs' ? 'selected' : '' }}>Russian</option>
                            <option value="ko" {{ Session::get('locale') == 'ko' ? 'selected' : '' }}>Korean</option>
                            <option value="in" {{ Session::get('locale') == 'in' ? 'selected' : '' }}>Indian</option>
                        </select>
                       </li> 
                        <li><a href="{{url('/')}}">{{ trans('app.Home') }}</a></li>
                        <li><a href="#">{{ trans('app.About') }}</a></li>
                        <li><a href="#">{{ trans('app.Contact') }}</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                   <input type="text" name="search" class="form-control" placeholder="{{ trans('app.Search') }}...">
                                </div>
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                           </form>
                        </li>
                        <li><a href="{{url('/cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge">{{Cart::count()}}</span></a></li>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">{{ trans('app.Login') }}</a></li>
                            <li><a href="{{ route('register') }}">{{ trans('app.Register') }}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ trans('app.Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <footer>
      <div class="container">
        <p class="text-muted text-center">{{ trans('app.By') }} <a href="">Nguyen Van Ninh</a></p>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/language.js') }}"></script>

    @yield('script')
    
    <script type="text/javascript">
      $(function() {
         $('#province').change(function() {
            var provinceID = $(this).val();

            if(provinceID){
                $.ajax({
                   type: 'GET',
                   url: '/get-district-list/' + provinceID,
                   datatype: 'json',
                   success: function(data) {
                     if(data) {
                        $('#district').empty();
                        $('#district').append('<option>{{ trans('app.SelectDistrict') }}</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="'+ value.id +'">' + value.name + '</option>');
                        });                 
                     } else {
                        $('#district').empty();
                     }
                   } 
                });
            } else {
                $('#district').empty();
                $('#ward').empty();
            }
         }); 
  
         $('#district').change(function() {
            var districtID = $(this).val();

            if(districtID) {
                $.ajax({
                   type: 'GET',
                   url: '/get-ward-list/' + districtID,
                   dataType: 'json',
                   success: function(data) {
                      if(data) {
                        $('#ward').empty();
                        $('#ward').append('<option>{{ trans('app.SelectWard') }}</option>');
                        $.each(data, function(key, value) {
                           $('#ward').append('<option value="' + value.id +'">' + value.name + '</option>');
                        });
                      } else {
                        $('#ward').empty();
                      }
                   }
                });
            } else {
                $('#ward').empty();
            }
         });
      });
   </script>
</body>
</html>
