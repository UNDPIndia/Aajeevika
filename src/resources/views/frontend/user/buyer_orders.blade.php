@extends('layouts.header') 
@section('title', 'My Orders | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'मेरी बिक्री':'My Orders'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
        <ul class="nav nav-pills customTab-nav">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#pending">{{Session::get('weblangauge') == 'kn' ? 'विचाराधीन':'Pending'}}</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#completed"> {{Session::get('weblangauge') == 'kn' ? 'पूरा किया हुआ':'Completed'}}</a>
            </li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="pending">
            <div class="row">
            @php
                $pend_rec_count = 0;
            @endphp
            @foreach($allOrders as $allOrder)
            @if($allOrder->order_status == 'pending' || $allOrder->order_status == 'received')
            <?php $pend_rec_count += 1; ?>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="orderCard d-flex justify-content-between align-items-center">
                        <div class="image-box">
                            <img src="{{ asset($allOrder->seller->profileImage) }}" alt="">
                        </div>
                        <div class="info-box">
                            <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrder->created_at)) }}</div>
                            <div class="name">
                                <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'विक्रेता का नाम:':'Seller Name:'}}</span> {{ $allOrder->seller->name ? $allOrder->seller->name : '' }}
                            </div>
                            <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर आईडी:':'Order ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                            <div class="readMore">
                                <a href="{{ url('/buyer-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @if($pend_rec_count == 0)
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर नहीं मिला:':'Order Not Found'}}</div>
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="completed">
            <div class="row">
            @php
                $deliver_count = 0;
            @endphp
            @foreach($allOrders as $allOrder)
                @if($allOrder->order_status == 'delivered')
                <?php $deliver_count += 1; ?>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="orderCard d-flex justify-content-between align-items-center">
                        <div class="image-box">
                            <img src="{{ asset($allOrder->seller->profileImage) }}" alt="">
                        </div>
                        <div class="info-box">
                            <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrder->created_at)) }}</div>
                            <div class="name">
                                <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'विक्रेता का नाम:':'Seller Name:'}}</span> {{ $allOrder->seller->name ? $allOrder->seller->name : '' }}
                            </div>
                            <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर आईडी:':'Order ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                            <div class="readMore">
                                <a href="{{ url('/buyer-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @if($deliver_count == 0)
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर नहीं मिला:':'Order Not Found'}}</div>
                @endif
            </div>
        </div>


        </div>

        </div>




    </div>

    @endsection