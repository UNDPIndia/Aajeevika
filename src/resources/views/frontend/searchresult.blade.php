@extends('layouts.header')
@section('title', 'Result | UNDP')
@section('content')
    {{-- @php
    dd($result);
    @endphp --}}
    <div class="main">
        <section class="popular-product">
            <div class="container">
                <div class="product-heading">
                    <div class="row align-items-center">
                        <div class="col-sm-8 col-8">
                            @if (empty($result))
                                <h2>No Result Found ...</h2>
                            @else
                                <h2>Result</h2>
                            @endif

                        </div>

                    </div>
                </div>

                


                @foreach ($result as $item)
                    @if ($item['type'] == 'product')
                        <div class="product-heading">
                            <div class="row align-items-center">
                                <div class="col-sm-8 col-8">

                                    <h2>Products</h2>


                                </div>

                            </div>
                        </div>
                        <div class="product-outer mt-md-2 mb-md-5 mt-sm-2 mb-sm-3">
                            <div class="row text-center">
                                @foreach ($item['data'] as $res)

                                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                                        <div class="product-inner">
                                            <a href="{{ url('product') }}/{{ encrypt($res['productId']) }}">
                                                <div class="product-img"> <img src="{{ asset($res['image_1']) }}"
                                                        alt="popular-product-img1" /> </div>
                                                <div class="product-info">
                                                    <p class="item-info">
                                                        {{ $res['template']->name }}({{ $res['productName'] }} )</p>

                                                    <p>Pdx ID-<?php echo sprintf("%'.06d\n", $res['productId']);
                                                        ?></p>

                                                    <p><strong>₹{{ $res['price'] }}</strong></p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    @if ($item['type'] == 'artisanshg')

                        <div class="product-heading">
                            <div class="row align-items-center">
                                <div class="col-sm-8 col-8">

                                    <h2>SHG/Atrisan</h2>


                                </div>

                            </div>
                        </div>
                        @foreach ($item['data'] as $shg)

                            <div class="product-outer mt-md-2 mb-md-5 mt-sm-2 mb-sm-3">
                                <div class="row text-center">
                                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                                        <div class="product-inner">
                                            @if ($shg['profileImage'] != null)
                                                <a href="{{ url('shgstrisan') }}/{{ $shg['artisanshgId'] }}">
                                                    <div class="product-img">
                                                        <img src="{{ asset($shg['profileImage']) }}"
                                                            alt="popular-product-img1" />
                                                    </div>
                                                    <div class="product-info">
                                                        <p class="item-info">
                                                            {{ $shg['artisanshgName'] }} </p>

                                                    </div>

                                                </a>
                                            @else

                                                <a href="{{ url('shgstrisan') }}/{{ $shg['artisanshgId'] }}">
                                                    <div class="product-img">
                                                        <img src="{{ asset('assets/images/urs-img.png') }}"
                                                            alt="popular-product-img1" />
                                                    </div>

                                                    <div class="product-info">
                                                        <p class="item-info">
                                                            {{ $shg['artisanshgName'] }} </p>

                                                    </div>
                                                </a>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>



                        @endforeach
                    @endif


                    @if ($item['type'] == 'parentCategory')

                        <!-- <div class="product-heading">
                            <div class="row align-items-center">
                                <div class="col-sm-8 col-8">

                                    <h2>Categories</h2>


                                </div>

                            </div>
                        </div>
                        <div class="product-outer mt-md-2 mb-md-5 mt-sm-2 mb-sm-3">
                            <div class="row text-center">
                                @foreach ($item['data'] as $product)


                                    <div class="col-12 col-md-3 col-sm-6 mb-4">
                                        <div class="product-inner">




                                            <a href="{{ url('category') }}/{{ $product['catSlug'] }}">
                                                <div class="product-img">
                                                    <img src="{{ asset($product['catImage']) }}"
                                                        alt="popular-product-img1" />
                                                </div>
                                                <div class="product-info">
                                                    <p class="item-info">
                                                        {{ $product['catName'] }} </p>

                                                </div>
                                            </a>


                                        </div>
                                    </div>




                                @endforeach
                            </div>
                        </div> -->
                    @endif
                @endforeach


            </div>



        </section>
    </div>


@endsection
