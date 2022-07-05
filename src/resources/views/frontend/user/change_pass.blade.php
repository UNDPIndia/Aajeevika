@extends('layouts.header')
@section('title', 'Change Password | UNDP')
@section('content')
    <div class="main">
        <section class="upload-sec">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <form enctype="multipart/form-data" action="{{ url('/changepassword') }}" method="POST">
                    @csrf
                    
                    <div class="upload-doc">


<div class="form-group row">

<label for="password" class="col-md-4 col-form-label text-md-right">{{Session::get('weblangauge') == 'kn' ? 'वर्तमान पासवर्ड':'Current Password'}}</label>



<div class="col-md-6">

    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" required>

</div>

</div>



<div class="form-group row">

<label for="password" class="col-md-4 col-form-label text-md-right">{{Session::get('weblangauge') == 'kn' ? 'नया पासवर्ड':'New Password'}}</label>



<div class="col-md-6">

    <input id="new_password" type="password" class="form-control" name="password" autocomplete="current-password" required>

</div>

</div>



<div class="form-group row">

<label for="password" class="col-md-4 col-form-label text-md-right">{{Session::get('weblangauge') == 'kn' ? 'नया पासवर्ड की पुष्टि करें':'New Confirm Password'}}</label>



<div class="col-md-6">

    <input id="new_confirm_password" type="password" class="form-control" name="password_confirmation" autocomplete="current-password">

</div>

</div>




<div class="btn-sub text-center">
                        <input type="submit" name="" value="{{Session::get('weblangauge') == 'kn' ? 'सबमिट करें':'Submit'}}" class="them-btn">
                    </div>



</form>

</div>
                    
            </div>
        </section>
    </div>
@endsection
