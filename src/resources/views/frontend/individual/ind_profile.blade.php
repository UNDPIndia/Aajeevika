@extends('layouts.header')
@section('title', $alldetail['user']['name'] . ' | UNDP')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        
        <section class="artsian-outer @if (Auth::user()) artsian-with-login @endif">
            <div class="container">
                <div class="artsian-inner position-relative">
                    <div class="row align-items-center">
                       

                        <div class="col-sm-6 col-md-7 artsian-left">
                            <div class="artsian-img">
                                @if ($alldetail['user']['profileImage'] == null)
                                    <img src="../assets/images/artsian-img.png" alt="artsian-img" />
                                @else
                                    <img src="{{ asset($alldetail['user']['profileImage']) }}" alt="artsian-img" />
                                @endif
                            </div>
                            <div class="artsian-info text-center">
                                <h4> {{ $alldetail['user']['name'] }}</h4>
                                <p style="color: orange">
                                        @if (Session::get('weblangauge') == 'kn')
                                            @if ($alldetail['user'])
                                                    @if ($alldetail['user']['role_id'] == 2)
                                                        सीएलएफ
                                                    @elseif($alldetail['user']['role_id'] == 3)
                                                        एसएचजी एंटरप्राइज
                                                    @elseif($alldetail['user']['role_id'] == 7)
                                                        सरस केंद्र
                                                    @elseif($alldetail['user']['role_id'] == 8)
                                                        विकास केंद्र
                                                    @elseif($alldetail['user']['role_id'] == 9)
                                                        किसान
                                                    @endif
                                            @endif
                                        @else
                                            @if ($alldetail['user'])
                                                    @if ($alldetail['user']['role_id'] == 2)
                                                        CLF
                                                    @elseif($alldetail['user']['role_id'] == 3)
                                                        SHG Enterprise
                                                    @elseif($alldetail['user']['role_id'] == 7)
                                                        Saras Center
                                                    @elseif($alldetail['user']['role_id'] == 8)
                                                        Growth Center
                                                    @elseif($alldetail['user']['role_id'] == 9)
                                                        SHG Individual
                                                    @endif
                                            @endif
                                        @endif                                    
                                </p>
                                <p>{{ $alldetail['user']['title'] }}</p>
                                <a href="{{url::to('view-ind-rating/'.encrypt($alldetail['user']['id']))}}">
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
                                <span>({{$alldetail['reviewCount']}})</span>
                            </div>
                            <div>{{$alldetail['ratingAvgStar']}}{{Session::get('weblangauge') == 'kn' ? ' (5) में से':'out of 5'}} </div>
                            </div>
                            </a>
                            
                                
                            </div>
                            
                        </div>
                        @if (Auth::user())
                            {{-- @dd(Auth::user()); --}}
                            {{-- @dd($alldetail); --}}

                            <div class="col-sm-6 col-md-5 artsian-right"> <a
                                    href="tel:{{ $alldetail['user']['mobile'] }}"
                                    class="phone">{{ $alldetail['user']['mobile'] }}</a> <a
                                    href="mailto:{{ $alldetail['user']['email'] }}"
                                    class="mail">{{ $alldetail['user']['email'] }}</a>
                                <p class="address">{{ $alldetail['address']['address_line_one'] }},<br>
                                    {{ $alldetail['address']['districtname'] }},
                                    {{ $alldetail['address']['statename'] }},
                                    {{ $alldetail['address']['countryname'] }}
                                    <br> Pin Code: ({{ $alldetail['address']['pincode'] }})
                                </p>
                            </div>
                        @endif
                            
                        
                    </div>
                    <label class="form-check-label artsian-like-btn">
                    <input type="checkbox" <?php echo $alldetail['favStatus'] == 1 ?'checked':''; ?> class="form-check-input update-fav" name="user_fav" value="{{ $alldetail['favStatus'] }}">
                    <input type="hidden" class="form-check-input seller_id" name="seller_id" value="{{ $alldetail['user']['id'] }} ">
                    <span class="check-result"></span></label>
                </div>
            </div>
        </section>
        <section class="popular-product shg-outer">
        <div class="container category-two-outer">
                    <div class="category-heading">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>{{Session::get('weblangauge') == 'kn' ? 'रुचि':'Interest'}}</h2>
                            </div>
                        </div>
                    </div>
        <div class="row">
                    @foreach ($alldetail['individualInterest'] as $indInterest)
                    
                       
                        <div class="col-sm-6 col-md-3 col-lg-2">
                            <div class="sellerCard shadow">
                                <div class="image-box">
                                    @if($indInterest->indInterest->image)
                                        <img src="{{ asset($indInterest->indInterest->image)}}" class="img-fluid" alt="" />
                                    @else
                                        <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="detail-box">
                                    @if(Session::get('weblangauge') == 'kn')
                                        <div class="title">{{$indInterest->indInterest->name_hi}}</div>
                                    @else
                                        <div class="title">{{$indInterest->indInterest->name_en}}</div>
                                    @endif
                                    
                                </div>
                            </div>        
                        </div>
                                      
                    @endforeach
                </div>
                </div>
       
                </section>
      
    @endsection
