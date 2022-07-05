@extends('layouts.header')
@section('title', 'Change Password | UNDP')
@section('content')

    <section class="verify-otp">
        <div class="container">
            <div class="otp-inner">
                @if (Session::get('weblangauge') == 'kn')
                    <h2>पासवर्ड रीसेट</h2>
                    <h6>अपना पासवर्ड रीसेट करने के लिए ओटीपी प्राप्त करने के हेतु अपना पंजीकृत मोबाइल नंबर दर्ज करें </h6>
                @else
                    <h2>Reset Password</h2>
                    <h6>Enter registered Mobile number to get otp to <br>reset your password</h6>
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <form class="verify-form sytle-2" action="{{ url('changepassword') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mobile" value="{{ $mobile }}">
                    <input type="hidden" name="otp" value="{{ $otp }}">
                    <div class="row spesing">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-in">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <input type="Password" name="password" placeholder="पासवर्ड" class="form-control">
                                    @else
                                        <input type="Password" name="password" placeholder="Password" class="form-control">
                                    @endif

                                    <span class="show-pas-btn"><a href="#0"><img src="{{asset('assets/images/password-icon.svg')}}"
                                                class="normal" alt=""> <img src="{{asset('assets/images/password-icon2.svg')}}"
                                                class="active" alt=""></a></span>
                                </div>
                            </div>
                            <div class="form-in">
                                @if (Session::get('weblangauge') == 'kn')
                                    <input type="Password" name="password_confirmation" placeholder="पासवर्ड कन्फर्म कीजिये"
                                        class="form-control">
                                @else
                                    <input type="Password" name="password_confirmation" placeholder="Confirm Password"
                                        class="form-control">

                                @endif
                                <span class="show-pas-btn"><a href="#0"><img src="{{asset('assets/images/password-icon.svg')}}"
                                            class="normal" alt=""> <img src="{{asset('assets/images/password-icon2.svg')}}"
                                            class="active" alt=""></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-block">
                        @if (Session::get('weblangauge') == 'kn')
                            <input type="submit" name="" value="अभी लॉगिन करें" class="them-btn">
                        @else
                            <input type="submit" name="" value="Login Now" class="them-btn">
                        @endif
                    </div>
                </form>
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet</p> --}}
            </div>
        </div>
    </section>
