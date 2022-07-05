@extends('layouts.header')
@section('title', 'Order Detail | UNDP')
@section('content')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<style>
    fieldset,
    fieldset label {
        margin: 0;
        padding: 0;
    }

    /****** Style Star Rating Widget *****/

    .rating {
        border: none;
    }

    .rating>input {
        display: none;
    }

    .rating>label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .rating>.half:before {
        content: "\f089";
        position: absolute;
    }

    .rating>label {
        color: #ddd;
        float: right;
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating>input:checked~label,
    /* show gold star when clicked */
    .rating:not(:checked)>label:hover,
    /* hover current star */
    .rating:not(:checked)>label:hover~label {
        color: #FFD700;
    }

    /* hover previous stars in list */

    .rating>input:checked+label:hover,
    /* hover current star when changing rating */
    .rating>input:checked~label:hover,
    .rating>label:hover~input:checked~label,
    /* lighten current selection */
    .rating>input:checked~label:hover~label {
        color: #FFED85;
    }
</style>
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'रेटिंग':'Rating'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="row">
                
               
                @forelse($ratings as $val)
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="rateCard">
                        <div class="rateArea p-0">
                            <div class="infoArea d-flex justify-content-start align-items-center mb-0">
                                <div class="avtar">


                                @if ($val['getreviews']['profileImage'])
                                                                <img src="{{ asset($val['getreviews']['profileImage']) }}" alt="">
                                                        @else
                                                            <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                                        @endif
                                </div>
                                <div class="info">

                                    <div class="addRate flex-wrap p-0">
                                        <div class="name w-100">{{$val['getreviews']['organization_name']}}</div>
                                        <div class="rate pointer-none">
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" disabled name="ratings{{$loop->index}}" value="5" {{$val->rating == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4half" disabled name="{{$loop->index}}" value="4.5" <?php echo $val->rating >= 4.5 && $val->rating < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                            <input type="radio" id="star4" disabled name="ratings{{$loop->index}}" value="4" <?php echo $val->rating >= 4 && $val->rating < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3half" disabled name="ratings{{$loop->index}}" value="3.5" <?php echo $val->rating >= 3.5 && $val->rating < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                            <input type="radio" id="star3" disabled name="ratings{{$loop->index}}" value="3" <?php echo $val->rating >= 3 && $val->rating < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2half" disabled name="ratings{{$loop->index}}" value="2.5" <?php echo $val->rating >= 2.5 && $val->rating < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                            <input type="radio" id="star2" disabled name="ratings{{$loop->index}}" value="2" <?php echo $val->rating >= 2 && $val->rating < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1half" disabled name="ratings{{$loop->index}}" value="1.5" <?php echo $val->rating >= 1.5 && $val->rating < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                            <input type="radio" id="star1" disabled name="ratings{{$loop->index}}" value="1" <?php echo $val->rating >= 1 && $val->rating < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            <input type="radio" id="starhalf" disabled name="ratings{{$loop->index}}" value="0.5" <?php echo $val->rating >= 0.5 && $val->rating < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p>{{$val->review_msg}}</p>
                        </div>
                    </div>
                   


                </div>
                @empty
                    <div class="col-sm-12 text-center">{{Session::get('weblangauge') == 'kn' ? 'कोई रेटिंग उपलब्ध नहीं है':'No rating available'}}</div>
                @endforelse
            </div>


        </div>
    </div>


</div>



@endsection