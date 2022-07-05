@extends('layouts.header')
@section('title', 'Add Products | UNDP')
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
                        <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'नई बिक्री जोड़ें':'Add New Sales'}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content bg-style-2">
        <div class="container">
            <div class="whiteCard">
            <div class="col-12 text-center d-none" id="spinner">
                <button class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
                {{Session::get('weblangauge') == 'kn' ? 'लोड हो रहा है...':'Loading...'}}
                </button>
            </div>
                <form method="post" action="{{ url::to('ind-add-sale') }}">
                @csrf
                    <div class="inner">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="topPart">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label class="w-100">{{Session::get('weblangauge') == 'kn' ? 'सीएलएफ का नाम':'Name Of CLF'}}</label>
                                        @php
                                            $clf_id = 0;
                                            if(Session::has('user_id')){
                                                $clf_id = Session::get('user_id');
                                            }
                                        @endphp
                                        <select class="interest-single form-control" name="user_id" id="user_id" required>
                                        <option value=""></option>
                                        @foreach ($clfUser as $clf_ids)
                                            <option value="{{$clf_ids->id}}" {{ $clf_ids->id == $clf_id? 'selected':'' }}> {{$clf_ids->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <input type="text" class="form-control" name="" id="clf_phone_no" placeholder="{{Session::get('weblangauge') == 'kn' ? 'सीएलएफ फोन नंबर':'CLF phone Number'}}" value="@if(Session::has('sess_clf_phone')){{ Session::get('sess_clf_phone') }} @endif" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <input type="text" class="form-control" name="" id="clf_email" placeholder="{{Session::get('weblangauge') == 'kn' ? 'सीएलएफ ईमेल पता':'CLF Email Address'}}" value="@if(Session::has('sess_clf_email')){{ Session::get('sess_clf_email') }} @endif" readonly/>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="bottomPart">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <div class="salesDate">
                                            <label for="">{{Session::get('weblangauge') == 'kn' ? 'बिक्री की तारीख':'Date of Sale'}}</label>
                                            <input data-date-format="yyyy-mm-dd" name="sale_date" class="form-control" id="date_sale" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" id="products">
                                @if (Session::has('indproducts'))
                                                @foreach (json_decode(Session::get('indproducts'), true) as $key => $sproduct_session)
                                                    <div class="col-12 col-md-6" id="del_product_{{$sproduct_session['id']}}">
                                                        <div class="prodCard d-flex justify-content-between align-items-center">
                                                            <div class="left-part d-flex flex-wrap align-content-center justify-content-start">
                                                                    <div class="name w-100">{{ $sproduct_session['name'] ?  $sproduct_session['name'] : '' }}</div>
                                                                    <!-- <div class="pricetag w-100">Price: <b>{{ $sproduct_session['price'] ?  $sproduct_session['price'] :'' }}/{{ $sproduct_session['price_unit'] ?  $sproduct_session['price_unit'] : '' }}</b></div> -->
                                                            </div>
                                                            <div class="right-part d-flex flex-wrap align-content-center justify-content-end">
                                                                        <div class="del w-100"><a href="javascript:void(0)" id="{{$sproduct_session['id']}}" class="delete-product"><img src="{{ asset('assets/images/delete-icon.svg') }}" alt="" /></a></div>
                                                                        <div class="qty w-100">{{Session::get('weblangauge') == 'kn' ? 'मात्रा:':'Qty:'}} <b>{{ $sproduct_session['qty_value'] ?  $sproduct_session['qty_value'] : '' }} {{ $sproduct_session['price_unit'] ?  $sproduct_session['price_unit'] : '' }}</b></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach                      
                                @endif 
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <div class="addProduct">
                                    <a href="{{url::to('/ind-products')}}" id="addProduct">{{Session::get('weblangauge') == 'kn' ? 'उत्पाद जोड़ें':'Add Products'}}</a>
                                </div>
                            </div>
                            <div class="addRate text-center">
                                <div class="rate d-flex justify-content-center">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" checked /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="review_msg" id="" class="form-control" placeholder="{{Session::get('weblangauge') == 'kn' ? 'खरीदार के लिए प्रतिक्रिया':'Feedback for buyer'}}" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-md-right text-center  addsale">
                                    <input type="submit" value="{{Session::get('weblangauge') == 'kn' ? 'सबमिट करे':'Submit'}}" class="btn btn-orange btn-xl">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    

    $('.interest-single').select2();
    $("#user_id").change(function() {
        let id = $(this).val();
        $('.bg-loader').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('/get-clf') }}",
            data: {
                clf_id: id
            },
            dataType: "json",
            success: function(data) {
                if(data) {
                    $('.bg-loader').hide();
                    if(data.status == true) {
                        $('#clf_phone_no').val(data.sess_clf_phone);
                        $('#clf_email').val(data.sess_clf_email);
                    }
                }
                 
            }
        });
    });
   
    // Date
    $('#date_sale').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        setDate: new Date(),
        autoclose: true,
        todayHighlight: true,
    });

    // Delete Product

    $(".delete-product").click(function(){
        let del_el = $(this).attr('id');
        console.log('del_el=', del_el);
        $("#del_product_"+ del_el).remove();
        deleteProducts(del_el);
    });

    // Delete Product by Ajax from session products
        function deleteProducts(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('/delete-sess-ind-products') }}",
            data: {
                product_id: id
            },
            dataType: "json",
            success: function(data) {
                if(data) {
                    if(data.status == true) {
                        console.log('Product Deleted');
                    }
                }
                 
            }
        });
    }
    

});
</script>
@endsection
