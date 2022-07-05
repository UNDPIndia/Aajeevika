@extends('layouts.header')
@section('title', 'Verify OTP | UNDP')
@section('content')
    <section class="verify-otp">
        <div class="container">
            <div class="otp-inner">
                @if (Session::get('weblangauge') == 'kn')
                    <h2>ओटीपी सत्यापित करें</h2>
                    <h6> {{ $mobile }} को भेजा गया 4 अंकों का ओटीपी दर्ज करें
                    </h6>
                @else
                    <h2>Verify OTP</h2>
                    <h6>Enter 4 digit OTP sent to {{ $mobile }}</h6>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form class="verify-form digit-group" method="post" action="{{ url('verifyotp') }}">
                    @csrf
                    <input type="hidden" name="mobile" value="{{ $mobile }}" />
                    <input type="hidden" name="type" value="{{ $type }}" />
                    <div class="row spesing2">

                        <div class="col-md-3 col-sm-3">
                            <input id="digit-1" type="tel" id="" name="a" placeholder="-" class="form-control inputs"
                                maxlength="1" data-next="digit-2">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input id="digit-2" type="tel" name="b" placeholder="-" class="form-control inputs"
                                maxlength="1" data-next="digit-3" data-previous="digit-1">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input id="digit-3" type="tel" name="c" placeholder="-" class="form-control inputs"
                                maxlength="1" data-next="digit-4" data-previous="digit-2">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input id="digit-4" type="tel" name="d" placeholder="-" class="form-control inputs"
                                maxlength="1" data-previous="digit-3">
                        </div>
                    </div>
                    <h6 id="countdown_id">Remaining: 30 sec</h6>


                    <div class="btn-block resend " data-val="{{ $mobile }}" style="display:none">

                        @if (Session::get('weblangauge') == 'kn')
                            <a href="javascript:void(0)" class="them-btn resendOtp">ओटीपी पुनः भेजें</a>
                        @else
                            <a href="javascript:void(0)" class="them-btn resendOtp">Resend OTP</a>
                        @endif

                    </div>


                    <div class="btn-block verifyOtp">

                        @if (Session::get('weblangauge') == 'kn')
                            <input type="submit" name="" value="सत्यापित करें" class="them-btn">
                        @else
                            <input type="submit" name="" value="Verify" class="them-btn">
                        @endif
                    </div>


                </form>







                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                    euismod bibendum laoreet</p> --}}
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                //alert('asdf');
                var parent = $($(this).parent().parent().parent());
                if (e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));
                    if (prev.length) {
                        $(prev).select();
                    }
                } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (
                        e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));

                    console.log($(this).data('next'));

                    if (next.length) {
                        $(next).select();
                    } else {
                        if (parent.data('autosubmit')) {
                            parent.submit();
                        }
                    }
                }
            });
        });

    </script>

    <script>
        var timeLeft = 30;
        var elem = document.getElementById('countdown_id');
        var timerId = setInterval(countdown, 1000);


        $(document).on('click', '.resend', function() {
            var mobile = $(this).attr('data-val');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/resendotp') }}",
                data: {
                    mobile: mobile,
                },
                dataType: "json",

                success: function(data) {
                    console.log(data);
                    location.reload();


                }
            });

        });






        function countdown() {
            if (timeLeft == -1) {
                clearTimeout(timerId);
                doSomething();

            } else {
                elem.innerHTML = 'Remaining: ' + timeLeft + ' sec';
                timeLeft--;
            }
        }

        function doSomething() {
            $('.resend').show();
            $('.verifyOtp').hide();
        }

    </script>
@endsection
