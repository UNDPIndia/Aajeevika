<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>UK</b>UNDP</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif


                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" placeholder="Email "
                        value="{{ old('email') }}" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="Password" name="password" placeholder="Password"
                        class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    {{-- <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a> --}}
                </div>
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/') }}/dist/js/adminlte.min.js"></script>
</body>

</html>


{{-- Old Code Below here --}}

{{--

<div class="main">

    <!-- Verify OTP -->
    <section class="verify-otp style-2">
        <div class="container">
            <div class="otp-inner sytle-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="them-img">
                            <img src="assets/images/login-blog-1.jpg">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="login">
                            <h2>Login</h2>
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
                                                <input type="tel" name="email" placeholder="Email / Phone Number"
                                                    value="{{ old('email') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-in">
                                            <input type="Password" name="password" placeholder="Password"
                                                class="form-control">
                                            <span class="show-pas-btn">
                                                <a href="#0">
                                                    <img src="assets/images/password-icon.svg" class="normal" alt="">
                                                    <img src="assets/images/password-icon2.svg" class="active" alt="">
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- <div class="forgot-password"><a href="{{url('forgetpassword')}}">forgot password</a></div> --}}
                                    </div>
                                </div>
                                {{-- <div class="btn-block">
                                    <input type="submit" name="" value="Login" class="them-btn">
                                </div> --}}
                            </form>

                            {{-- Auth Login --}}

                            {{-- <form action="{{ route('login') }}" method="post">
                                    @csrf
                                  <div class="input-group mb-3">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address" >
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                      </div>
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                  </div>
                                  <div class="input-group mb-3">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password">
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                      </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div class="row">
                          
                                    <!-- /.col -->
                                    <div class="btn-block">
                                      <button type="submit" class="them-btn">Login</button>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                </form> --

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

--}}
