@extends('layouts.header') 
@section('title', 'Order Detail | UNDP') 
@section('content')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<style>
fieldset,
fieldset label { margin: 0; padding: 0; }

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
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर विवरण':'Order Detail'}}</h1>
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
                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'ऑर्डर आईडी:':'Order ID:'}}</div>
                                    <div class="orderID">{{ $allOrders->order_id_d }}</div>
                                    <div class="date">{{ date('D M d Y | h:i A', strtotime($allOrders->created_at)) }}</div>
                                </div>
                                <div class="buyer-info">
                                    <div class="top d-flex justify-content-between">
                                        <div class="left-part">
                                            <div class="title">{{Session::get('weblangauge') == 'kn' ? 'विक्रेता विवरण:':'Seller Details:'}}</div>
                                            <div class="name">{{ $allOrders->seller ? $allOrders->seller->name : '' }}</div>
                                        </div>
                                        @if ($allOrders->mode_of_delivery == 1)
                                            <div class="right-part">
                                            <div class="otp">
                                                {{Session::get('weblangauge') == 'kn' ? 'ओटीपी:':'OTP:'}} 1234
                                            </div>
                                        </div>
                                        @endif
                                        
                                    </div>
                                    <div class="middle">
                                        <div class="phone d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets/images/phone-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="tel:{{ $allOrders->seller ? $allOrders->seller->mobile : '' }}">+91 {{ $allOrders->seller ? $allOrders->seller->mobile : '' }}</a>
                                            </div>
                                        </div>
                                        <div class="email d-flex align-items-center justify-content-start">
                                            <div class="icon">
                                                <img src="{{ asset('assets//images/email-icon.svg') }}" alt="" />
                                            </div>
                                            <div class="text">
                                                <a href="mailto:{{ $allOrders->seller ? $allOrders->seller->email : '' }}">{{ $allOrders->seller ? $allOrders->seller->email : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 h-100">
                        <div class="right-box h-100">
                            <div class="inner">
                            @if($allOrders->items)
                            @php $totalPrice = 0;  @endphp
                                @foreach ($allOrders->items as $item)
                                    <div class="product-item d-flex align-items-center justify-content-between">
                                        <div class="info">
                                            <div class="name">{{ $item->product->name }}</div>
                                            <div class="qty">{{Session::get('weblangauge') == 'kn' ? 'मात्रा:':'Qty:'}} {{ $item->quantity }} {{ $item->product->price_unit }}</div>
                                        </div>
                                        <div class="price-tag d-flex justify-content-end"> <span>{{Session::get('weblangauge') == 'kn' ? 'कीमत:':'Price:'}} ₹{{ $item->quantity*$item->product_price }}</span></div>
                                    </div>
                                    @php $totalPrice+= $item->product_price*$item->quantity;  @endphp
                                @endforeach                                    
                            @endif
                                <div class="totalAmount d-flex align-items-center justify-content-between">
                                        <div class="text">{{Session::get('weblangauge') == 'kn' ? 'कुल राशि':'Total Amount'}}</div>
                                        <div class="amount">₹{{$totalPrice}}</div>
                                </div>
                            <!-- Seller rating -->
                            <?php if($allOrders->sellerRating){ ?>
                                <div class="rateArea ">
                                    <div class="infoArea d-flex justify-content-start align-items-center">
                                        <div class="avtar">
                                            @if ($allOrders->seller->profileImage)
                                                    <img src="{{ asset($allOrders->seller->profileImage) }}" alt="">
                                            @else
                                                <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="info">
                                            <div class="name">{{$allOrders->seller->organization_name}}</div>
                                                <div class="addRate text-center py-0 pointer-none">
                                                    <div class="rate">
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5"  name="ratings" value="5" {{$allOrders->sellerRating->rating == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                            <input type="radio" id="star4half"  name="ratings" value="4.5" <?php echo $allOrders->sellerRating->rating >= 4.5 && $allOrders->sellerRating->rating < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                            <input type="radio" id="star4"  name="ratings" value="4" <?php echo $allOrders->sellerRating->rating >= 4 && $allOrders->sellerRating->rating < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                            <input type="radio" id="star3half"  name="ratings" value="3.5" <?php echo $allOrders->sellerRating->rating >= 3.5 && $allOrders->sellerRating->rating < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                            <input type="radio" id="star3"  name="ratings" value="3" <?php echo $allOrders->sellerRating->rating >= 3 && $allOrders->sellerRating->rating < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                            <input type="radio" id="star2half"  name="ratings" value="2.5" <?php echo $allOrders->sellerRating->rating >= 2.5 && $allOrders->sellerRating->rating < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                            <input type="radio" id="star2"  name="ratings" value="2" <?php echo $allOrders->sellerRating->rating >= 2 && $allOrders->sellerRating->rating < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                            <input type="radio" id="star1half"  name="ratings" value="1.5" <?php echo $allOrders->sellerRating->rating >= 1.5 && $allOrders->sellerRating->rating < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                            <input type="radio" id="star1"  name="ratings" value="1" <?php echo $allOrders->sellerRating->rating >= 1 && $allOrders->sellerRating->rating < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                            <input type="radio" id="starhalf"  name="ratings" value="0.5" <?php echo $allOrders->sellerRating->rating >= 0.5 && $allOrders->sellerRating->rating < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <p>{{$allOrders->sellerRating->review_msg}}</p>
                                </div>
                            <?php } ?>
                            <!-- buyer rating -->
                            <?php if($allOrders->buyerRating){ ?>
                                <div class="rateArea even">
                                    <div class="infoArea d-flex justify-content-start align-items-center">
                                        <div class="avtar">
                                            @if ($allOrders->buyer->profileImage)
                                                    <img src="{{ asset($allOrders->buyer->profileImage) }}" alt="">
                                            @else
                                                <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="info">
                                            <div class="name">{{$allOrders->buyer->name}}</div>
                                                <div class="addRate text-center py-0 pointer-none">
                                                    <div class="rate">
                                                        <fieldset class="rating">
                                                            <input type="radio" id="star5b"  name="ratingb" value="5" {{$allOrders->buyerRating->rating == 5 ? 'checked':'' }} /><label class = "full" for="star5b" title="Awesome - 5 stars"></label>
                                                            <input type="radio" id="star4halfb"  name="ratingb" value="4.5" <?php echo $allOrders->buyerRating->rating >= 4.5 && $allOrders->buyerRating->rating < 5 ? 'checked':''; ?> /><label class="half" for="star4halfb" title="Pretty good - 4.5 stars"></label>
                                                            <input type="radio" id="star4b"  name="ratingb" value="4" <?php echo $allOrders->buyerRating->rating >= 4 && $allOrders->buyerRating->rating < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4b" title="Pretty good - 4 stars"></label>
                                                            <input type="radio" id="star3halfb"  name="ratingb" value="3.5" <?php echo $allOrders->buyerRating->rating >= 3.5 && $allOrders->buyerRating->rating < 4 ? 'checked':''; ?> /><label class="half" for="star3halfb" title="Meh - 3.5 stars"></label>
                                                            <input type="radio" id="star3b"  name="ratingb" value="3" <?php echo $allOrders->buyerRating->rating >= 3 && $allOrders->buyerRating->rating < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3b" title="Meh - 3 stars"></label>
                                                            <input type="radio" id="star2halfb"  name="ratingb" value="2.5" <?php echo $allOrders->buyerRating->rating >= 2.5 && $allOrders->buyerRating->rating < 3 ? 'checked':''; ?> /><label class="half" for="star2halfb" title="Kinda bad - 2.5 stars"></label>
                                                            <input type="radio" id="star2b"  name="ratingb" value="2" <?php echo $allOrders->buyerRating->rating >= 2 && $allOrders->buyerRating->rating < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2b" title="Kinda bad - 2 stars"></label>
                                                            <input type="radio" id="star1halfb"  name="ratingb" value="1.5" <?php echo $allOrders->buyerRating->rating >= 1.5 && $allOrders->buyerRating->rating < 2 ? 'checked':''; ?> /><label class="half" for="star1halfb" title="Meh - 1.5 stars"></label>
                                                            <input type="radio" id="star1b"  name="ratingb" value="1" <?php echo $allOrders->buyerRating->rating >= 1 && $allOrders->buyerRating->rating < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1b" title="Sucks big time - 1 star"></label>
                                                            <input type="radio" id="starhalfb"  name="ratingb" value="0.5" <?php echo $allOrders->buyerRating->rating >= 0.5 && $allOrders->buyerRating->rating < 1 ? 'checked':''; ?> /><label class="half" for="starhalfb" title="Sucks big time - 0.5 stars"></label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <p>{{$allOrders->buyerRating->review_msg}}</p>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($allOrders->order_status == 'delivered' && $rating_valid_invalid == 'valid' )
                <!-- Rating review Start -->
                    <form method="post" action="{{ url('add-rating-seller') }}/{{ encrypt($allOrders->seller_id) }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $allOrders->id }}">
                        <div class="addRate text-center">
                                <div class="rate d-flex justify-content-center">
                                    <fieldset class="rating">
                                        <input type="radio" id="star51" name="rating" value="5" /><label class = "full" for="star51" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half1" name="rating" value="4.5" /><label class="half" for="star4half1" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star41" name="rating" value="4" checked /><label class = "full" for="star41" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half1" name="rating" value="3.5" /><label class="half" for="star3half1" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star31" name="rating" value="3" /><label class = "full" for="star31" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half1" name="rating" value="2.5" /><label class="half" for="star2half1" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star21" name="rating" value="2" /><label class = "full" for="star21" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half1" name="rating" value="1.5" /><label class="half" for="star1half1" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star11" name="rating" value="1" /><label class = "full" for="star11" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf1" name="rating" value="0.5" /><label class="half" for="starhalf1" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="review_msg" id="" class="form-control" placeholder="Feedback for seller" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-md-right text-center  addsale">
                                <input type="submit" value=" {{Session::get('weblangauge') == 'kn' ? 'सबमिट करें':'Submit'}}" class="btn btn-orange btn-xl">
                            </div>
                        </div>
                    </form>
                <!-- Rating review End -->
            @endif
            </div>
            
            
        </div>
    </div>
    @endsection