@extends('layouts.header')
@section('title', $subcategorydata->name . ' | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if (Session::get('weblangauge') == 'kn')
                            <!-- <h1 class="text-white">महिला स्वयं सहायता समूह - ई-मार्केट</h1> -->

                        @else
                            <!-- <h1 class="text-white">Women Self Help Group - E-market</h1> -->

                        @endif

                        <h1 class="text-white">{{ $subcategorydata->name }}

                            <!-- <div class="share"> <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><img
                                        src="{{ asset('assets/images/share.svg') }}" alt="share"></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start"
                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                    @php
                                        $currentURL = url()->full();
                                    @endphp




                                    <a target="_blank" class="dropdown-item"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ $currentURL }}">
                                        <img src="{{ asset('assets/images/share-facebook.svg') }}" alt="share" /></a>
                                    <a target="_blank" class="dropdown-item"
                                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($currentURL) }}">
                                        <img src="{{ asset('assets/images/share-linkedin.svg') }}" alt="share" /></a>
                                    <a target="_blank" class="dropdown-item"
                                        href="https://twitter.com/intent/tweet?url={{ urlencode($currentURL) }}?>">
                                        <img src="{{ asset('assets/images/share-twitter.svg') }}" alt="share" /></a>




                                </div>
                            </div> -->
                        </h1>
                    </div>
                </div>
            </div>
        </div>


        <!-- Category List -->

        <section class="popular-product sub-category">
            <div class="container">
                <div class="product-outer">
                    <div class="row text-center">
                        @foreach ($productdata as $item)
                            <div class="col-12 col-md-3 col-sm-6 mb-4">
                                <div class="product-inner category-inner">

                                    <a href="{{ url('product') }}/{{ encrypt($item->id) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($item->image_1) }}" alt="popular-product-img1">
                                        </div>
                                        <div class="product-info">
                                            <p class="item-info">

                                                {{ $item->template->name }}
                                                ({{ $item->name }})
                                            </p>
                                            <p class="item-info">
                                                {{ $item->user->name }}
                                            </p>
                                            <p>PDX-<?php echo sprintf("%'.06d\n", $item->id); ?></p>
                                            <p><strong>₹{{ $item->price }}</strong></p>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


    @endsection
