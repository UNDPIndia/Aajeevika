@extends('layouts.header') 
@section('title', 'Express Interest | UNDP') 
@section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">Express Interest</h1>
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
                                <div class="buyer-info">
                                    <div class="top">
                                        <div class="title">Seller Details</div>
                                        <div class="name">{{ $seller_detail->name ? $seller_detail->name : '' }}</div>
                                    </div>
                                    <div class="middle">
                                        <div class="phone d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/phone-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="tel:{{ $seller_detail->mobile ? $seller_detail->mobile : '' }}">+91{{ $seller_detail->mobile ? $seller_detail->mobile : '' }}</a>
                                            </div>
                                        </div>
                                        <div class="email d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/email-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="mailto:{{ $seller_detail->email ? $seller_detail->email : '' }}">{{ $seller_detail->email ? $seller_detail->email : '' }}</a>
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
                                
                                <div class="addProduct text-right mb-3">
                                    <a href="{{ url('express-products')}}/{{encrypt($seller_detail->id)}}">Add Products</a>
                                </div>
                                @if($errors->any())
                                    <h4 style="color:red">{{$errors->first()}}</h4>
                                @endif
                                
                                @if (Session::has('products'))
                                        @foreach (json_decode(Session::get('products'), true) as $sproduct_session)
                                            <div class="product-item d-flex align-items-center justify-content-between">
                                                <div class="info">
                                                    <div class="name">{{ $sproduct_session['name'] ?  $sproduct_session['name'] : '' }}</div>
                                                    <div class="qty">Qty: {{ $sproduct_session['qty_value'] ?  $sproduct_session['qty_value'] : '' }} {{ $sproduct_session['price_unit'] ?  $sproduct_session['price_unit'] : '' }}.</div>
                                                </div>
                                                <div class="price-tag d-flex justify-content-end"> <span>Price: ₹{{ $sproduct_session['price'] ?  $sproduct_session['price']*$sproduct_session['qty_value'] : '' }}</span></div>
                                            </div>
                                        @endforeach
                                @endif                               
                                <form method="post" action="{{ url('/add-express-interest') }}/{{encrypt($seller_detail->id)}}">
                                @csrf
                                    <div class="yourMsz form-group">
                                        <label for="">Your Message</label>
                                        <textarea name="message" id="" class="form-control" placeholder="Your Message *" required></textarea>
                                    </div>
                                    <div class="text-md-right text-center  addsale">
                                        <input type="submit" value="Submit" class="btn btn-orange btn-xl">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection