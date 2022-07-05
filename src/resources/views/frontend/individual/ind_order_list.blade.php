@extends('layouts.header') 
@section('title', 'My Sales | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white mb-3">{{Session::get('weblangauge') == 'kn' ? 'बिक्री':'Sales'}}</h1>
                    <a href="{{url::to('ind-add-sale?sale=ind')}}" class="btn btn-lg btn-orange"><img src="assets/images/add-circle-icon.svg" alt="">{{Session::get('weblangauge') == 'kn' ? 'नई बिक्री जोड़ें':'Add New Sale'}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane active" id="pending">
                    <div class="row">
                        @forelse($allOrders as $allOrder)
                        <?php //echo "<pre>"; print_r($allOrder->get_clf); die; ?>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="orderCard d-flex justify-content-between align-items-center">
                                    
                                    <div class="info-box w-100">
                                        <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrder->created_at)) }}</div>
                                        <div class="name">
                                            <span class="d-block"></span> {{ $allOrder->getClf->organization_name }}
                                        </div>
                                        <div class="orderID">{{Session::get('weblangauge') == 'kn' ? 'क्रेता आईडी:':'Buyer ID:'}} <b>{{ $allOrder ? $allOrder->order_id_d : '' }}</b></div>
                                        <div class="readMore">
                                            <a href="{{ url::to('/ind-order-detail') }}/{{ encrypt($allOrder->id) }}"><span class="icon"><img src="assets/images/white-right-arrow.svg" alt="" /></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{Session::get('weblangauge') == 'kn' ? 'कोई ऑर्डर नहीं':'No orders'}}</p>  
                        @endforelse
                    </div>
                </div>


            </div>

        </div>




    </div>

   



    @endsection