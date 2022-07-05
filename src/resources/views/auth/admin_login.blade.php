@extends('layouts.header')
@section('title', 'Login | UNDP')
@section('content') 
<style>
        .con2 {
            display: none;
        }

        .d2 {
            display: none;
        }

        .s2 {
            display: none;
        }

    </style>
    <div class="main">
        <!-- Verify OTP -->
        <section class="verify-otp style-2">
            <div class="container">
                <div class="otp-inner sytle-2">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="them-img">
                                <img src="{{ url('assets/images/login-blog-1.jpg') }}">
                            </div>
                        </div>
                        <div class="col-md-7">

                            <div class="login">
                                @if (Session::get('weblangauge') == 'kn')
                                    <h2>लॉग इन करें</h2>
                                @else
                                    <h2>Login</h2>
                                    {{-- {{  url()->previous()}} --}}
                                @endif
                                @if (Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                        {{ Session::get('message') }}</p>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all(':message') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                        
                                <form class="verify-form sytle-2 sytle-3" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="row spesing">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                        <input type="text" name="email"  placeholder="ईमेल / फोन नंबर."
                                                            value="{{ old('email') }}" class="form-control">
                                                    @else
                                                        <input type="text" name="email"  placeholder="Email / Phone Number"
                                                            value="{{ old('email') }}" class="form-control">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-in">
                                                @if (Session::get('weblangauge') == 'kn')
                                                    <input id="password" type="Password" name="password"
                                                        placeholder="पासवर्ड" class="form-control">
                                                @else
                                                    <input id="password" type="Password" name="password"
                                                        placeholder="Password" class="form-control">
                                                @endif
                                                <span class="show-pas-btn">
                                                    <a id="togglePassword" href="javascript:void(0)">
                                                        <img src="assets/images/password-icon.svg" class="normal" alt="">
                                                        <img src="assets/images/password-icon2.svg" class="active" alt="">
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="forgot-password">
                                                @if (Session::get('weblangauge') == 'kn')
                                                    <a href="{{ url('forgetpassword') }}">पासवर्ड भूल गया</a>
                                                @else
                                                    <a href="{{ url('forgetpassword') }}">forgot password</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-block">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="submit" name="" value="लॉग इन करें" class="them-btn">
                                        @else
                                            <input type="submit" name="" value="Login" class="them-btn">
                                        @endif
                                    </div>
                                </form>
                                {{-- @dd($input) --}}

                                @if (isset($input['type']))
                                    <p>{{Session::get('weblangauge') == 'kn' ? 'खाता नहीं है? यहां क्लिक करें':"Don't have an account? Click here"}}<a href="{{ url('/register') }}?type={{$input['type']}}&id={{$input['id']}}"> {{Session::get('weblangauge') == 'kn' ? 'रजिस्टर करें':'Register'}}</a></p>
                                @else
                                    <p>{{Session::get('weblangauge') == 'kn' ? 'खाता नहीं है? यहां क्लिक करें':"Don't have an account? Click here"}}<a href="{{ url('/register') }}"> {{Session::get('weblangauge') == 'kn' ? 'रजिस्टर करें':'Register'}}</a></p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     @endsection
    