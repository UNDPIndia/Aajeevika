@extends('layouts.header') 
@section('title', 'Interests | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'मेरी रुचियां':'My Interests'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="row">
                @forelse($interests as $buyerInterest)
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="orderCard d-flex justify-content-between align-items-center">
                            <div class="image-box">
                                @if ($buyerInterest->buyer->profileImage)
                                <img src="{{ asset($buyerInterest->buyer->profileImage) }}" alt="">
                                @else
                                <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                @endif

                            </div>
                            <div class="info-box">
                                <div class="date">{{ date('D M d Y | h:i A', strtotime($buyerInterest->created_at)) }}</div>
                                <div class="name">
                                    <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'खरीदार का नाम:':'Buyer Name:'}}</span> {{ $buyerInterest->buyer->name ? $buyerInterest->buyer->name : '' }}
                                </div>
                                <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'रुचि आईडी:':'Interest ID:'}} <b>{{ $buyerInterest ? $buyerInterest->interest_Id : '' }}</b></div>
                                <div class="readMore">
                                    <a href="{{ url('/seller-interest-detail') }}/{{ encrypt($buyerInterest->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'रुचि नहीं मिली':'Interest Not Found'}}</div>
                @endforelse
 

            </div>
        </div>
    </div>

  



    @endsection