{{-- @extends('layouts.header')
@section('title', $exception->getStatusCode() . ' | UNDP')
@section('content') --}}
    <!-- Fonts -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Styles -->
<div class="main h-100">
	<section class="verify-otp error-page d-flex align-items-center h-100">
	    <div class="container h-100">
	    	<div class="row h-100">
	    		<div class="col-12 text-center h-100 d-flex justify-content-center align-items-center">
					<div class="inner-wrap">
			        <div class="image-404 mb-3">
						<img src="assets/images/error-404.jpg" class="img-fluid" alt="" />
					</div>
			        <h4 class="mb-2 w-100">Oops!</h4>
					<p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal w-100">
			        	{{-- @yield('message') --}}
						That Page Doesn't Exist or is Unavailable.
			        </p>
					<div class="btnWrap mt-3">
						<a class="btn btn-orange btn-lg" href="{{ app('router')->has('home') ? route('home') : url('/') }}">
			        		{{ __('Go Home') }}
			        	</a>
					</div>
					</div>
			    </div>
	    	</div>
	    </div>
	</section>
</div>

{{--
@endsection
--}}