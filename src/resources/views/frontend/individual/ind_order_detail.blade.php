@extends('layouts.header') 
@section('title', 'Sale Detail | UNDP') 
@section('content')
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
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'बिक्री का विवरण':'Sale Detail'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-2">
        <div class="container">
            <div class="whiteCard">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="left-box">
                            <div class="inner">
                                <div class="orderID-outer d-flex flex-wrap align-items-center justify-content-between">
                                <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrders->created_at)) }}</div>
                                    
                                   
                                    
                                </div>
                                <div class="buyer-info">
                                    <div class="top d-flex justify-content-between">
                                        <div class="left-part">
                                            <div class="name">{{ $allOrders->getClf ? $allOrders->getClf->organization_name : '' }}</div>
                                            <div class="title"> {{Session::get('weblangauge') == 'kn' ? 'क्रेता आईडी:':'Buyer ID:'}}</div>
                                    <div class="orderID">{{ $allOrders->order_id_d }}</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 h-100">
                        <div class="right-box h-100">
                            <div class="inner">
                            @if($allOrders->indItems)
                            <?php $totalPrice = 0; ?>
                                @foreach ($allOrders->indItems as $item)
                                <?php $totalPrice+= $item->product_price; ?>
                                    <div class="product-item d-flex align-items-center justify-content-between">
                                        <div class="info">
                                            <div class="name">{{ $item->Indproduct->name_en }}</div>
                                            <div class="qty">Qty: {{ $item->quantity }} {{ $item->indproduct->price_unit }}</div>
                                        </div>
                                    </div>

                                @endforeach                                    
                            @endif
                               
                                <?php //echo "<pre>"; print_r($allOrders); die(); ?>
                                    <!-- Seller rating -->
                                        <?php if($allOrders->clfRating){ 
                                            //echo $allOrders->clfRating->rating;
                                            ?>
                                            <div class="rateArea ">
                                                <div class="infoArea d-flex justify-content-start align-items-center">
                                                    <div class="avtar">
                                                        @if ($allOrders->GetIndividual->profileImage)
                                                                <img src="{{ asset($allOrders->GetIndividual->profileImage) }}" alt="">
                                                        @else
                                                            <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="info">
                                                        <div class="name">{{$allOrders->GetIndividual->name}}</div>
                                                            <div class="addRate text-center">
                                                                <div class="rate">
                                                                    <fieldset class="rating">
                                                                        <input type="radio" id="star5" disabled name="ratings" value="5" {{$allOrders->clfRating->rating == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                                        <input type="radio" id="star4half" disabled name="ratings" value="4.5" <?php echo $allOrders->clfRating->rating >= 4.5 && $allOrders->clfRating->rating < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                        <input type="radio" id="star4" disabled name="ratings" value="4" <?php echo $allOrders->clfRating->rating >= 4 && $allOrders->clfRating->rating < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star3half" disabled name="ratings" value="3.5" <?php echo $allOrders->clfRating->rating >= 3.5 && $allOrders->clfRating->rating < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                        <input type="radio" id="star3" disabled name="ratings" value="3" <?php echo $allOrders->clfRating->rating >= 3 && $allOrders->clfRating->rating < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star2half" disabled name="ratings" value="2.5" <?php echo $allOrders->clfRating->rating >= 2.5 && $allOrders->clfRating->rating < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                        <input type="radio" id="star2" disabled name="ratings" value="2" <?php echo $allOrders->clfRating->rating >= 2 && $allOrders->clfRating->rating < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star1half" disabled name="ratings" value="1.5" <?php echo $allOrders->clfRating->rating >= 1.5 && $allOrders->clfRating->rating < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                        <input type="radio" id="star1" disabled name="ratings" value="1" <?php echo $allOrders->clfRating->rating >= 1 && $allOrders->clfRating->rating < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="starhalf" disabled name="ratings" value="0.5" <?php echo $allOrders->clfRating->rating >= 0.5 && $allOrders->clfRating->rating < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <p>{{$allOrders->clfRating->review_msg}}</p>
                                            </div>
                                        <?php } ?>
                                        <!-- buyer rating -->
                            <?php if($allOrders->indRating){ ?>
                                <div class="rateArea even">
                                    <div class="infoArea d-flex justify-content-start align-items-center">
                                        <div class="avtar">
                                            @if ($allOrders->getClf->profileImage)
                                                    <img src="{{ asset($allOrders->getClf->profileImage) }}" alt="">
                                            @else
                                                <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="info">
                                            <div class="name">{{$allOrders->getClf->name}}</div>
                                                <div class="addRate text-center  py-0">
                                                    <div class="rate">
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5" disabled name="rating" value="5" {{$allOrders->indRating->rating == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                            <input type="radio" id="star4half" disabled name="rating" value="4.5" <?php echo $allOrders->indRating->rating >= 4.5 && $allOrders->indRating->rating < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                            <input type="radio" id="star4" disabled name="rating" value="4" <?php echo $allOrders->indRating->rating >= 4 && $allOrders->indRating->rating < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                            <input type="radio" id="star3half" disabled name="rating" value="3.5" <?php echo $allOrders->indRating->rating >= 3.5 && $allOrders->indRating->rating < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                            <input type="radio" id="star3" disabled name="rating" value="3" <?php echo $allOrders->indRating->rating >= 3 && $allOrders->indRating->rating < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                            <input type="radio" id="star2half" disabled name="rating" value="2.5" <?php echo $allOrders->indRating->rating >= 2.5 && $allOrders->indRating->rating < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                            <input type="radio" id="star2" disabled name="rating" value="2" <?php echo $allOrders->indRating->rating >= 2 && $allOrders->indRating->rating < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                            <input type="radio" id="star1half" disabled name="rating" value="1.5" <?php echo $allOrders->indRating->rating >= 1.5 && $allOrders->indRating->rating < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                            <input type="radio" id="star1" disabled name="rating" value="1" <?php echo $allOrders->indRating->rating >= 1 && $allOrders->indRating->rating < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                            <input type="radio" id="starhalf" disabled name="rating" value="0.5" <?php echo $allOrders->indRating->rating >= 0.5 && $allOrders->indRating->rating < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <p>{{$allOrders->indRating->review_msg}}</p>
                                </div>
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


    @endsection