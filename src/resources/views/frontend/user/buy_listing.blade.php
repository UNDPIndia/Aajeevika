@extends('layouts.header') 
@section('title', 'My Orders | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'मैनेजर खरीदें':'Buy Manager'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
        
        <div class="tab-content">
        <div class="tab-pane active" id="pending">
            <div class="row">
            @foreach($allOrders as $allOrder)
                
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="orderCard d-flex justify-content-between align-items-center">
                        
                        <div class="info-box w-100">
                            <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrder->created_at)) }}</div>
                            <div class="name">
                                <span class="d-block">{{ $allOrder->GetIndividual->name ? $allOrder->GetIndividual->name : '' }}</span>
                            </div>
                            <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'खरीदार आईडी:':'Buyer ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                            <div class="readMore">
                                <a href="{{ url('/buy-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
            </div>
        </div>
        
        </div>

        </div>




    </div>

   



    @endsection