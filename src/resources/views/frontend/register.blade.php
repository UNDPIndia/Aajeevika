@extends('layouts.header')
@section('title', 'Register | UNDP')
@section('content')

<?php
  $session = Session::get('weblangauge');
  //echo $session;die;
?>
    <div class="main">
        <!-- Verify OTP -->
        <section class="verify-otp style-2">
            <div class="container">
                <div class="otp-inner sytle-2 sytle-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="them-img">
                                <img src="assets/images/login-blog-1.jpg">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="login">
                                <h2>Register</h2>
                                <form class="verify-form sytle-2 style-3" method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row spesing">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <input type="text" name="name" placeholder="Your Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <input type="email" name="email" placeholder="Email Id" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <input type="number" name="mobile" placeholder="Mobile No."
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <input type="Password" name="password" placeholder="Password"
                                                        class="form-control">
                                                    <span class="show-pas-btn"><a href="#0"><img
                                                                src="assets/images/password-icon.svg" class="normal"
                                                                alt=""><img src="{{ asset('images/password-icon2.svg') }}"
                                                                class="active" alt=""></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <input type="Password" name="confirm_password" placeholder="Confirm Password"
                                                        class="form-control">
                                                    <span class="show-pas-btn"><a href="#0"><img
                                                                src="{{ asset('images/password-icon2.svg') }}" class="normal"
                                                                alt=""><img src="{{ asset('images/password-icon2.svg') }}"
                                                                class="active" alt=""></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <select class="form-control">
                                                        <option>India777</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <select class="form-control">
                                                        <option>Karnataka</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-in">
                                                    <select class="form-control">
                                                        <option>Bangalore</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox mb-3 style-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck">Agree to get
                                                    promotional
                                                    emails.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox mb-3 style-2">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck2">Check to agree with
                                                    our
                                                    <a href="#0">Terms & Conditions</a> and <a href="#0">Privacy
                                                        Policy</a>.</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="btn-block">
                                                <input type="submit" name="" value="Sign Up" class="them-btn">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
