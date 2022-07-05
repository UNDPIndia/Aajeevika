@extends('layouts.header')
@section('title', 'FAQ | UNDP')
@section('content')
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
                    <h3 class="text-center">{{$faq->title}}</h3>
                    <div class="faq-inner">
                        <ul class="faqList">
                            @foreach($faq->getQuestion as $val)
                            
                            <li>
                                <div class="faquestion d-flex flex-wrap justify-content-between">
                                    <div class="left-part">
                                    {{$val['question']}}
                                    </div>
                                    <div class="right-part">
                                        <img src="{{asset('assets/images/icon-right-arrow.svg')}}" alt="">
                                    </div>
                                    <a href="{{url::to('faq-desc/'.encrypt($val['id']))}}" class="clickable"></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--     <div class="footer-bottom">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="copyrights text-center text-md-left">Copyright © 2020 name. All Right Reserved.</div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="footLinks">
                            <ul class="d-flex flex-wrap justify-content-center justify-content-md-end">
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Term and Condition</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}






@endsection
