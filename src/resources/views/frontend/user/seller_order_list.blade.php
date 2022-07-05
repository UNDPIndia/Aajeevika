@extends('layouts.header') 
@section('title', 'My Orders | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white mb-3">{{Session::get('weblangauge') == 'kn' ? 'मेरे आर्डर':'My Orders'}}</h1>
                    <a href="add-sale?sale=first" class="btn btn-lg btn-orange"><img src="assets/images/add-circle-icon.svg" alt=""> {{Session::get('weblangauge') == 'kn' ? '':''}}{{Session::get('weblangauge') == 'kn' ? 'नई बिक्री जोड़ें':'Add New Sale'}}</a>
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
                                <!-- <div class="image-box">
                                    <img src="{{ asset($allOrder->seller->profileImage) }}" alt=""> 
                                </div> -->
                                <div class="info-box w-100">
                                    <div class="date">{{ date('D M d Y ', strtotime($allOrder->sale_date)) }}</div>
                                    <div class="name">
                                        <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'खरीदार का नाम:':'Buyer Name:'}}</span> {{ $allOrder->buyer->name ? $allOrder->buyer->name : '' }}
                                    </div>
                                    <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'आर्डर आईडी:':'Order ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                                    <div class="readMore">
                                        <a href="{{ url('/seller-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif  
                @endforeach
                @if($pend_rec_count == 0)
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर नहीं मिला':'Order Not Found'}}</div>
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
                                    <!-- <div class="image-box">
                                        <img src="{{ asset($allOrder->seller->profileImage) }}" alt="">
                                    </div> -->
                                    <div class="info-box w-100">
                                        <div class="date">{{ date('D M d Y ', strtotime($allOrder->sale_date)) }}</div>
                                        <div class="name">
                                            <span class="d-block">{{Session::get('weblangauge') == 'kn' ? 'खरीदार का नाम:':'Buyer Name:'}}</span> {{ $allOrder->buyer->name ? $allOrder->buyer->name : '' }}
                                        </div>
                                        <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'आर्डर आईडी:':'Order ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                                        <div class="readMore">
                                            <a href="{{ url('/seller-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                @endforeach
                @if($deliver_count == 0)
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर नहीं मिला':'Order Not Found'}}</div>
                @endif
            </div>
        </div>


        </div>

        </div>




    </div>

   



    @endsection