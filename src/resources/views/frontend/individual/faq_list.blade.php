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
                    <h3 class="text-center">{{Session::get('weblangauge') == 'kn' ? 'आज़ हम आपकी किस प्रकार सहायता कर सकते हैं?':'How can we help you today?'}}</h3>
                    <div class="faq-inner">
                        <ul class="faqList">
                            @foreach($faq as $val)
                            <li>
                                <div class="faquestion d-flex flex-wrap justify-content-between">
                                    <div class="left-part">
                                       {{$val->title}}
                                    </div>
                                    <div class="right-part">
                                        <img src="assets/images/icon-right-arrow.svg" alt="">
                                    </div>
                                    <a href="{{url::to('faq-question/'.encrypt($val->id))}}" class="clickable"></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

   


    @endsection