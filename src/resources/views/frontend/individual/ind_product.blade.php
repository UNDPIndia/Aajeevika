@extends('layouts.header')
@section('title', 'Add Products | UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'उत्पादों को जोड़ें':'Add Products'}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content bg-style-1">
        <div class="container">
        <form method="post" action="{{ url('add-ind-product-sess') }}">
        @csrf
            <div class="row">
                    @foreach ($catproducts as $catproduct)

                    <div class="col-12 product-heading">
                        <h2>{{$catproduct->name}}</h2>
                    </div>
                    @foreach($catproduct->indProducts as $index_key => $product)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="addProductCard d-flex justify-content-between align-items-center">
                                <div class="left-box d-flex flex-wrap justify-content-start align-items-center">
                                    <div class="image">
                                        @if ($product->image == '')
                                            <img src="{{ asset('public/assets/images/notfound.png') }}" height="76" >
                                        @else
                                            <img src="{{ asset($product->image) }}" height="76" alt="">
                                        @endif
                                    </div>
                                    <div class="info">
                                    <div class="name">{{ $product->name ? $product->name : '' }}</div>
                                    </div>
                                    
                                </div>
                               
                                <div class="right-box h-100 d-flex align-items-center justify-content-end">
                                <div class="qty-outer">   
                                    <div class="title w-100">Qty</div>
                                    <div class="qty-wrap d-flex justify-content-end align-items-center">
                                    <div class="qty-input d-flex justify-content-center align-items-center">
                                        <i class="less qty-btn" less_id="{{$product->id}}">
                                            <img src="{{ asset('assets/images/minus.svg') }}" alt="" />
                                        </i>
                                            <input type="text" readonly="true" name="product[{{$product->id}}][qty_value]" 
                                            value="<?php
                                            $default_quantity = 0;
                                            if (Session::has('indproducts')){
                                                foreach (json_decode(Session::get('indproducts'), true) as $sess_product){
                                                    if($product->id == $sess_product['id']){
                                                        $default_quantity = $sess_product['qty_value'];
                                                        break;
                                                    }
                                                }
                                                echo $default_quantity;
                                            }else {
                                                echo 0;
                                            }
                                             ?>" id="qty_value_{{$product->id}}" />
                                            <input type="hidden" name="product[{{$product->id}}][id]" value="{{$product->id}}" />
                                            <input type="hidden" name="product[{{$product->id}}][name]" value="{{$product->name}}" />
                                            <input type="hidden" name="product[{{$product->id}}][price]" value="{{$product->price}}" />
                                            <input type="hidden" name="product[{{$product->id}}][price_unit]" value="{{$product->price_unit}}" />
                                        <i class="more qty-btn" more_id="{{$product->id}}" total_quantity="{{$product->qty_avail}}">
                                            <img src="{{ asset('assets/images/plus.svg') }}" alt="" />
                                        </i>
                                    </div>
                                        <!-- <span class="d-block">{{ $product->price_unit ? $product->price_unit : ''  }}</span> -->
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                            <label class="error" id="error_{{$product->id}}"></label>
                            
                        </div>
                    @endforeach
                    @endforeach
                    <div class="btn-sticky-bottom">
                        <input type="submit" value="{{Session::get('weblangauge') == 'kn' ? 'पूर्ण':'Done'}}" class="btn btn-lg btn-orange">
                    </div>
            </div>
        </form>
           
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

  $('.more').click(function() {
    let loop_id = $(this).attr("more_id");
    //let quantity_avail = $(this).attr("total_quantity");
    let currentValue = $("#qty_value_" + loop_id).val();
    // if (parseInt(currentValue) >= parseInt(quantity_avail)) {
    //     $("#error_" + loop_id).text('Quantity Not Available');
    //     $(".btn-lg").prop('disabled', true);
    //     return false;
    // }
    currentValue++;
    $("#qty_value_" + loop_id).val(currentValue);
  });

  $('.less').click(function() {
    let loop_id = $(this).attr("less_id");
    let currentValue = $("#qty_value_" + loop_id).val();
    if (currentValue > 0) {
      currentValue--;
      $("#qty_value_" + loop_id).val(currentValue);
      $("#error_" + loop_id).text(' ');
      $(".btn-lg").prop('disabled', false);
    }
  });
</script>

@endsection
