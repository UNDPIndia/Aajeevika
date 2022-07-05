@extends('layouts.header') @section('title', 'Interest | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'उत्पाद का चयन करें':'Select Product'}}</h1>
                </div>
            </div>
        </div>

    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <form action="{{url::to('add-interest')}}" method="post">
                @csrf
                <div class="row">
                    
                    @foreach($allInterestList as $val)
                        <?php 
                        $checked = '';
                        foreach($userInterestList as $selected){
                            if($selected->individual_interest_list_id == $val->id){
                                $checked = 'checked';
                                //echo $selected->user_id;
                            }
                        }
                        ?>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="interestCard position-relative">
                            <input type="checkbox" <?php echo $checked; ?> name="interest_item[]" value="<?php echo $val->id; ?>" id="interest<?php echo $val->id; ?>" />
                            <label class="orderCard d-flex justify-content-between align-items-center" for="interest<?php echo $val->id; ?>">
                                <div class="left-box d-flex justify-content-start align-items-center">
                                    <div class="image">
                                        <img src="{{$val->image}}" class="img-fluid" alt="" />
                                    </div>
                                    <div class="name">{{$val->name}}</div>
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
                <div class="btn-sticky-bottom">
                <button type="submit" class="btn btn-lg btn-orange">{{Session::get('weblangauge') == 'kn' ? 'आगे बढ़े':'Proceed'}}</button>
            </div>
            </form>
            
        </div>
    </div>

    


    @endsection