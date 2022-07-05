@extends('layouts.header')
@section('title', 'Home | UNDP')
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
                <div class="otp-inner sytle-2 sytle-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="them-img">
                                <img src="{{ asset('assets/images/login-blog-1.jpg') }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="login">
                                @if (Session::get('weblangauge') == 'kn')
                                    <h2>रजिस्टर करें</h2>
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
                                        action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off" id="signUpForm">
                                        @csrf
                                        <div class="row spesing">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="role_id" class="form-control changeType changedivs">
                                                            <option value="">-प्रकार चुनें -</option>
                                                            <option value="1">Buyer</option>
                                                            <option value="3">SHG Enterprise</option>
                                                            <option value="2">CLF</option>
                                                            <option value="7">Saras Centre</option>
                                                            <option value="8">Growth Centre</option>
                                                            <option value="9">SHG Individual</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="organization_name" value="{{ old('organization_name') }}" 
                                                             placeholder="आपके संगठन का नाम" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;" >
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select class="form-control" name="member_designation">
                                                           <option value="President">President</option>
                                                           <option value="Secretary">Secretary</option> 
                                                           <option value="Treasurer">Treasurer</option> 
                                                           <option value="Book Keeper">Book Keeper</option> 
                                                           <option value="Member">Member</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="name" value="{{ old('name') }}" required
                                                            autofocus placeholder="आपका नाम" class="form-control">



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="email"  name="email" value="{{ old('email') }}"
                                                             placeholder="ईमेल आईडी" id="email_idd" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="number" name="member_id" value="{{ old('member_id') }}"
                                                             placeholder="Member Id" class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input minlength="10" maxlength="10" type="number" name="mobile"
                                                             placeholder="मोबाइल नंबर." class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password" type="Password" name="password" required
                                                            placeholder="पासवर्ड" class="form-control">
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
                                                            placeholder="पासवर्ड की पुष्टि कीजिये" class="form-control">
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
                                                            <option value="101">भारत</option>
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
                                                            <option value="39">उत्तराखण्ड</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">




                                                        <select name="district" class="form-control districtt d1">
                                                            @php
                                                                $cityData = \App\City::where(['is_district' => 1 , 'state_id' => 39])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_kn }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                        {{-- <select name="district" class="form-control district d2">
                                                            @php
                                                                $cityData = \App\City::where(['is_district' => 1 , 'state_id' => 17])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 user-block">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="block" class="form-control blockk d1" required>
                                                            @php
                                                                $cityData = \App\Block::where(['city_id' => '5219'])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name_kn }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind img-file" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">

                                                      <input type="file" name="profileImage" class="form-control" >

                                                    </div>
                                                </div>
                                            </div>



                                            {{-- <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                                        name="is_promotional_mail">
                                                    <label class="custom-control-label" for="customCheck">प्राप्त करने के लिए सहमत
                                                        प्रचार ईमेल।</label>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                        name="example1">
                                                    <label class="custom-control-label" for="customCheck2"><a
                                                            href="#0">सहमत होने के लिए जांचें
                                                        साथ
                                                        हमारी</a> नियम एवं शर्तें तथा <a
                                                            href="{{ '/terms' }}">गोपनीयता
                                                            नीति</a> </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="btn-block">
                                                    <input type="submit" name="submit" value="साइन अप करें" class="them-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form class="verify-form sytle-2 style-3 sign_upform" method="POST"
                                        action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off" id="signUpForm">
                                        @csrf


                                        <div class="row spesing">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="role_id" class="form-control changeType changedivs" id="role_id">
                                                            <option value="">-Select Type - *</option>
                                                            <option value="1">Buyer</option>
                                                            <option value="3">SHG Enterprise</option>
                                                            <option value="2">CLF</option>
                                                            <option value="7">Saras Centre</option>
                                                            <option value="8">Growth Centre</option>
                                                            <option value="9">SHG Individual</option>
                                                           

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="organization_name" value="{{ old('organization_name') }}" 
                                                            autofocus placeholder="Your Organization Name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;" >
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select class="form-control" name="member_designation">
                                                           <option value="President">President</option>
                                                           <option value="Secretary">Secretary</option> 
                                                           <option value="Treasurer">Treasurer</option> 
                                                           <option value="Book Keeper">Book Keeper</option> 
                                                           <option value="Member">Member</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="text" name="name" value="{{ old('name') }}" id="name"
                                                            autofocus placeholder="Your Name *" class="form-control nameclass">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="email" id="email_idd"   name="email" value="{{ old('email') }}"
                                                             placeholder="Email Id" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input type="number"  name="member_id" value="{{ old('member_id') }}"
                                                             placeholder="Member Id" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input minlength="10" maxlength="10" type="number" name="mobile"
                                                            id="mobile" placeholder="Mobile No. *" class="form-control"
                                                            value="{{ old('mobile') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password" type="Password" name="password" 
                                                            placeholder="Password *" class="form-control pass">
                                                        <span class="show-pas-btn"><a id="togglePassword" href="#0"><img
                                                                    src="{{ asset('assets/images/password-icon.svg') }}" class="normal"
                                                                    alt=""><img src="{{ asset('assets/images/password-icon2.svg') }}"
                                                                    class="active" alt=""></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <input id="password_conf" type="Password"
                                                            name="password_confirmation"
                                                            placeholder="Confirm Password *" class="form-control cpass">
                                                        <span class="show-pas-btn"><a id="togglePassword_conf"
                                                                href="#0"><img src="{{ asset('assets/images/password-icon.svg') }}"
                                                                    class="normal" alt=""><img
                                                                    src="{{ asset('assets/images/password-icon2.svg') }}" class="active"
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

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="state_id" class="form-control s1 ">
                                                            <option value="39">Uttarakhand</option>
                                                        </select>

                                                        <select name="state_id" class="form-control state s2">
                                                            <option value="39">Uttarakhand</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="district" class="form-control district d1">
                                                            @php
                                                                $cityData = \App\City::where(['is_district' => 1,'state_id' => 39])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                        {{-- <select name="district" class="form-control  d2">
                                                            @php
                                                                $cityData = \App\City::where(['is_district' => 1,'state_id' => 39])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select> --}}


                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6 user-block">
                                                <div class="form-group">
                                                    <div class="form-in">
                                                        <select name="block" class="form-control block  d1" required>
                                                            @php
                                                                $cityData = \App\Block::where(['city_id' => '5219'])->get();
                                                            @endphp
                                                            @foreach ($cityData as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 clf shg-ind img-file" style="display:none;">
                                                <div class="form-group">
                                                    <div class="form-in">

                                                      <input type="file" name="profileImage" class="form-control" >

                                                    </div>
                                                </div>
                                            </div>



                                            {{-- <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck" name="is_promotional_mail">
                                                    <span class="custom-control-label" for="customCheck">Agree to get
                                                        promotional emails.</span>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox mb-3 style-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck2" name="example1">
                                                    <label class="custom-control-label" for="customCheck2">Check to agree
                                                        with
                                                        our <a href="#0">Terms & Conditions</a> and <a href="#0">Privacy
                                                            Policy</a>.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="btn-block">
                                                    <input type="submit"  name="submit" value="Sign Up" class="them-btn">
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
    /*    $('.changeType').change(function() {
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
        });   */
        



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
                url: "{{ url('/api/get_city') }}",
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

    <script>

        $(document).on('change','.district',function(){
            var city_id = $(this).val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"{{ url('/blockAjax') }}",
                data:{_token,city_id},
                success:function(response)
                {
                    $('.block').html(response);

                }  


            });

        });

        $(document).on('change','.districtt',function(){
            var city_id = $(this).val();
           // alert(city_id);
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"{{ url('/blockAjaxx') }}",
                data:{_token,city_id},
                success:function(response)
                {
                    $('.blockk').html(response);

                }  


            });

        });


    $(document).on('change','.changedivs',function(){
        var changediv = $(this).val();
        if(changediv == '1') {
            $('.clf').css({'display':'none' });
            $('.user-block').css({'display':'none' });
            $('#email_idd').removeAttr("required");
           // console.log("property remove");
        } 
        else if(changediv == '9') {
                $('.shg-ind').css({'display':'none' });
                $('.user-block').css({'display':'none' });
                $('.img-file').css({'display':'block' });
                $('.nameclass').prop('placeholder','Your Name *');
                $('#email_idd').prop('required','required');
                $('#email_idd').prop('placeholder','Email Id *');
        }
         else {
            $('.clf').css({'display':'block' });
            $('.nameclass').prop('placeholder','Member Name *');
            $('#email_idd').prop('required','required');
            $('#email_idd').prop('placeholder','Email Id *');
            $('.user-block').css({'display':'none' });
        }

    });


</script>
    

@endsection
