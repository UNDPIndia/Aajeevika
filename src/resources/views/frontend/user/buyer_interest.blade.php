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
            @forelse($buyerInterests as $buyerInterest)
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="orderCard d-flex justify-content-between align-items-center">
                        <div class="image-box">
                            <img src="{{ asset($buyerInterest->seller->profileImage) }}" alt="">
                        </div>
                        <div class="info-box">
                            <div class="date">{{ date('D M d Y | h:i A', strtotime($buyerInterest->created_at)) }}</div>
                            <div class="name">
                                <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'विक्रेता का नाम:':'Seller Name:'}}</span> {{ $buyerInterest->seller->name ? $buyerInterest->seller->name : '' }}
                            </div>
                            <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'रुचि आईडी:':'Interest ID:'}} <b>{{ $buyerInterest ? $buyerInterest->interest_Id : '' }}</b></div>
                            <div class="readMore">
                                <a href="{{ url('/buyer-interest-detail') }}/{{ encrypt($buyerInterest->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
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