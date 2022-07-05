@extends('layouts.header') @section('title', 'Popullar Seller | UNDP') @section('content')
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
</style>
<div class="main">
<div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="text-white">Popular Sellers</h1>
                    </div>
                </div>
            </div>
        </div>
    <div class="main-content">
        <div class="container">
    <div class="row">
<?php 
                foreach($popularSeller as $key=>$pSeller){
                    $rating_num = number_format((float)$pSeller['rating']['ratingAvgStar'], 2, '.', '');
                   
                ?>
            <div class="col-6 col-md-4 col-lg-3">
           
                <div class="sellerItem">
                <a href="{{URL::to('shgstrisan/'.encrypt($pSeller['id']))}}">
                    <div class="image-box">
                        <?php if($pSeller['profileImage']){ ?>
                            <img src="{{$pSeller['profileImage']}}" class="img-fluid" alt="" />
                       <?php }else{ ?>
                            <img src="assets/images/seller-img.png" class="img-fluid" alt="" />
                            <?php } ?>
                        
                    </div>
                    <div class="content-box text-center">
                        <div class="title">{{$pSeller['name']}}</div>
                        <div class="rate d-flex justify-content-center w-100">
                            <fieldset class="rating">
                                <input type="radio" id="star5" disabled name="ratings{{$key}}" value="5" {{$rating_num == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" disabled name="ratings{{$key}}" value="4.5" <?php echo $rating_num >= 4.5 && $rating_num < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" disabled name="ratings{{$key}}" value="4" <?php echo $rating_num >= 4 && $rating_num < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" disabled name="ratings{{$key}}" value="3.5" <?php echo $rating_num >= 3.5 && $rating_num < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" disabled name="ratings{{$key}}" value="3" <?php echo $rating_num >= 3 && $rating_num < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" disabled name="ratings{{$key}}" value="2.5" <?php echo $rating_num >= 2.5 && $rating_num < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" disabled name="ratings{{$key}}" value="2" <?php echo $rating_num >= 2 && $rating_num < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" disabled name="ratings{{$key}}" value="1.5" <?php echo $rating_num >= 1.5 && $rating_num < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" disabled name="ratings{{$key}}" value="1" <?php echo $rating_num >= 1 && $rating_num < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" disabled name="ratings{{$key}}" value="0.5" <?php echo $rating_num >= 0.5 && $rating_num < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                        </div>
                        <div class="rate-count">{{$rating_num}} ( {{$pSeller['rating']['reviewCount']}} )</div>
                    </div>
                </a>
                </div>
                       
            </div>


                <?php } ?>
            </div>
        </div>
    </div>
</div>
@endsection
