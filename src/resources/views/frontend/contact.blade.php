@extends('layouts.header')
@section('title', 'Contact Us | UNDP')
@section('content')


<section class="verify-otp">
    <div class="container">
        <div class="row">
        	<div class="col-12">
        		<h5>{{Session::get('weblangauge') == 'kn' ? 'संपर्क: ':'Contact:'}} 123467890</h5>
            </div>
        </div>
    </div>
</section>

@endsection
