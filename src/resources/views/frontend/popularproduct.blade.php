@extends('layouts.header')
@section('title', 'Popular Products | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="text-white">Popular Products</h1>
                    </div>
                </div>
            </div>
        </div>


        <!-- Category List -->

        <section class="popular-product sub-category">
            <div class="container">
                <div class="product-outer">
                    <div class="row text-center">
                        @foreach ($popularproducts as $item)
                            <div class="col-12 col-md-3 col-sm-6 mb-4">
                                <div class="product-inner category-inner">

                                    <a href="{{ url('product') }}/{{ encrypt($item->id) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($item->image_1) }}" alt="popular-product-img1">
                                        </div>
                                        <div class="product-info">
                                            <p class="item-info">
                                                {{ $item->template->name}}
                                                ({{ $item->name }})
                                            </p>
                                            <p>Pdx ID-<?php echo sprintf("%'.06d\n", $item->id); ?></p>
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
