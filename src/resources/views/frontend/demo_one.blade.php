<!-- @extends('layouts.header') @section('title', 'Demo One | UNDP') @section('content') -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="icon" href="{{ asset('assets/images/logo4.png') }}">
</head>
<style>
    .showres {
        position: fixed;
        margin-top: 229px;
        margin-left: 148px;
        width: 24%;
        background: white;
        padding: 10px;
        display: none;
    }

    label.lbl {
    font-size: 14px;
    color: gray;
    }

    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>

<body>

        <header class="header sticky-top">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg w-100">
                        <a class="navbar-brand" href="{{ auth()->check() && Auth::user()->role_id != 1 ? url('/profile/home') : url('/') }}">
                            {{-- <img src="{{ asset('assets/images/logo1.png') }}" height="70px" alt=""> --}}
                            <img src="{{ asset('assets/images/logo4.png') }}" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <form autocomplete="off" method="GET" action="{{ url('search') }}"
                            class="search-form form-inline my-2 my-lg-0 position-relative">

                            <div class="autocomplete">
                                @if (Session::get('weblangauge') == 'kn')
                                    <input required autocomplete="off" name="keyword" class="form-control mr-sm-2 search-bar"
                                        type="text" placeholder="खोज">
                                @else
                                    <input required autocomplete="off" name="keyword" class="form-control mr-sm-2 search-bar"
                                        type="text" placeholder="Search">
                                @endif
                            </div>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            <a href="#0" class="form-add-class"></a>
                            <a href="#0" class="form-close">x</a>
                        </form>


                        <div class="showres"></div>



                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                                <ul class=" nav">
                                    <li class="nav-item"> <a class="nav-link active" href="{{ auth()->check() && Auth::user()->role_id != 1 ? url('/profile/home') : url('/') }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.4 14.1"><path d="M4.7 13.3v-2.2a.94.94 0 0 1 1-1h2c.3 0 .5.1.7.3s.3.4.3.7v2.2c0 .2.1.4.3.6s.4.3.6.3H11a2.61 2.61 0 0 0 1.7-.7 2.34 2.34 0 0 0 .7-1.7V5.6c0-.5-.2-1-.6-1.3L8.1.5c-.8-.7-2-.6-2.8.1L.7 4.2A1.75 1.75 0 0 0 0 5.6v6.1c0 1.3 1.1 2.4 2.4 2.4h1.4c.5 0 .9-.4.9-.8h0z" fill="#333"/></svg> Home</a> </li>
                                    <li class="nav-item dropdown"> 
                                        <a class="nav-link dropdown-toggle" href="#" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.7 13.7"><path d="M10.4 12.7c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.6-.1-1.1-.6-1.1-1.1zm-7.7 0c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.7-.1-1.1-.6-1.1-1.1h0zm1.1-2.2c-.4 0-.9-.2-1.2-.5s-.5-.7-.5-1.1l-.6-7.7L.4 1C.1 1 0 .7 0 .4.1.2.3 0 .5 0h.1l1.6.3c.2 0 .4.2.4.5l.1 1.6c0 .2.2.4.4.4h9.3c.4 0 .7.2 1 .5.2.3.3.8.3 1.2L13 9c-.1.9-.9 1.5-1.7 1.5H3.8zm4-4.7a.47.47 0 0 0 .5.5h1.9a.47.47 0 0 0 .5-.5.47.47 0 0 0-.5-.5H8.3a.47.47 0 0 0-.5.5z" fill="#333"/></svg> Cart</a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                            <a class="dropdown-item" href="#">My Interest</a>
                                            <a class="dropdown-item" href="#">My Order</a>
                                        </div>
                                    </li>
                                    <li class="nav-item user"> <a class="nav-link" href="#">
                                        <div class="icon d-none d-lg-block"><img src="assets/images/user-icon.svg" alt="" /></div>
                                        <span class="d-block d-lg-none">Register</span>
                                    </a></li>
                                    <li class="nav-item notification"> <a class="nav-link" href="#">
                                        <div class="icon d-none d-lg-block"><img src="assets/images/notification-icon.svg" alt="" /></div>
                                        <span class="d-block d-lg-none">Notification</span></a>
                                    </li>
                                    <li class="nav-item dropdown lang"> <a class="nav-link dropdown-toggle" id="language" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <div class="icon d-none d-lg-inline-block"><img src="assets/images/lang-icon.svg" alt="" /></div>
                                        <span class="d-inline-block">EN</span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown more"> <a class="nav-link dropdown-toggle" role="button" id="more" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-inline-lg-block">More</span>
                                        <div class="icon d-none d-lg-inline-block"><img src="assets/images/burger-icon.svg" alt="" /></div>
                                    </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more">
                                            <a class="dropdown-item" href="#">Grievance</a>
                                            <a class="dropdown-item" href="#">Contact Us</a>
                                            <a class="dropdown-item" href="#">About Us</a>
                                            <a class="dropdown-item" href="#">Terms and conditions</a>
                                            <a class="dropdown-item" href="#">Privacy Policy</a>
                                        </div> 
                                    </li>

                                </ul>





                                     

                </div>
            



                </nav>
            </div>
            </div>
        </header>
  

    <!--footer-end-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script> -->
    <!-- Datepicker -->
    <!-- Script -->

 

</body>

</html>
