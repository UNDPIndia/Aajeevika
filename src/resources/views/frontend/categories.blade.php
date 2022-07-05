@extends('layouts.header')
@section('title', 'All Categories | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if(Session::get('weblangauge') == 'kn')
                        <!-- <h1 class="text-white">महिला स्वयं सहायता समूह - ई-मार्केट</h1> -->
                            <h1 class="text-white">सब वर्ग</h1>
                        @else
                        <!-- <h1 class="text-white">Women Self Help Group - E-market</h1> -->
                            <h1 class="text-white">All Categories</h1>
                        @endif


                    </div>
                </div>
            </div>
        </div>
        @php
            /**
                    <ul class="breadcrumb">
                        <li><a href="{{ '/' }}"><i class="fa fa-dashboard"></i>Home</a> -> </li>
                    <?php $segments = ''; @endphp

                @foreach (Request::segments() as $segment)
        @php$segments .= '/' . $segment;@endphp
                    <li>
                        <a href="{{ $segments }}">{{ $segment }}</a>
                    </li>
                @endforeach


            </ul>
    **/
    ?>


        <!-- Category List -->
        <section class="category-list">
            <div class="container">
                <div class="row">
                    @foreach ($allCategory as $item)


                        <div class="col-md-2 list-wrep">
                            <div class="item">
                                <a href="{{ url('category') }}/{{ $item->slug }}">
                                    <div class="them-icon"> <img src="{{ asset($item->image) }}" width="64" height="64">
                                    </div>
                                    <div class="info mt-1">
                                        <h5>{{ $item->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </section>
    @endsection
