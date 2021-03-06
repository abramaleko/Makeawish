<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __(config('app.name')) }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="{{asset('icons/logo.png')}}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Removes arrow keys in input type number*/
            /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
    }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="font-family: 'Playfair Display', serif;">
            <div class="container">
                <a class="navbar-brand mr-lg-5" href="{{ url('/') }}">
                    <img src="{{asset('icons/logo.png')}}" style="height: 3rem;
                    width: 3.4rem;" >
                    {{ __(config('app.name', 'Laravel')) }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 16px;">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'wishes' ? 'active' : ''}}" href="{{ route('wishes') }}">{{ __('Make a wish') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'admin/status' ? 'active' : ''}}" href="{{ route('admin-status') }}">{{ __('Status') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'admin/all_wishes' || Request::path() =='filter/wishes' ? 'active' : ''}}" href="{{ route('admin-wishData') }}">{{ __('Wish Data') }}</a>
                        </li>
                        <!-- Dropdown -->
                        <li class="nav-item dropdown {{Route::is(['experience.index','grants-mail.show']) ? 'active' : ''}}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                {{ __('Feedback') }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{Request::path() == 'experience' ? 'active' : ''}}" href="{{ route('experience.index') }}">View Feedbacks</a>
                                <a class="dropdown-item {{Request::path() == 'grants/send_mail' ? 'active' : ''}}" href="{{route('grants-mail.show')}}">Gratitude Email</a>
                            </div>
                            </li>
                    </ul>
                    @endauth

                    @guest
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'wishes' ? 'active' : ''}}" href="{{ route('wishes') }}">{{ __('Make a wish') }}</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'status' || Request::path() =='filter/wishes' ? 'active' : ''}}" href="{{ route('status') }}">{{ __('Status') }}</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'experience' ? 'active' : ''}}" href="{{ route('experience.index') }}">{{ __('Feedback') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{Request::path() == 'contact' ? 'active' : ''}}" href="{{ route('contact') }}">{{ __('Contact us') }}</a>
                        </li>
                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Admin Log in') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                                    <a class="nav-link active" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Log out') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                        <!-- change language links -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             {{ strtoupper(app()->currentLocale())}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('locale','en')}}">English</a>
                              <a class="dropdown-item" href="{{route('locale','hi')}}">Hindi</a>
                            </div>
                          </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/font-awesome.js')}}"></script>
    @yield('scripts')
</body>
  @yield('footer')
</html>
