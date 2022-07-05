@extends('layouts.header') @section('title', 'FAQ | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'सामान्य प्रश्न':"FAQ's"}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="whiteCard">
                <div class="inner">
                    <h3 class="text-center">{{$faq->question}}</h3>
                    <div class="faq-inner">
                        <p>{{$faq->desc}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    



    @endsection