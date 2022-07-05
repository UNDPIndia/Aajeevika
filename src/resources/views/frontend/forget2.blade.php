@extends('layouts.header')
@section('title', 'Forget Pass | UNDP')
@section('content')


    <section class="verify-otp">
        <div class="container">
            <div class="otp-inner">
                @if (Session::get('weblangauge') == 'kn')
                    <h2>पासवर्ड भूल गए</h2>
                    <h6>अपना पासवर्ड रीसेट करने के लिए ओटीपी प्राप्त करने के हेतु अपना पंजीकृत मोबाइल नंबर दर्ज करें</h6>


                @else
                    <h2>Forgot Password</h2>
                    <h6>Enter registered Mobile number to get otp to <br>reset your password</h6>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if (Session::get('weblangauge') == 'kn')
                    <form class="verify-form sytle-2" method="POST" action={{ url('forgetpassword') }}>
                        @csrf
                        <div class="row spesing">
                            <div class="col-md-12">
                                <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="मोबाइल नंबर."
                                    class="form-control">
                            </div>
                        </div>
                        <div class="btn-block">
                            <input type="submit" name="" value="अभी रीसेट करें" class="them-btn">
                        </div>
                    </form>

                @else
                    <form class="verify-form sytle-2" method="POST" action={{ url('forgetpassword') }}>
                        @csrf
                        <div class="row spesing">
                            <div class="col-md-12">
                                <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile No."
                                    class="form-control">
                            </div>
                        </div>
                        <div class="btn-block">
                            <input type="submit" name="" value="Reset Now" class="them-btn">
                        </div>
                    </form>
                @endif



            </div>
        </div>
    </section>
@endsection
