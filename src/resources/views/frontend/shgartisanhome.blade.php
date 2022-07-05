@extends('layouts.header')
@section('title', $alldetail['user']['name'] . ' | UNDP')
@section('content')

<script type="text/javascript" src="cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" crossorigin="anonymous" />
<script type="text/javascript" src="cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<style>

fieldset, fieldset label { margin: 0; padding: 0; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 




input.form-check-input:checked ~ .check-result:after {
color: #ff0202;
content: "\f004";
}



span.check-result:after {
content: "\f08a";
font: normal normal normal 18px/1 FontAwesome;
transition: all 0.35s;
-webkit-transition: all 0.35s;
-moz-transition: all 0.35s;
}
input.form-check-input {
opacity: 0;
content: "\f004";
}
.artsian-like-btn {
position: absolute;
right: 20px;
top: 11px;
cursor: pointer;
}

</style>

    <div class="main">
        {{-- @php
        dd($alldetail);
        @endphp --}}
        <div class="category-banner shg-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center"> </div>
                </div>
            </div>
        </div>
        <!-- Category List -->
        <!-- add class on login artsian-with-login-->
        @php
            $currentURL = url()->full();
        @endphp
        <section class="artsian-outer @if (Auth::user()) artsian-with-login @endif">
            <div class="container">
                <div class="artsian-inner position-relative">
                    <div class="row align-items-center">
                       


                        <div class="col-sm-6 col-md-8 artsian-left">
                            <div class="artsian-img">
                                @if ($alldetail['user']['profileImage'] == null)
                                    <img src="../assets/images/artsian-img.png" alt="artsian-img" />
                                @else
                                    <img src="{{ asset($alldetail['user']['profileImage']) }}" alt="artsian-img" />
                                @endif
                            </div>
                            <div class="artsian-info text-center">
                                <h4> {{ $alldetail['user']['name'] }}</h4>
                                @php $mob_no = ""; 
                                if($alldetail['user']['mobile']){
                                    $mob_no = str_split($alldetail['user']['mobile']);
                                    $mob_no = $mob_no[0].$mob_no[1].$mob_no[2].'****'.$mob_no[7].$mob_no[8].$mob_no[9];
                                    
                                }
                                @endphp
                                <a href="tel:{{ $mob_no }}" class="phone">{{ $mob_no }}</a>
                                
                                <p>{{ $alldetail['user']['title'] }}</p>
                                <a href="{{url::to('view-rating/'.encrypt($alldetail['user']['id']))}}">
                                    <div class="showRate">
                            <div class="d-flex justify-content-center align-items-center">    
                                <fieldset class="rating pointer-none">
                                    <input type="radio" id="star5" disabled name="ratings" value="5" {{$alldetail['ratingAvgStar'] == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" disabled name="ratings" value="4.5" <?php echo $alldetail['ratingAvgStar'] >= 4.5 && $alldetail['ratingAvgStar'] < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" disabled name="ratings" value="4" <?php echo $alldetail['ratingAvgStar'] >= 4 && $alldetail['ratingAvgStar'] < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" disabled name="ratings" value="3.5" <?php echo $alldetail['ratingAvgStar'] >= 3.5 && $alldetail['ratingAvgStar'] < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" disabled name="ratings" value="3" <?php echo $alldetail['ratingAvgStar'] >= 3 && $alldetail['ratingAvgStar'] < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" disabled name="ratings" value="2.5" <?php echo $alldetail['ratingAvgStar'] >= 2.5 && $alldetail['ratingAvgStar'] < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" disabled name="ratings" value="2" <?php echo $alldetail['ratingAvgStar'] >= 2 && $alldetail['ratingAvgStar'] < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" disabled name="ratings" value="1.5" <?php echo $alldetail['ratingAvgStar'] >= 1.5 && $alldetail['ratingAvgStar'] < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" disabled name="ratings" value="1" <?php echo $alldetail['ratingAvgStar'] >= 1 && $alldetail['ratingAvgStar'] < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" disabled name="ratings" value="0.5" <?php echo $alldetail['ratingAvgStar'] >= 0.5 && $alldetail['ratingAvgStar'] < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                <span>{{$alldetail['ratingAvgStar']}}({{$alldetail['reviewCount']}})</span>
                            </div>
                            <div>{{$alldetail['ratingAvgStar']}}{{Session::get('weblangauge') == 'kn' ? ' (5) में से':'out of 5'}} </div>
                            </div>
                            </a>
                            
                                <div class="btnWrap mt-2">
                                @if (Auth::check() && Auth::user()->role_id == 1)
                                    <a href="{{url('express-interest')}}/{{ encrypt($alldetail['user']['id']) }}" class="btn btn-orange btn-lg product-btn">{{ Session::get('weblangauge') == 'kn' ? 'रुचि व्यक्त करें' : 'Express Interest' }}</a>
                                @else
                                    <a href="{{url('login')}}" class="btn btn-orange btn-lg product-btn">{{ Session::get('weblangauge') == 'kn' ? 'रुचि व्यक्त करें' : 'Express Interest' }}</a>
                                @endif
                                </div>
                            </div>
                            
                        </div>
                        @if (Auth::user())
                            {{-- @dd(Auth::user()); --}}
                            {{-- @dd($alldetail); --}}
                            @php
                            if($alldetail['user']['mobile']){
                                $mob_no = str_split($alldetail['user']['mobile']);
                                $mob_no = $mob_no[0].$mob_no[1].$mob_no[2].'****'.$mob_no[7].$mob_no[8].$mob_no[9];
                            }
                            
                            @endphp
                            <div class="col-sm-6 col-md-4 artsian-right"> <a
                                    href="tel:{{ $mob_no }}"
                                    class="phone">{{ $mob_no }}</a> <a
                                    href="mailto:{{ $alldetail['user']['email'] }}"
                                    class="mail">{{ $alldetail['user']['email'] }}</a>
                                <p class="address">{{ $alldetail['address']['address_line_one'] }},<br>
                                    {{ $alldetail['address']['districtname'] }},
                                    {{ $alldetail['address']['statename'] }},
                                    {{ $alldetail['address']['countryname'] }}
                                    <br> Pin Code: ({{ $alldetail['address']['pincode'] }})
                                </p>
                            </div>
                            <label class="form-check-label artsian-like-btn">
                                <input type="checkbox" <?php echo $alldetail['favStatus'] == 1 ?'checked':''; ?> class="form-check-input update-fav" name="user_fav" value="{{ $alldetail['favStatus'] }}">
                                <input type="hidden" class="form-check-input seller_id" name="seller_id" value="{{ $alldetail['user']['id'] }} ">
                                <span class="check-result"></span></label>
                        @else
                            {{-- @if (Session::get('weblangauge') == 'kn')
                                <div class="col-sm-4 artsian-right">
                                    <a href="{{ url('login') }}?type=shgstrisan&id={{ $alldetail['user']['id'] }}"
                                        class="btn btn-secondary">
                                        संपर्क देखने के लिए लॉगिन करें</a>
                                </div>
                            @else

                                <div class="col-sm-4 artsian-right">
                                    <a href="{{ url('login') }}?type=shgstrisan&id={{ $alldetail['user']['id'] }}"
                                        class="btn btn-secondary">Login to view contact</a>
                                </div>
                            @endif --}}
                        @endif



                        {{--  --}}
                    </div>
                </div>
            </div>
        </section>

        {{-- @php
            dd($alldetail);
        @endphp --}}

        <section class="popular-product shg-outer">
            @foreach ($alldetail['allProduct'] as $item)
                <div class="container category-two-outer">
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
                                <div class="col-sm-4 col-6 text-right"> <a
                                        href="{{ url('category') }}/{{ $item['categoryslug'] }}/{{ $in['subCategoryslug'] }}?id={{ encrypt($alldetail['user']['id']) }}"
                                        class="btn btn-orange btn-lg">{{Session::get('weblangauge') == 'kn' ? 'और देखो':'View More'}}</a>
                                </div>
                            </div>



                            <div class="product-outer mt-0">
                                <div class="farm-slider text-center">
                                    @foreach ($in['products'] as $prods)

                                        <div class="farm-item">
                                            <div class="product-inner">
                                                <a href="{{ url('product') }}/{{ encrypt($prods['id']) }}?from=art">
                                                    <div class="product-img"> <img src="{{ asset($prods['image_1']) }}"
                                                            alt="popular-product-img1"> </div>
                                                    <div class="product-info">
                                                        <p class="item-info">
                                                            {{ $prods['template']->name }}({{ $prods['name'] }})</p>
                                                        <p>Pdx ID-<?php echo sprintf("%'.06d\n", $prods['id']);
                                                            ?></p>
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

    @endsection


