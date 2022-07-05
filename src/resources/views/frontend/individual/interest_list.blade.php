@extends('layouts.header') @section('title', 'Interest | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'मेरी उत्पाद':'My Product'}}</h1>
                </div>
            </div>
        </div>

    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="text-right mb-3">
                <a href="{{url::to('add-interest')}}" class="btn btn-orange btn-lg">{{Session::get('weblangauge') == 'kn' ? 'उत्पाद संपादित करें':'Edit Product'}}</a>
            </div>
        
                <div class="row">
                
                    @foreach($interestList as $val)
                    <div class="col-lg-4 col-sm-6 col-12">
                        
                        <div class="interestCard position-relative">
                            <label class="orderCard d-flex justify-content-between align-items-center" for="interest1">
                                <div class="left-box d-flex justify-content-start align-items-center">
                                    <div class="image">
                                        <img src="{{$val->indInterest->image}}" class="img-fluid" alt="" />
                                    </div>
                                    @if(Session::get('weblangauge') == 'kn')
                                        <div class="name">{{$val->indInterest->name_hi}}</div>
                                    @else
                                        <div class="name">{{$val->indInterest->name_en}}</div>
                                    @endif
                                </div>
                                <div class="right-box">
                                    <div class="d-flex justify-content-end">
                                        <span class="d-inline-block"><img src="assets/images/green-check.svg" alt=""></span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
           
        </div>
    </div>

    


    @endsection