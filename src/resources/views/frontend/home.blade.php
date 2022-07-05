@extends('layouts.header') @section('title', 'Home | UNDP') @section('content')
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
    <!--Hero-Slider-->
    <div id="heroSlider" class="hero-slider carousel carousel-fade" data-ride="carousel">
        <!-- The slideshow -->
        <div class="carousel-inner">
            @php $i = 1; @endphp @foreach ($banner as $item)

            <div class="carousel-item @if ($i==1) active @endif ">
                <div class="hero-img">
                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="" />
                </div>
                <div class="container">
                    <div class="caption d-flex flex-wrap align-content-center">
                        {{-- <h1>Lorem Ipsum is simply dummy text</h1> 
                        <div class="read-more">
                            <a href="{{ $item->action }}">Learn more</a>
                        </div>--}}
                    </div>
                </div>
            </div>


            @php $i++; @endphp @endforeach



        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#heroSlider" data-slide="prev">
            <img src="assets/images/prev-arrow.svg" alt="" />
        </a>
        <a class="carousel-control-next" href="#heroSlider" data-slide="next">
            <img src="assets/images/next-arrow.svg" alt="" />
        </a>
    </div>

    <!--Hero-Slider-end-->

    <!--category-start-->
    <section class="category-outer">
        <div class="container">
            <div class="row text-center">

                    @foreach ($midCategory as $item)

                    <div class="col-md-4 col-12">
                        
                            <div class="catCard d-flex align-items-end">
                                <div class="image-box">
                                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="category-icon1" />
                                </div>
                                <div class="catDetail d-flex align-items-center justify-content-between">
                                    <div class="name">{{ $item->name }}</div>
                                    <div class="readMore">
                                        <a href="{{ url('category') }}/{{ $item->slug }}">
                                            <img src="assets/images/circle-arrow-white.svg" class="img-fluid" alt="" />
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ url('category') }}/{{ $item->slug }}" class="full-link-card position-absolute"></a>
                            </div>
                    </div>

                    @endforeach
                
            </div>
        </div>
    </section>
    <!--category-end-->



    <div class="popularSeller">
        <div class="container">
            <div class="product-heading">
                <div class="row align-items-center">
                    <div class="col-sm-8 col-8">
                        @if (Session::get('weblangauge') == 'kn')
                        <h2> लोकप्रिय उत्पाद </h2>

                        @else
                        <h2>Popular Sellers</h2>
                        @endif


                    </div>
                    <div class="col-sm-4 col-4 text-right">
                        @if (Session::get('weblangauge') == 'kn')
                        <a href="{{ url('/popularseller') }}" class="btn">और देखो</a> @else
                        <a href="{{ url('/popularseller') }}" class="btn">View More</a> @endif
                    </div>
                </div>
            </div>

            <div class="sellerlist d-flex justify-content-start">
                <?php 
                
                foreach($popularSeller as $key=>$pSeller){
                   $rating_num = number_format((float)$pSeller['rating']['ratingAvgStar'], 2, '.', '');
                ?>
                    
                <div class="item">
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
                        <div class="rate">
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
                       
                <?php } ?>
                
           
           
           
            </div>
        </div>
    </div>





    @php @endphp 
    @foreach ($response['data'] as $item) 
        @if ($item['type'] == 'popular')

            <!--popular-product-start-->
            <section class="popular-product">
                <div class="container">

                    <div class="product-heading">
                        <div class="row align-items-center">
                            <div class="col-sm-8 col-8">
                                @if (Session::get('weblangauge') == 'kn')
                                <h2> लोकप्रिय उत्पाद </h2>

                                @else
                                <h2>Popular Products</h2>
                                @endif


                            </div>
                            <div class="col-sm-4 col-4 text-right">
                                @if (Session::get('weblangauge') == 'kn')
                                <a href="{{ url('/popularproducts') }}" class="btn">और देखो</a> @else
                                <a href="{{ url('popularproducts') }}" class="btn">View More</a> @endif
                            </div>
                        </div>
                    </div>

                    <div class="product-outer mt-md-2 mb-md-4 mt-sm-2 mb-sm-3">
                        <div class="slider popular-product-slider  text-center">
                            @foreach ($item['data'] as $item)

                            <div class="slick-slide slider-item ">
                                <div class="product-inner">
                                    <a href="{{ url('product') }}/{{ encrypt($item->id) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($item->image_1) }}" alt="popular-product-img1" />
                                        </div>
                                        <div class="product-info">
                                            <p class="item-info">{{ $item->template->name }} ({{ $item->name }})
                                            </p>
                                            <p>
                                                <?php echo ($item->id); ?>
                                            </p>
                                            <p><strong>₹{{ $item->price }}</strong></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </section>

            <!--popular-product-end-->

        @endif 
        @if ($item['type'] == 'shg-artisan')
            <!--lakshmi-enterprise-start-->
            <div class="lehangas-outer enterprise-outer">
                <div class="container">
                    <div class="product-heading">
                        <div class="row align-items-center">
                            <div class="col-sm-8 col-8">
                                <h2>{{ $item['organization_name'] }}</h2>
                            </div>
                            <div class="col-sm-4 col-4 text-right">
                                @if (Session::get('weblangauge') == 'kn')
                                <a href="{{ url('shgstrisan/' . encrypt($item['id'])) }}" class="btn">और देखो</a> @else
                                <a href="{{ url('shgstrisan/' . encrypt($item['id'])) }}" class="btn">View More</a> @endif
                            </div>
                        </div>
                    </div>

                    <div class="lehangas-product">
                        <div class="row">
        
                            @foreach ($item['data'] as $product)


                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="lehangas-product-inner d-flex align-items-center">
                                    <div class="lehanga-img">
                                        <a href="{{ url('product') }}/{{ encrypt($product['id']) }}"><img src="{{ asset($product['image_1']) }}" alt="lehanga-img1" /> </a>
                                    </div>
                                    <div class="lehanga-right">
                                        <a href="{{ url('product') }}/{{ encrypt($product['id']) }}">
                                        <p>
                                                <?php echo $product['product_id_d']; ?>
                                            </p>
                                            <p class="item-info">
                                                {{ $product['template']['name'] }} <br> ({{ $product['name'] }})
                                            </p>
                                            
                                        </a>
                                        <p><strong>₹{{ $product['price'] }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
            <div class="border-design"></div>
            <!--lakshmi-enterprise-end-->
        @endif 
        @if ($item['type'] == 'recently')
            <!--recently-added-start-->
            <section class="popular-product recently-added">
                <div class="container">

                    <div class="product-heading">
                        <div class="row align-items-center">
                            <div class="col-sm-8 col-8">
                                @if (Session::get('weblangauge') == 'kn')
                                <h2>हाल ही में जोड़ा </h2>

                                @else
                                <h2>Recently Added</h2>
                                @endif


                            </div>

                            <div class="col-sm-4 col-4 text-right">
                                @if (Session::get('weblangauge') == 'kn')
                                <a href="{{ url('/recentproducts') }}" class="btn">और देखो</a> @else
                                <a href="{{ url('recentproducts') }}" class="btn">View More</a> @endif
                            </div>
                        </div>
                    </div>

                    <div class="product-outer mt-md-2 mb-md-5 mt-sm-2 mb-sm-3">
                        <div class="slider popular-product-slider  text-center">
                            @foreach ($item['data'] as $recent)
                            <div class="slick-slide slider-item ">
                                <div class="product-inner">
                                    <a href="{{ url('product') }}/{{ encrypt($recent->id) }}">
                                        <div class="product-img">
                                            <img src="{{ asset($recent->image_1) }}" alt="popular-product-img1" />
                                        </div>
                                        <div class="product-info">
                                        <p>
                                                <?php echo $recent->product_id_d; ?>
                                            </p>
                                            <p class="item-info">{{ $recent->template->name }} ({{ $recent->name }})</p>
                                            <p>{{$recent->user->organization_name}}</p>
                                            <p><strong>₹{{ $recent->price }}</strong></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </section>
        @endif
     @endforeach



    <div class="loadresult"></div>

    <div class="mb-4 mt-4 loadbutton px-3" style="text-align: center">
        <a class="btn clickme them-btn" href="javascript:void(0)">
        @if (Session::get('weblangauge') == 'kn')
        और लोड करें
        @else
          Load More
        @endif
            
        </a>

        <a class="btn showme them-btn" href="javascript:void(0)" style="display: none">
            <img src="{{ asset('assets/images/ajax.gif') }}" />
        </a>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if ($popup)

<div class="products-popup">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <img
                                    src="assets/images/close.svg"> </button>
                </div>
                <div class="modal-body homepagepopup">
                    <div class="inner-content text-center">
                        <img src="{{ asset($popup->background_image) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).on('load', function() {
        if (document.cookie.indexOf('modal_shown=') >= 0) {
            //do nothing if modal_shown cookie is present
        } else {
            //set cookie modal_shown
            //cookie will expire when browser is closed

            $('#exampleModalCenter').modal('show');
            document.cookie = 'modal_shown=seen';

        }


    });
</script>
@endif
<script>
    var page = 1
    $(document).on('click', '.clickme', function() {
        $(this).hide();
        $('.showme').show();
        page++;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ url('/getallproduct') }}?page=" + page,
            // data: {
            //     page: page,
            // },
            dataType: "json",

            success: function(data) {
                // console.log(page);

                var html = data.data.html;
                console.log(data.data.count);

                $('.loadresult').append(html)
                $('.clickme').show();
                $('.showme').hide();

                if (data.data.count == 0) {
                    $('.loadbutton').hide();
                    $('.loadresult').append('<p style="text-align: center;"> No more seller available.</p>');
                }

            }
        });

    });
</script>

@endsection