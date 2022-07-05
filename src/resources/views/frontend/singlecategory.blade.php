@extends('layouts.header')
@if ($categoryDetail != null)
    @foreach ($categoryDetail as $value)
        @section('title', $value['categoryname'] . ' | UNDP')
        @endforeach
    @endif
    @section('content')
        <div class="main">
            @if ($categoryDetail != null)

                <div class="category-banner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                @if (Session::get('weblangauge') == 'kn')
                                    <!-- <h1 class="text-white">महिला स्वयं सहायता समूह - ई-मार्केट</h1> -->

                                @else
                                    <!-- <h1 class="text-white">Women Self Help Group - E-market</h1> -->

                                @endif

                                <h1 class="text-white">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($categoryDetail as $value)
                                        {{ $value['categoryname'] }}

                                        @php
                                            $i++;
                                        @endphp
                                        @if ($i == 1)
                                            @php
                                                break;
                                            @endphp
                                        @endif
                                    @endforeach


                                    <div class="share"> <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink"
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
                                    </div>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Category List -->

                @if ($status == 1)
                    @foreach ($categoryDetail as $item)
                        <section class="popular-product category-one">
                            <div class="container">

                                <div class="product-heading">
                                    <div class="row align-items-center">
                                        <div class="col-sm-8 col-8">
                                            <h2>{{ $item['subcategory'] }}</h2>
                                        </div>
                                        <div class="col-sm-4 col-4 text-right"> <a
                                                href="{{ url('category') }}/{{ $item['slug'] }}/{{ $item['subslug'] }}"
                                                class="">
                                                @if (Session::get('weblangauge') == 'kn')
                                                और देखो
                                                @else 
                                                View More
                                                @endif
                                                
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-outer mt-md-2 mb-md-5 mt-sm-2 mb-sm-3">
                                    <div class="slider popular-product-slider  text-center">
                                        @foreach ($item['product'] as $prds)
                                            <div class="slick-slide slider-item ">
                                                <div class="product-inner">
                                                    <a href="{{ url('product') }}/{{ encrypt($prds['id']) }}">
                                                        <div class="product-img"> <img src="{{ asset($prds['image_1']) }}"
                                                                alt="popular-product-img1"> </div>
                                                        <div class="product-info">
                                                            <p class="item-info">

                                                                @if (Session::get('weblangauge') == 'kn')
                                                                    {{ $prds['template']->name_kn }}
                                                                @else
                                                                    {{ $prds['template']->name_en }}
                                                                @endif
                                                                ({{ $prds['name'] }})
                                                            </p>
                                                            <p class="item-info">{{ $prds['user']->name }}</p>
                                                            <p>PDX-<?php echo sprintf("%'.06d\n", $prds['id']);
                                                                ?></p>
                                                            <p><strong>₹{{ $prds['price'] }}</strong></p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                        </section>


                    @endforeach

                @else
                    NO data found
                @endif
            @else

                <div class="category-banner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                @if (Session::get('weblangauge') == 'kn')
                                    <h1 class="text-white">महिला स्वयं सहायता समूह - ई-मार्केट</h1>
                                @else
                                    <h1 class="text-white">Women Self Help Group - E-market</h1>
                                @endif
                                <h1 class="text-white">
                                    {{-- Category name --}}
                                    @php
                                        $currUrl = Request::path();
                                        $exp = explode('/', $currUrl);
                                        $slug = $exp[1];
                                        
                                        echo \App\Category::where(['slug' => $slug])
                                            ->pluck('name_en')
                                            ->first();
                                        
                                    @endphp
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="popular-product category-one comingsoon">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1 class="text-black">
                                    Coming Soon...
                                </h1>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>

    @endsection
