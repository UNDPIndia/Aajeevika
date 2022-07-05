{{--
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
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                                @if (Session::get('weblangauge') == 'kn')
                                    <h2>ನೋಂದಾಯಿಸಿ</h2>
                                @else
                                    <h2>Register</h2>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all(':message') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif


                                @if (Session::get('weblangauge') == 'kn')
                                    <form class="verify-form sytle-2 style-3" method="POST"
                                        action="{{ route('register') }}">
                                        @csrf
                                        <div class="row spesing">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="role_id" class="form-control changeType">
                                                            <option value="">-ಪ್ರಕಾರವನ್ನು ಆರಿಸಿ -</option>
                                                            <option value="1">User</option>
                                                            <option value="3">SHG</option>
                                                            <option value="2">Artisan</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="name" value="{{ old('name') }}" required
                                                            autofocus placeholder="ಹೆಸರು" class="form-control">



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" value="{{ old('email') }}"
                                                            required placeholder="ಇಮೇಲ್ ಐಡಿ" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input minlength="10" maxlength="10" type="tel" name="mobile"
                                                            required placeholder="ಮೊಬೈಲ್ ಸಂ." class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password" type="Password" name="password" required
                                                            placeholder="ಪಾಸ್ವರ್ಡ್" class="form-control">
                                                        <span class="show-pas-btn"><a id="togglePassword" href="#0"><img
                                                                    src="assets/images/password-icon.svg" class="normal"
                                                                    alt=""><img src="assets/images/password-icon2.svg"
                                                                    class="active" alt=""></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password_conf" type="Password"
                                                            name="password_confirmation" required
                                                            placeholder="ಪಾಸ್ವರ್ಡ್ ದೃಢಪಡಿಸಿ" class="form-control">
                                                        <span class="show-pas-btn"><a id="togglePassword_conf"
                                                                href="#0"><img src="assets/images/password-icon.svg"
                                                                    class="normal" alt=""><img
                                                                    src="assets/images/password-icon2.svg" class="active"
                                                                    alt=""></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="country_id" class="form-control con">
                                                            <option value="101">ಭಾರತ</option>
                                                        </select>

                                                        <select required name="country_id" class="form-control con2">
                                                            <option value="101">-Select Country-</option>

                                                            @php
                                                                $condata = \App\Country::get();
                                                            @endphp
                                                            @foreach ($condata as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="state_id" class="form-control state">
                                                            <option value="17">ಕರ್ನಾಟಕ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">




                                                        <select name="district" class="form-control district d1">
                                                            @php
                                                                $cityData = \App\City::where(['state_id' => 17])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_kn }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                        <select name="district" class="form-control district d2">
                                                            @php
                                                                $cityData = \App\City::where(['state_id' => 17])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_kn }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                                        name="is_promotional_mail">
                                                    <label class="custom-control-label" for="customCheck">ಪ್ರಚಾರ ಇಮೇಲ್
                                                        ಗಳನ್ನು ಸ್ವೀಕರಿಸಲು ಒಪ್ಪಿಗೆ </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                        name="example1">
                                                    <label class="custom-control-label" for="customCheck2">ನಮ್ಮ <a
                                                            href="#0">ನಿಯಮಗಳು ಮತ್ತು ಷರತ್ತುಗಳು</a> ಹಾಗೂ <a
                                                            href="{{ '/terms' }}">ಗೌಪ್ಯತಾ ನೀತಿಗೆ</a> ಒಪ್ಪಿಗೆ ನೀಡಲು ಸರಿ
                                                        ಗುರುತು ಮಾಡಿ.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="btn-block">
                                                    <input type="submit" name="submit" value="ಸೈನ್ ಅಪ್" class="them-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form class="verify-form sytle-2 style-3" method="POST"
                                        action="{{ route('register') }}">
                                        @csrf


                                        <div class="row spesing">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="role_id" class="form-control changeType" required>
                                                            <option value="">-Select Type -</option>
                                                            <option value="1">User</option>
                                                            <option value="3">SHG</option>
                                                            <option value="2">Artisan</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="name" value="{{ old('name') }}" required
                                                            autofocus placeholder="Your Name" class="form-control">


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  name="email" value="{{ old('email') }}"
                                                            required placeholder="Email Id" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input minlength="10" maxlength="10" type="tel" name="mobile"
                                                            required placeholder="Mobile No." class="form-control"
                                                            value="{{ old('mobile') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password" type="Password" name="password" required
                                                            placeholder="Password" class="form-control">
                                                        <span class="show-pas-btn"><a id="togglePassword" href="#0"><img
                                                                    src="assets/images/password-icon.svg" class="normal"
                                                                    alt=""><img src="assets/images/password-icon2.svg"
                                                                    class="active" alt=""></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password_conf" type="Password"
                                                            name="password_confirmation" required
                                                            placeholder="Confirm Password" class="form-control">
                                                        <span class="show-pas-btn"><a id="togglePassword_conf"
                                                                href="#0"><img src="assets/images/password-icon.svg"
                                                                    class="normal" alt=""><img
                                                                    src="assets/images/password-icon2.svg" class="active"
                                                                    alt=""></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">

                                                        <select required name="country_id" class="form-control con">
                                                            <option value="101">India</option>
                                                        </select>

                                                        <select  name="country_id" class="form-control con2">
                                                            <option value="">-Select Country-</option>

                                                            @php
                                                                $condata = \App\Country::get();
                                                            @endphp
                                                            @foreach ($condata as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="state_id" class="form-control s1 ">
                                                            <option value="17">Karnataka</option>
                                                        </select>

                                                        <select name="state_id" class="form-control state s2">
                                                            <option value="17">Karnataka</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="district" class="form-control  d1">
                                                            @php
                                                                $cityData = \App\City::where(['state_id' => 17])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                        <select name="district" class="form-control district d2">
                                                            @php
                                                                $cityData = \App\City::where(['state_id' => 17])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>


                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck" name="is_promotional_mail">
                                                    <label class="custom-control-label" for="customCheck">Agree to get
                                                        promotional emails.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input required type="checkbox" class="custom-control-input"
                                                        id="customCheck2" name="example1">
                                                    <label class="custom-control-label" for="customCheck2">Check to agree
                                                        with
                                                        our <a href="#0">Terms & Conditions</a> and <a href="#0">Privacy
                                                            Policy</a>.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="btn-block">
                                                    <input type="submit" name="submit" value="Sign Up" class="them-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </form>




                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.changeType').change(function() {
            var type = $(this).val();
            if (type == 1) {
                $('.con').hide();
                $('.con2').show();
                $('.d1').hide();
                $('.d2').show();

                $('.s1').hide();
                $('.s2').show();


            } else {
                $('.con').show();
                $('.con2').hide();
                $('.d1').show();
                $('.d2').hide();
                $('.s1').show();
                $('.s2').hide();
            }
        });



        $('.con2').change(function() {
            var country_id = $(this).val();
            $('.state').empty();
            $('.state').append(' <option value="">--Select state--</option>');
            $('.district').empty();
            $('.district').append(' <option value="">--Select District--</option>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/getstate') }}",
                data: {
                    country_id: country_id,
                },
                dataType: "json",

                success: function(data) {
                    $.each(data.data.states, function(i, obj) {
                        console.log(obj.name);
                        var div_data = "<option value=" + obj.id + ">" + obj.name + "</option>";
                        $(div_data).appendTo('.state');


                    });


                }
            });
        });

        $('.state').change(function() {

            var id = $(this).val();

            $('.district').empty();
            $('.district').append(' <option value="">--Select District--</option>');
            $.ajax({
                type: 'POST',
                url: '/api/get_city',
                data: {
                    state_id: id
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'app-key': 'laravelUNDP'
                },

                success: function(data) {
                    $.each(data.data.district, function(i, obj) {
                        console.log(obj.name);
                        var div_data = "<option value=" + obj.id + ">" + obj.name + "</option>";
                        $(div_data).appendTo('.district');
                    });
                }
            });
        });

    </script>
--}}