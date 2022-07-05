@extends('layouts.header')
@section('title', 'Add Products | UNDP')
@section('content')

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<style>

fieldset, fieldset label { margin: 0; padding: 0; }
label{
    font-size: 10px;
}
/****** Style Star Rating Widget *****/

.rating { 
  border: none;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 3px;
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
  font-size:10px;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'एसएचजी इंडिवीडुअल्स':'SHG Ind'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="row">

            @foreach($userData as $val)
            {{-- {{$val['ratingAvgStar']}} --}}
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="orderCard ticket style-2">
                        <div class="info-row d-flex justify-content-between align-items-center">
                            <div class="left-part">{{$val['name']}}</div>
                            <div class="right-part">
                                <div class="review">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" disabled name="rating{{$loop->index}}" value="5" {{$val['ratingAvgStar'] == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                     <input type="radio" id="star4half" disabled name="rating{{$loop->index}}" value="4.5" <?php echo $val['ratingAvgStar'] >= 4.5 && $val['ratingAvgStar'] < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" disabled name="rating{{$loop->index}}" value="4" <?php echo $val['ratingAvgStar'] >= 4 && $val['ratingAvgStar'] < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                      <input type="radio" id="star3half" disabled name="rating{{$loop->index}}" value="3.5" <?php echo $val['ratingAvgStar'] >= 3.5 && $val['ratingAvgStar'] < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" disabled name="rating{{$loop->index}}" value="3" <?php echo $val['ratingAvgStar'] >= 3 && $val['ratingAvgStar'] < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                      <input type="radio" id="star2half" disabled name="rating{{$loop->index}}" value="2.5" <?php echo $val['ratingAvgStar'] >= 2.5 && $val['ratingAvgStar'] < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                     <input type="radio" id="star2" disabled name="rating{{$loop->index}}" value="2" <?php echo $val['ratingAvgStar'] >= 2 && $val['ratingAvgStar'] < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                      <input type="radio" id="star1half" disabled name="rating{{$loop->index}}" value="1.5" <?php echo $val['ratingAvgStar'] >= 1.5 && $val['ratingAvgStar'] < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                       <input type="radio" id="star1" disabled name="rating{{$loop->index}}" value="1" <?php echo $val['ratingAvgStar'] >= 1 && $val['ratingAvgStar'] < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" disabled name="rating{{$loop->index}}" value="0.5" <?php echo $val['ratingAvgStar'] >= 0.5 && $val['ratingAvgStar'] < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>
                                    </div>
                            </div>
                        </div>
                        <div class="contactInfo">
                            <ul>
                                <li><img src="assets/images/call-icon.svg" alt=""><a href="tel:{{$val['mobile']}}">{{$val['mobile']}}</a></li>
                                <li><img src="assets/images/mail-icon.svg" alt=""><a href="mailto:{{$val['email']}}">{{$val['email']}}</a></li>
                                <li><img src="assets/images/location-icon.svg" alt="">{{$val['address_line_one']}} {{$val['address_line_two']}}, {{$val['block']}}, {{$val['district']}}, {{$val['state']}}, {{$val['pincode']}}</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

  {{--   <div class="footer-bottom">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="copyrights text-center text-md-left">Copyright � 2020 name. All Right Reserved.</div>
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
