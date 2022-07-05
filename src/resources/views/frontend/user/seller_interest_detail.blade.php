@extends('layouts.header') 
@section('title', 'Interests Detail | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'रुचि विवरण':'Interests Detail'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-2">
        <div class="container">
            <div class="whiteCard">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="left-box">
                            <div class="inner">
                                <div class="orderID-outer d-flex flex-wrap align-items-center justify-content-between">
                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'रुचि आईडी:':'Interest ID:'}}</div>
                                    <div class="orderID">{{ $interestDetails->interest_Id }}</div>
                                    <div class="date">{{ date('D M d Y | h:i A', strtotime($interestDetails->created_at)) }}</div>
                                </div>
                                <div class="buyer-info">
                                    <div class="top">
                                        <div class="title">{{Session::get('weblangauge') == 'kn' ? 'खरीदार विवरण':'Buyer Details'}}</div>
                                        <div class="name">{{ $interestDetails->buyer ? $interestDetails->buyer->name : '' }}</div>
                                    </div>
                                    <div class="middle">
                                        <div class="phone d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/phone-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="tel:{{ $interestDetails->buyer ? $interestDetails->buyer->mobile : '' }}">+91 {{ $interestDetails->buyer ? $interestDetails->buyer->mobile : '' }}</a>
                                            </div>
                                        </div>
                                        <div class="email d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets//images/email-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="mailto:{{ $interestDetails->buyer ? $interestDetails->buyer->email : '' }}">{{ $interestDetails->buyer ? $interestDetails->buyer->email : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 h-100">
                        <div class="right-box h-100">
                            <div class="inner">
                            @if($interestDetails->items)
                                @foreach ($interestDetails->items as $item)
                                    <div class="product-item d-flex align-items-center justify-content-between">
                                        <div class="info">
                                            <div class="name">{{ $item->product->name }}</div>
                                            <div class="qty">{{Session::get('weblangauge') == 'kn' ? 'मात्रा:':'Qty:'}} {{ $item->quantity }} {{ $item->product->price_unit }}</div>
                                        </div>
                                        <div class="price-tag d-flex justify-content-end"> <span>{{Session::get('weblangauge') == 'kn' ? 'कीमत:':'Price:'}} ₹{{ $item->quantity * $item->product->price }}</span></div>
                                    </div>
                                @endforeach                                    
                            @endif

                                <div class="yourMsz form-group">
                                    <label for="">{{Session::get('weblangauge') == 'kn' ? 'आपका संदेश':'Your Message'}}</label>
                                    <textarea name="" id="" class="form-control" disabled>{{ $interestDetails->message }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    @endsection