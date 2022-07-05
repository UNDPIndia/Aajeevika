@extends('layouts.header')
@section('title', $alldetail['user']['name'] . ' | UNDP')
@section('content')
    {{-- @php
    dd($alldetail);
    @endphp --}}
    <div class="main @if (empty($alldetail['allProduct']))footer-fixd @endif" >
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">


                            <h1 class="text-white">@if (empty($alldetail['allProduct']))
                                {{Session::get('weblangauge') == 'kn' ? 'कोई उत्पाद नहीं मिला':'No Product Found'}}
                            @else
                                {{Session::get('weblangauge') == 'kn' ? 'उत्पाद':'Products'}}

                            @endif</h1>


                    </div>
                </div>
            </div>
        </div>
        <section class="popular-product ">
            @foreach ($alldetail['allProduct'] as $item)
                <div class="container category-two-outer mt-4">
                    <div class="category-heading">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>{{ $item['categoryName'] }}</h2>
                            </div>
                        </div>
                    </div>
                    @foreach ($item['subCategories'] as $in)


                        <div class="product-heading">
                            <div class="row align-items-center">
                                <div class="col-sm-8 col-6">
                                    <h2>{{ $in['subCategoryName'] }}</h2>
                                </div>
                                <div class="col-sm-4 col-6 text-right">
                                    @php
                                    $id = encrypt(Auth::user()->id);    
                                    @endphp
                                    <a
                                        href="{{ url('category') }}/{{ $item['categoryslug'] }}/{{ $in['subCategoryslug'] }}?show={{$id}}"
                                        class="btn btn-orange btn-lg"> {{Session::get('weblangauge') == 'kn' ? 'और देखें':'View More'}}</a>
                                </div>
                            </div>



                            <div class="product-outer">
                                <div class="row text-center">
                                    @foreach ($in['products'] as $prods)

                                        <div class="col-12 col-md-3 col-sm-6 mb-4">
                                            <div class="product-inner">
                                                <a href="{{ url('product') }}/{{ encrypt($prods['id']) }}">
                                                    <div class="product-img"> <img src="{{ asset($prods['image_1']) }}"
                                                            alt="popular-product-img1"> </div>
                                                    <div class="product-info">
                                                        <p class="item-info">
                                                        <p>PDX-<?php echo sprintf("%'.06d\n", $prods['id']); ?></p>
                                                        {{ $prods['template']->name }}({{ $prods['name'] }})</p>
                                                        @if (Auth::check() && Auth::user()->role_id == 1)
                                                            <p>{{ $prods['user']['organization_name'] }}</p>
                                                        @endif
                                                        <p><strong>₹{{ $prods['price'] }}</strong></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>




                        </div>
                    @endforeach





            @endforeach






        </section>
    </div>
@endsection
