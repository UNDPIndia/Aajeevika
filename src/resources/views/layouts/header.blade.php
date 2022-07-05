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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
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






/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>

<body>

    @if(Session::has('weblangauge'))
    @else
    @php Session::put('weblangauge', 'en'); @endphp
    @endif
    <!--header-start-->
    @if (app('request')->input('type') != 'mobile')


    <header class="header sticky-top">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg w-100">
                        @if(auth()->check() && Auth::user()->role_id == 9)
                            <a class="navbar-brand" href="{{ url('/ind-home') }}">
                                <img src="{{ asset('assets/images/logo4.png') }}" alt="">
                            </a>
                        @else
                        <a class="navbar-brand" href="{{ auth()->check() && Auth::user()->role_id != 1 ? url('/profile/home') : url('/') }}">
                            <img src="{{ asset('assets/images/logo4.png') }}" alt="">
                        </a>
                        @endif
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        @if(auth()->check() && Auth::user()->role_id == 9)
                        @else
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
                        @endif

                        <div class="showres"></div>



                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                                <ul class=" nav">
                                    <li class="nav-item">
                                        <?php 
                                        if(auth()->check()){
                                            if(Auth::user()->role_id == 9){
                                                $homeUrl = '/ind-home';
                                            }elseif(Auth::user()->role_id == 1){
                                                $homeUrl = '/';
                                            }else{
                                                $homeUrl = '/profile/home';
                                            }
                                        }else{
                                            $homeUrl = '/';
                                        }
                                        ?>
                                         <a class="nav-link active" href="{{ $homeUrl}}">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.4 14.1">
                                             <path d="M4.7 13.3v-2.2a.94.94 0 0 1 1-1h2c.3 0 .5.1.7.3s.3.4.3.7v2.2c0 .2.1.4.3.6s.4.3.6.3H11a2.61 2.61 0 0 0 1.7-.7 2.34 2.34 0 0 0 .7-1.7V5.6c0-.5-.2-1-.6-1.3L8.1.5c-.8-.7-2-.6-2.8.1L.7 4.2A1.75 1.75 0 0 0 0 5.6v6.1c0 1.3 1.1 2.4 2.4 2.4h1.4c.5 0 .9-.4.9-.8h0z" fill="#333"/>
                                            </svg> <?php echo (Session::get('weblangauge') == 'kn')?'होम':'Home' ?>
                                        </a> 
                                    </li>
                                    @if (auth()->check())
                                        @if(Auth::user()->role_id == 1)
                                        <li class="nav-item dropdown"> 
                                            <a class="nav-link dropdown-toggle" href="#" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.7 13.7"><path d="M10.4 12.7c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.6-.1-1.1-.6-1.1-1.1zm-7.7 0c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.7-.1-1.1-.6-1.1-1.1h0zm1.1-2.2c-.4 0-.9-.2-1.2-.5s-.5-.7-.5-1.1l-.6-7.7L.4 1C.1 1 0 .7 0 .4.1.2.3 0 .5 0h.1l1.6.3c.2 0 .4.2.4.5l.1 1.6c0 .2.2.4.4.4h9.3c.4 0 .7.2 1 .5.2.3.3.8.3 1.2L13 9c-.1.9-.9 1.5-1.7 1.5H3.8zm4-4.7a.47.47 0 0 0 .5.5h1.9a.47.47 0 0 0 .5-.5.47.47 0 0 0-.5-.5H8.3a.47.47 0 0 0-.5.5z" fill="#333"/></svg> {{Session::get('weblangauge') == 'kn' ? 'कार्ट':'Cart'}}</a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                                <a class="dropdown-item" href="{{ url('/buyer-interest-list') }}"><?php echo (Session::get('weblangauge') == 'kn')?'मेरी रूचि':'My Interest' ?></a>
                                                <a class="dropdown-item" href="{{ url('/buyer-order-list') }}"><?php echo (Session::get('weblangauge') == 'kn')?'मेरी बिक्री':'My Orders' ?></a>
                                            </div>
                                        </li>
                                       
                                        @elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8 )
                                        <li class="nav-item dropdown"> 
                                            <a class="nav-link dropdown-toggle" href="#" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.7 13.7"><path d="M10.4 12.7c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.6-.1-1.1-.6-1.1-1.1zm-7.7 0c0-.6.5-1 1.1-1s1 .5 1 1.1-.5 1-1 1c-.7-.1-1.1-.6-1.1-1.1h0zm1.1-2.2c-.4 0-.9-.2-1.2-.5s-.5-.7-.5-1.1l-.6-7.7L.4 1C.1 1 0 .7 0 .4.1.2.3 0 .5 0h.1l1.6.3c.2 0 .4.2.4.5l.1 1.6c0 .2.2.4.4.4h9.3c.4 0 .7.2 1 .5.2.3.3.8.3 1.2L13 9c-.1.9-.9 1.5-1.7 1.5H3.8zm4-4.7a.47.47 0 0 0 .5.5h1.9a.47.47 0 0 0 .5-.5.47.47 0 0 0-.5-.5H8.3a.47.47 0 0 0-.5.5z" fill="#333"/></svg> {{Session::get('weblangauge') == 'kn' ? 'कार्ट':'Cart'}}</a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cart">
                                                <a class="dropdown-item" href="{{ url('/seller-interest-list') }}"><?php echo (Session::get('weblangauge') == 'kn')?'मेरी रूचि':'My Interest' ?></a>
                                                <a class="dropdown-item" href="{{ url('/seller-order-list') }}"><?php echo (Session::get('weblangauge') == 'kn')?'मेरी बिक्री':'My Orders' ?></a>
                                                @if(Auth::user()->role_id == 2)
                                                <a class="dropdown-item" href="{{ url('/buy-manager') }}"><?php echo (Session::get('weblangauge') == 'kn')?'खरीदना':'Buy' ?></a>
                                                @endif
                                            </div>
                                        </li>
                                        
                                        @endif
                                    @endif
                                   
                                    <li class="nav-item user dropdown"> 
                                        <a class="nav-link dropdown-toggle" href="#" id="userlogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="icon d-none d-lg-block"><img src="{{ asset('/public/assets/images/user-icon.svg') }}" alt="" /></div>
                                        <span class="d-block d-lg-none"><?php echo (Session::get('weblangauge') == 'kn')?'प्रोफ़ाइल':'Profile' ?></span></a>
                                        @if (!auth()->check())
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userlogin">
                                                <a class="dropdown-item" href="{{ url('/login') }}"><?php echo (Session::get('weblangauge') == 'kn')?'लॉग इन करें':'Login' ?></a>
                                                <a class="dropdown-item" href="{{ url('/register') }}"><?php echo (Session::get('weblangauge') == 'kn')?'रजिस्टर करें':'Register' ?></a>
                                        </div>
                                        @endif
                                        @if (auth()->check())
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userlogin">
                                                <a class="dropdown-item" href="{{ url('/profile') }}"><?php echo (Session::get('weblangauge') == 'kn')?'प्रोफ़ाइल देखें':'View Profile' ?></a>
                                                @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8 )
                                                <a class="dropdown-item" href="{{ url('/addproduct') }}"><?php echo (Session::get('weblangauge') == 'kn')?'नया उत्पाद जोड़ें':'Add New Product' ?></a>
                                                <a class="dropdown-item" href="{{ url('/profile/home') }}"><?php echo (Session::get('weblangauge') == 'kn')?'उत्पाद देखें':'View Product' ?></a>
                                                @endif
                                                <a class="dropdown-item" href="{{ url('/logout') }}"><?php echo (Session::get('weblangauge') == 'kn')?'लॉग आउट':'Logout' ?></a>

                                            </div>
                                        @endif
                                </li>
                                    <li class="nav-item notification"> <a class="nav-link" href="#" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="icon d-none d-lg-block"><img src="{{ asset('/public/assets/images/notification-icon.svg') }}" alt="" /></div>
                                        <span class="d-block d-lg-none"><?php echo (Session::get('weblangauge') == 'kn')?'सूचनाएं':'Notification' ?></span></a>
                                        <div class="userReg userReg-notification" >
                    <ul class="d-flex flex-wrap justify-content-start">




                        @if (auth()->check())
                            @php

                                $user = Auth::user();
                                //echo $user->role_id;
                                if (Session::get('weblangauge') == 'kn') {
                                    $language = 'kn';
                                } else {
                                    $language = 'en';
                                }
                                $notification = \App\Notification::where(['language' => $language, 'role_id' => $user->role_id, 'status' => 1])
                                    ->select('id', 'title', 'body', 'image', 'role_id', 'language')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
                                //print_r($notification);
                                // $notification = \App\Notification::where(['language' => $language, 'role_id' => $user->role_id, 'status' => 1])
                                //     ->select('id', 'title', 'body', 'image', 'role_id', 'language')
                                //     ->paginate(10);

                                $notification_count = $notification->count();
                            @endphp

                            

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notification">
                                    @if ($notification_count > 0)
                                        @foreach ($notification as $item)

                                            <div
                                                class='lehangas-product-inner d-flex align-items-center notification-outer mb-2'>
                                                <div class='lehanga-img'>
                                                    
                                                        <img src='{{ asset($item->image) }}'
                                                            alt='lehanga-img1' />
                                                </div>
                                                <div class='lehanga-right'>
                                                   
                                                        <p class='item-info'>{{ $item->title }}</p>
                                                   
                                                    <p><strong>{{ $item->body }}</strong></p>
                                                </div>
                                            </div>

                                        @endforeach

                                    @else

                                        <div
                                            class='lehangas-product-inner d-flex align-items-center notification-outer'>
                                            <div class='lehanga-img'>
                                                <a href='{{ url('/') }}'>
                                                </a>
                                            </div>
                                            <div class='lehanga-right'>
                                                <a href='{{ url('/') }}'>
                                                    {{-- <p class='item-info'>No item Found</p> --}}
                                                </a>
                                                <p><strong>{{Session::get('weblangauge') == 'kn' ? 'अधिसूचना नहीं मिली!':'Notification not found!'}}</strong></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            

                        @endif

                        @php
                            //dd($notification);
                        @endphp
                    </ul>
                </div>
                                    </li>
                                    
                                    <li class="nav-item dropdown lang"> <a class="nav-link dropdown-toggle" id="language" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <div class="icon d-none d-lg-inline-block"><img src="{{ asset('/public/assets/images/lang-icon.svg') }}" alt="" /></div>
                                        <span class="d-inline-block"><?php echo (Session::get('weblangauge') == 'kn')?'हिंदी':'ENG' ?></span></a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
                                            <a class="dropdown-item" href="{{ url('/en') }}">ENG</a>
                                            <a class="dropdown-item" href="{{ url('/kn') }}">हिंदी</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown more"> <a class="nav-link dropdown-toggle" role="button" id="more" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-inline-lg-block">{{Session::get('weblangauge') == 'kn' ? 'अतिरिक्त':'More'}}</span>
                                        <div class="icon d-none d-lg-inline-block"><img src="{{ asset('/public/assets/images/burger-icon.svg') }}" alt="" /></div>
                                    </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="more">
                                            @if (auth()->check()) @if(Auth::user()->role_id == 9) 
                                            <a class="dropdown-item" href="{{ url('/ind-order-list')}}">{{Session::get('weblangauge') == 'kn' ? 'मेरी बिक्री':'My Sales'}}</a>
                                            <a class="dropdown-item" href="{{ url('/take-survey')}}">{{Session::get('weblangauge') == 'kn' ? 'एक सर्वेक्षण ले':'Take a Survey'}}</a>
                                            <a class="dropdown-item" href="{{ url('/my-interest')}}">{{Session::get('weblangauge') == 'kn' ? 'मेरी उत्पाद':'My Product'}}</a>
                                            <a class="dropdown-item" href="{{ url('/ind-chat')}}">{{Session::get('weblangauge') == 'kn' ? 'मेरी बातचीत':'My Chat'}}</a>
                                            <a class="dropdown-item" href="{{ url('/faq')}}">{{Session::get('weblangauge') == 'kn' ? "सामान्य प्रश्न":"FAQ's"}}</a>
                                            @endif 
                                            @if(Auth::user()->role_id == 2)
                                            <a class="dropdown-item" href="{{ url('/shg-individuals')}}">{{Session::get('weblangauge') == 'kn' ? 'एसएचजी व्यक्तिगत':'SHG Individuals'}}</a>
                                            @endif
                                            @endif
                                            <a class="dropdown-item" href="{{ url('/grievance')}}">{{Session::get('weblangauge') == 'kn' ? 'शिकायत':'Grievance'}}</a>

                                            <a class="dropdown-item" href="{{ url('/contact-us')}}">{{Session::get('weblangauge') == 'kn' ? 'संपर्क करें':'Contact Us'}}</a>
                                            <a class="dropdown-item" href="{{ url('/terms')}}">{{Session::get('weblangauge') == 'kn' ? 'हमारे बारे में':'About Us'}}</a>
                                            <a class="dropdown-item" href="{{ url('/terms')}}">{{Session::get('weblangauge') == 'kn' ? 'नियम और शर्तें':'Terms and conditions'}}</a>
                                            <a class="dropdown-item" href="{{ url('/privacy-policy')}}">{{Session::get('weblangauge') == 'kn' ? 'गोपनीयता नीति':'Privacy Policy'}}</a>
                                        </div> 
                                    </li>

                                </ul>





                                     

                </div>
            



                </nav>
            </div>
            </div>
        </header>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong> {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger" id="error-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Error! </strong> {{ session()->get('error') }}
        </div>
    @endif
    <section class='wrap'>
        @yield('content')
    </section>
    <!--footer-start-->
    @if (app('request')->input('type') != 'mobile')


        @if (Session::get('weblangauge') == 'kn')


            <footer>
                <div class="top_foot">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pb-sm-3">
                                <div class="foot_title">
                                महत्वपूर्ण लिंक
                                </div>
                                <ul class="connect">
                                    <li><a href="{{ url('/') }}">घर</a></li>
                                    <li><a href="{{ url('privacy-policy') }}">गोपनीयता नीति</a></li>
                                    <li><a href="{{ url('/terms') }}">नियम और शर्तें</a></li>
                                    <li><a href="#">अस्वीकरण</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4 pb-sm-3">
                                <div class="foot_title">
                                संपर्क करें
                                </div>
                                <ul class="connect">
                                    <li><a href="#">samplemail@gamil.com</a></li>
                                    <li><a href="#">+91-000000000</a></li>
                                    <li><a href="#">+91-000000000</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="foot_title">
                                हमारा अनुसरण करें
                                </div>
                                <ul class="follow">
                                    <li><a href="#0"><img src="{{ asset('assets/images/facebook.svg') }}"
                                                alt="facebook"> </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/instagram.svg') }}"
                                                alt="instagram"> </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/twitter.svg') }}"
                                                alt="twitter">
                                        </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/linkedin.svg') }}"
                                                alt="linkedin"> </a></li>
                                </ul>
                                <!-- <ul class="connect">

                                    <li><a href="{{ url('/blogkn/home') }}">हमारे ब्लॉग</a></li>



                                </ul> -->
                            </div>



                        </div>
                    </div>
                </div>
                <div class="bot_foot text-center">
                    <div class="container-fluid">
                        <div class="row text-center">
                            <span class="copy_right">कॉपीराइट © 2021 यूएनडीपी। सर्वाधिकार सुरक्षित.</span>
                        </div>
                    </div>
                </div>
            </footer>
        @else

            {{-- <footer>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <p class="copy-right">Copyright &copy; {{ date('Y') }} UNDP. All Right Reserved.</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="footer-menu">
                                <!-- <li><a href="{{ url('/blog') }}">Blog</a></li> -->
                                <li><a href="{{ url('/terms') }}">Terms and Conditions</a></li>
                                <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> --}}


            <footer>
                <div class="top_foot">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 pb-sm-3">
                                <div class="foot_title">
                                    Important Links
                                </div>
                                <ul class="connect">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ url('/terms') }}">Terms and Conditions</a></li>
                                    <li><a href="{{ url('/disclaimer') }}">Disclaimer</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4 pb-sm-3">
                                <div class="foot_title">
                                    Contact us
                                </div>
                                <ul class="connect">
                                    <li><a href="mailto:shguttarakhandundp@gmail.com">shguttarakhandundp@gmail.com</a></li>
                                    {{-- <li><a href="#">+91-000000000</a></li>
                                    <li><a href="#">+91-000000000</a></li> --}}
                                </ul>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="foot_title">
                                    Follow us
                                </div>
                                <ul class="follow">
                                    <li><a href="#0"><img src="{{ asset('assets/images/facebook.svg') }}"
                                                alt="facebook"> </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/instagram.svg') }}"
                                                alt="instagram"> </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/twitter.svg') }}"
                                                alt="twitter">
                                        </a></li>
                                    <li><a href="#0"><img src="{{ asset('assets/images/linkedin.svg') }}"
                                                alt="linkedin"> </a></li>
                                </ul>
                                <ul class="connect">
                                    <!-- <li><a href="{{ url('/blog/home') }}">Our Blogs</a></li> -->



                                </ul>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="bot_foot text-center">
                    <div class="container-fluid">
                        <div class="row text-center">
                            <span class="copy_right">Copyright © 2021 UNDP. All Right Reserved</span>
                        </div>
                    </div>
                </div>
            </footer>

        @endif


    @endif
    <div class="loading bg-loader" style="display:none">&#8230;</div>
    <!--footer-end-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- Datepicker -->
    <!-- Script -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" />
    <script>
        $('.datepicker').datepicker().on('changeDate', function(e) {
            $(this).datepicker('hide');
        });

    </script>
    <!-- Form Validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('dist/js/form.validation.js') }}"></script>

    <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.3/firebase-app.js"></script>

    <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
    <script src="https://www.gstatic.com/firebasejs/8.2.3/firebase-analytics.js"></script>

    <!-- Add Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/8.2.3/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.3/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.3/firebase-messaging.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        // var Tawk_API = Tawk_API || {},
        //     Tawk_LoadStart = new Date();
        // (function() {
        //     var s1 = document.createElement("script"),
        //         s0 = document.getElementsByTagName("script")[0];
        //     s1.async = true;
        //     s1.src = 'https://embed.tawk.to/6023f91a9c4f165d47c1f2ab/1eu68a43k';
        //     s1.charset = 'UTF-8';
        //     s1.setAttribute('crossorigin', '*');
        //     s0.parentNode.insertBefore(s1, s0);
        // })();

    </script>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/60b2418fde99a4282a1a448c/1f6s506hd';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <!--End of Tawk.to Script-->

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyBrX5D36yCL0kjSxWkKuFfl04_NjknGhf0",
            authDomain: "undp-26448.firebaseapp.com",
            projectId: "undp-26448",
            storageBucket: "undp-26448.appspot.com",
            messagingSenderId: "366046427858",
            appId: "1:366046427858:web:009b1814c672749d4b8b0b",
            measurementId: "G-GYJMTES635"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();

        const messaging = firebase.messaging();
        messaging.requestPermission().then(function() {
            console.log("Notification permission granted.");
            return messaging.getToken()
        }).then(function(token) {
            console.log("token is : " + token)
        }).catch(function(err) {
            console.log("Unable to get permission to notify.", err);
        });

    </script>
    <script>
        $('.popular-product-slider').slick({
            dots: true,
            arrows: false,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        dots: true


                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1.5,
                        slidesToScroll: 1.5
                    }
                }
            ]
        });


        $('.category-product-slider').slick({
            dots: true,
            arrows: false,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true


                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1.5,
                        slidesToScroll: 1.5
                    }
                }
            ]
        });

        // slick recently added slider
        $('.recently-added-slider').slick({
            dots: true,
            arrows: false,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true


                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1.5,
                        slidesToScroll: 1.5
                    }
                }
            ]
        });

    </script>


    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'text' ? 'password' : 'text';
            console.log('clicked');
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const togglePassword_conf = document.querySelector('#togglePassword_conf');
        const password_conf = document.querySelector('#password_conf');
        togglePassword_conf.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password_conf.getAttribute('type') === 'text' ? 'password' : 'text';
            console.log('clicked');
            password_conf.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

    </script>

    <script>
        $(".search-bar").keyup(function() {
            var val = $(this).val();
            if (val != "") {
                $('.showres').show();
            } else {
                $('.showres').hide();
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/searchhome') }}",
                data: {
                    keyword: val,
                },
                dataType: "json",

                success: function(data) {
                    console.log(data);
                    $('.showres').html("");
                    var div_data = data.data.html;

                    if (div_data == "") {
                        div_data =
                            "<div class='row'><div class='col-md-12'><h3 style='text-align: center;margin-top: 25px;'>No result found</h3></div></div>";
                    }

                    $('.showres').append(div_data);



                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {

            $(".form-add-class").click(function() {
                $(".search-form").toggleClass("active");
            });


            $(".form-close").click(function() {
                $(".search-form").removeClass("active");
                $('.showres').html("");
                $('.showres').hide();
                $(".search-bar").val('');

            });


        });


        $(document).mouseup(function(e) {
            var container = $(".showres");

            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
                //$(".search-form").removeClass("active");
                $('.showres').html("");

                $(".search-bar").val('');
            }
        });

        @if (session()->has('success'))
            $("#success-alert").fadeTo(2000, 500).slideUp(1000, function(){
                $("#success-alert").slideUp(1000);
            });
        @endif
        @if (session()->has('error'))
            $("#error-alert").fadeTo(2000, 500).slideUp(1000, function(){
                $("#error-alert").slideUp(1000);
            });
        @endif

        //add fav common
        $(".update-fav").click(function() {
           var seller_id = $('.seller_id').val();
            var val = $(this).val();
           $('.bg-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/update-fav') }}",
                data: {
                    status: val,
                    seller_id: seller_id,
                },
                dataType: "json",

                success: function(data) {
                    $('.bg-loader').hide();
                    location.reload();



                }
            });
        });

        // farm slider shagartisanhome
        $('.farm-slider').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 575,
                settings: {                    
                    slidesToShow: 1.3,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        
    </script>
    <script type="text/javascript">
    $('.chat-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1.5,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
        
</script>




</body>

</html>
