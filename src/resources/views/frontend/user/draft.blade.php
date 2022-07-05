@extends('layouts.header')
@section('title', 'Draft | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if (Session::get('weblangauge') == 'kn')
                            <h1 class="text-white">ಕರಡು</h1>
                        @else
                            <h1 class="text-white">Draft</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($draftproduct))
            <!-- Category List -->

            @if (Session::get('weblangauge') == 'kn')
                <section class="popular-product draft-outer">
                    <div class="container">
                        <div class="product-outer mt-md-2 mt-sm-2  mb-md-4 mb-sm-3">
                            <div class="row text-center">
                                <div class="col-12 col-md-3 col-sm-6">
                                    <div class="product-inner"> <a
                                            href="{{ url('editproduct') }}/{{ $draftproduct->id }}">
                                            <div class="product-img"> <img src="{{ asset($draftproduct->image_1) }}"
                                                    alt="jute-item1">
                                            </div>
                                            <div class="product-info">

                                                <p class="item-info">

                                                    {{ $draftproduct->template->name_kn }}
                                                    ({{ $draftproduct->localname_kn }})</p>


                                                <p><strong>₹{{ $draftproduct->price }}</strong></p>


                                                <a href="{{ url('editproduct') }}/{{ $draftproduct->id }}"
                                                    class="btn btn-secondary mt-2">ಉತ್ಪನ್ನವನ್ನು ಸಂಪಾದಿಸಿ</a>
                                            </div>
                                        </a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            @else

                <section class="popular-product draft-outer ">
                    <div class="container">
                        <div class="product-outer mt-md-2 mt-sm-2  mb-md-4 mb-sm-3">
                            <div class="row text-center">
                                <div class="col-12 col-md-3 col-sm-6">
                                    <div class="product-inner">
                                        <a href="{{ url('editproduct') }}/{{ encrypt($draftproduct->id) }}">
                                            <div class="product-img"> <img src="{{ asset($draftproduct->image_1) }}"
                                                    alt="jute-item1">
                                            </div>
                                            <div class="product-info">

                                                <p class="item-info">

                                                    {{ $draftproduct->template->name_en }}
                                                    ({{ $draftproduct->localname_en }})</p>
                                                <p>PDX-<?php echo sprintf("%'.06d\n", $draftproduct->id); ?></p>

                                                <p><strong>₹{{ $draftproduct->price }}</strong></p>

                                                <div class="d-flex justify-content-between product-btn flex-wrap">
                                                    <a href="{{ url('editproduct') }}/{{ encrypt($draftproduct->id) }}"
                                                        class="btn btn-secondary mt-2 mr-1">
                                                        Edit
                                                    </a>
                                                    <a onclick="return confirm('Are you sure?')"
                                                        href="{{ url('deleteproduct') }}/{{ encrypt($draftproduct->id) }}"
                                                        class="btn btn-secondary mt-2">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif



        @else

            <!-- Category List -->
            <section class="popular-product draft-outer comingsoon">
                <div class="container">
                    <div class="product-outer mt-md-2 mt-sm-2  mb-md-4 mb-sm-3">
                        <div class="row text-center">
                            <div class="col-12 col-md-3 col-sm-6">

                                <h1 class="text-black">
                                    No Product Found
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        @endif



    @endsection
