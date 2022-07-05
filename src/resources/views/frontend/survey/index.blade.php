@extends('layouts.header')
@section('title', 'Add Products | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'एक सर्वेक्षण ले':'Take a Survey'}} </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content bg-style-1">
        <div class="container">
            <div class="row">
                @foreach($surveyList as $val)
                <div class="col-lg-4 col-sm-6 col-12">
                    <?php  $endDate = date('y-m-d', strtotime($val->end_date));
                               $todayDate = date('y-m-d'); ?>
                    <div class="orderCard  <?php if($todayDate >= $endDate){ echo 'expired'; } ?> sarvey style-2">
                    <div class="publishDate">{{Session::get('weblangauge') == 'kn' ? 'प्रकाशित हुआ:':'Published on:'}} <b>{{ date('j M Y', strtotime($val->start_date)) }}</b></div>
                        <div class="title">{{$val->message}}</div>
                        
                        <div class="sarvey-row d-flex justify-content-between align-items-center">
                            <div class="left-part"><b>
                               <?php 
                              
                               if($todayDate <= $endDate){
                                   echo date('j M Y', strtotime($val->end_date));
                               }else{
                                   echo 'Expired';
                               }
                               ?>
                            </b>
                            </div>
                            <?php if($todayDate <= $endDate){ ?>
                            <div class="right-part">
                                <a href="<?php echo $val->google_url; ?>" class="btn btn-green btn-sm" target="_blank">{{Session::get('weblangauge') == 'kn' ? 'एक सर्वेक्षण ले':'Take a Survey'}}</a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                @endforeach
               
          
            </div>
        </div>
    </div>

 




@endsection
