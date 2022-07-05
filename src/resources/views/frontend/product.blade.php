@extends('layouts.header')
@section('title', $productdetail['name'] . ' | UNDP')
@section('content')

    <section class="jute-bag">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="jute-slider">

                        @if ($productdetail['image_1'] != null)
                            <div class="slid-item"><img class="img-fluid" src="{{ asset($productdetail['image_1']) }}"></div>
                        @endif

                        @if ($productdetail['image_2'] != null)
                            <div class="slid-item"><img class="img-fluid" src="{{ asset($productdetail['image_2']) }}"></div>
                        @endif
                        @if ($productdetail['image_3'] != null)
                            <div class="slid-item"><img class="img-fluid" src="{{ asset($productdetail['image_3']) }}"></div>
                        @endif
                        @if ($productdetail['image_4'] != null)
                            <div class="slid-item"><img class="img-fluid" src="{{ asset($productdetail['image_4']) }}"></div>
                        @endif
                        @if ($productdetail['image_5'] != null)
                            <div class="slid-item"><img class="img-fluid" src="{{ asset($productdetail['image_5']) }}"></div>
                        @endif

                        @if ($productdetail['video_url'] != null)
                            <div class="slid-item">
                                <div class="ytdiv">
                                    <iframe height="auto" width="100%" class="ytvdo" id="myIframe"
                                        src="{{ asset($productdetail['video_url']) }}"></iframe>
                                </div>
                            </div>
                        @endif

                    </div>
                    <input type="hidden" class="yt" value="{{ $productdetail['video_url'] }}" />
                    <div class="nave-slider">

                        @if ($productdetail['image_1'] != null)
                            <div class="nev-slid-item"><img src="{{ asset($productdetail['image_1']) }}"></div>
                        @endif

                        @if ($productdetail['image_2'] != null)
                            <div class="nev-slid-item"><img src="{{ asset($productdetail['image_2']) }}"></div>
                        @endif
                        @if ($productdetail['image_3'] != null)
                            <div class="nev-slid-item"><img src="{{ asset($productdetail['image_3']) }}"></div>
                        @endif
                        @if ($productdetail['image_4'] != null)
                            <div class="nev-slid-item"><img src="{{ asset($productdetail['image_4']) }}"></div>
                        @endif
                        @if ($productdetail['image_5'] != null)
                            <div class="nev-slid-item"><img src="{{ asset($productdetail['image_5']) }}"></div>
                        @endif

                        @if ($productdetail['video_url'] != null)
                            <div class="nev-slid-item">
                                <img class="ytvdoid" src="">
                            </div>
                        @endif



                    </div>
                </div>
                <div class="col-md-7">
                    <div class="jute-info">
                        <div class="row align-items-start">
                            <div class="col-md-12">
                                <h2>{{ $productdetail['template_name'] }}({{ $productdetail['name'] }})
                                </h2>
                                @if (Session::get('weblangauge') == 'kn')
                                    <p>{{ $productdetail['category']['name_kn'] }} | {{ $productdetail['subcategory']['name_kn'] }}</p>
                                @else
                                    <p>{{ $productdetail['category']['name_en'] }} | {{ $productdetail['subcategory']['name_en'] }}</p>
                                @endif
                                <p>
                                    @if (Session::get('weblangauge') == 'kn')
                                        @if ($productdetail['length'] != null)
                                            लंबाई : {{ $productdetail['length'] }}
                                            {{ $productdetail['length_unit'] }}
                                            <br>
                                        @endif
                                        @if ($productdetail['width'] != null)
                                            चौड़ाई : {{ $productdetail['width'] }} {{ $productdetail['width_unit'] }}
                                            <br>
                                        @endif

                                        @if ($productdetail['height'] != null)
                                            ऊंचाई : {{ $productdetail['height'] }}
                                            {{ $productdetail['height_unit'] }}
                                            <br>
                                        @endif

                                        @if ($productdetail['vol'] != null)
                                            आयतन : {{ $productdetail['vol'] }} {{ $productdetail['vol_unit'] }} <br>
                                        @endif

                                        @if ($productdetail['weight'] != null)
                                            वज़न : {{ $productdetail['weight'] }}
                                            {{ $productdetail['weight_unit'] }}
                                        @endif

                                    @else


                                        @if ($productdetail['length'] != null)
                                            Length : {{ $productdetail['length'] }}
                                            {{ $productdetail['length_unit'] }}
                                            <br>
                                        @endif
                                        @if ($productdetail['width'] != null)
                                            Width : {{ $productdetail['width'] }} {{ $productdetail['width_unit'] }}
                                            <br>
                                        @endif

                                        @if ($productdetail['height'] != null)
                                            Height : {{ $productdetail['height'] }}
                                            {{ $productdetail['height_unit'] }}
                                            <br>
                                        @endif

                                        @if ($productdetail['vol'] != null)
                                            Volume : {{ $productdetail['vol'] }} {{ $productdetail['vol_unit'] }} <br>
                                        @endif

                                        @if ($productdetail['weight'] != null)
                                            Weight : {{ $productdetail['weight'] }}
                                            {{ $productdetail['weight_unit'] }}
                                        @endif
                                    @endif



                                </p>
                            </div>

                        </div>
                        <div class="row align-items-center">
                            <div class="price col-4">
                                <span>&#8377;{{ $productdetail['price'] }}/{{ $productdetail['price_unit'] }}</span>
                            </div>


                            @if (Auth::user() && $productdetail['artisanid'] == Auth::user()->id)
                                <div class="price col-8">
                                    <div class="btn-block text-right">
                                        <a href="{{ url('editproduct') }}/{{ encrypt($productdetail['id']) }}"
                                            class="them-btn them-btn-2 product-btn mr-2">{{Session::get('weblangauge') == 'kn' ? 'संपादित करें':'Edit'}}</a>
                                        <!-- <a onclick="return confirm('Are you sure?')"
                                            href="{{ url('deleteproduct') }}/{{ encrypt($productdetail['id']) }}"
                                            class="them-btn them-btn-2 product-btn">Delete</a> -->
                                    </div>
                                </div>
                            @endif



                            <div class="right-btn col-8">

                                @if (Auth::user() && $productdetail['artisanid'] == Auth::user()->id)
                                @else
                                    {{-- @if (app('request')->input('from') != 'art') --}}
                                           
                                            <a href="{{ url('shgstrisan') }}/{{ encrypt($productdetail['artisanid'])  }}"
                                                class="them-btn them-btn-2 product-btn">{{ Session::get('weblangauge') == 'kn' ? 'विक्रेता की प्रोफ़ाइल' : 'Seller Profile' }}</a>
                                            @if (Auth::check() && Auth::user()->role_id == 1)
                                                <a href="{{url('express-interest')}}/{{ encrypt($productdetail['artisanid']) }}" class="them-btn them-btn-2 product-btn">{{ Session::get('weblangauge') == 'kn' ? 'रुचि व्यक्त करें' : 'Express Interest' }}</a>
                                            @else
                                                <a href="{{url('login')}}" class="them-btn them-btn-2 product-btn">{{ Session::get('weblangauge') == 'kn' ? 'रुचि व्यक्त करें' : 'Express Interest' }}</a>
                                            @endif
                                    {{-- @endif --}}
                                @endif

                            </div>
                        </div>


                        <ul class="special-list">
                            {{-- <li>
                                <div class="info">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <span>द्वारा: &nbsp;</span>
                                    @else
                                        <span>By: &nbsp;</span>
                                    @endif
                                    <h6>{{ $productdetail['artisanshgname'] }}</h6>
                                </div>
                            </li>
                            <li>
                                <div class="info">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <span>का बना हुआ: &nbsp;</span>
                                    @else
                                        <span>Made with: &nbsp;</span>
                                    @endif


                                    <h6>{{ $productdetail['materialname'] }}</h6>
                                </div>
                            </li> --}}
                            <li>
                                <div class="info">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <span>उपलब्ध: &nbsp;</span>
                                    @else
                                        <span>Available: &nbsp;</span>
                                    @endif

                                    <h6>{{ $productdetail['qty'] }} {{ $productdetail['price_unit'] }}</h6>
                                </div>
                            </li>
                        </ul>
                        <div class="info">
                         @if (Session::get('weblangauge') == 'kn')
                            <span>विवरण: &nbsp;</span>
                        @else
                            <span>Description: &nbsp;</span>
                        @endif
                            <p>{{ $productdetail['description'] }}</p>

                        </div>
                    </div>
                </div>
            </div>
        @if (Auth::user())
            @if ($productdetail['certificate_data'])
            <div class="certificates">
                <h5 class="mb-3">Certifications</h5>
                <div class="row">
                    @if ($productdetail['certificate_data']->certificate_image_1 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card certificateCard">
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_1) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_1) }}" >
                                    </a>
                                    
                        
                            <div class="card-body">
                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_1 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_1 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_1 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_1 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                </li>
                                
                                

                            </ul>
                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_2 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card  certificateCard" style="">
                                    {{-- <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_2) }}" alt="Card image cap"> --}}
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_2) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_2) }}" >
                                    </a>
                            <div class="card-body">

                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_2 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_2 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_2 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_2 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                            
                                </li>
                                

                            </ul>

                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_3 != '')
                    <div class="col-sm-4 col-6 col-md-2">

                        <div class="card  certificateCard" style="">
                                    {{-- <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_3) }}" alt="Card image cap"> --}}
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_3) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_3) }}" >
                                    </a>
                        
                            <div class="card-body">
                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_3 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_3 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_3 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_3 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                            
                                </li>

                            </ul>
                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_4 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card certificateCard" style="">
                                    {{-- <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_4) }}" alt="Card image cap"> --}}
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_4) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_4) }}" >
                                    </a>
                            <div class="card-body">

                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_4 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_4 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_4 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_4 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                </li>
                                

                            </ul>

                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_5 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card certificateCard" style="">
                                    {{-- <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_5) }}" alt="Card image cap"> --}}
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_5) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_5) }}" >
                                    </a>
                            <div class="card-body">

                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_5 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_5 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_5 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_5 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>

                                </li>

                            </ul>

                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_6 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card certificateCard" style="">
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_6) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_6) }}" >
                                    </a>
                                    
                        
                            <div class="card-body">
                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_6 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_6 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_6 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_6 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                </li>
                                

                            </ul>
                        </div>
                    </div>
                    @endif
                    @if ($productdetail['certificate_data']->certificate_image_7 != '')
                    <div class="col-sm-4 col-6 col-md-2">
                        <div class="card certificateCard" style="">
                                    <a class="image-popup-vertical-fit" href="{{ asset( $productdetail['certificate_data']->certificate_image_7) }}" title="" alt="Card image cap">
                                        <img class="card-img-top" height="200" src="{{ asset( $productdetail['certificate_data']->certificate_image_7) }}" >
                                    </a>
                                    
                        
                            <div class="card-body">
                            </div>
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">
                                            <b>
                                            @if(Session::get('weblangauge') == 'kn')
                                                @if ($productdetail['certificate_data']->certificate_status_7 == 1)
                                                    <p style="color: green">सत्यापित</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_7 == 2)
                                                    <p style="color: red">अस्वीकृत</p>
                                                    @else
                                                    <p style="color: orange">लंबित</p>
                                                @endif
                                            @else
                                                @if ($productdetail['certificate_data']->certificate_status_7 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($productdetail['certificate_data']->certificate_status_7 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            @endif
                                                
                                            </b>
                                </li>
                                

                            </ul>
                        </div>
                    </div>
                    @endif

                </div>
                </div>
            @endif
        @endif
        </div>
    </section>

    <style>
        p.sbtext {
            font-size: 11px;
            float: left;
            color: gray;
            margin-left: 5px;
            margin-top: 2px;
        }

    </style>
    <div class="modal fade product-add" id="delete-profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3>I am interested</h3>

                    <form method="POST" action="{{ url('expressintrest') }}">
                        @csrf

                        <input type="hidden" name="shgartisanid" value="{{ $productdetail['artisanid'] }}" />
                        <input type="hidden" name="productId" value="{{ encrypt($productdetail['id']) }}" />
                        <input type="hidden" name="shgartisanMobile" value="{{ $productdetail['artisanmobile'] }}" />


                        <textarea maxlength="100" name="message" class="form-control"
                            placeholder="Please Type your message For SHG/Atrisan" required></textarea>
                        <p class="sbtext">100 char only</p>
                        <br>
                        <button type="submit" class="form-control btn them-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="../assets/js/bootstrap.min.js"></script> --}}
    <script type="text/javascript" src="../assets/js/slick.min.js"></script>
    {{-- <script src="../assets/js/script.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            var url = $('.yt').val();

            url = url.replace("youtu.be", "youtube.com/embed");
            $('.yt').val(url);
            $('.ytvdo').prop('src', url);
            var urlId = youtube_parser(url);

            var url = "https://www.youtube.com/embed/" + urlId;
            $('#myIframe').attr('src', url)


            var newURL = "https://img.youtube.com/vi/" + urlId + "/0.jpg";
            //alert(newURL)
            $('.ytvdoid').prop('src', newURL)

        });

        function youtube_parser(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
            var match = url.match(regExp);
            return (match && match[7].length == 11) ? match[7] : false;
        }



        // $('.slider-for').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     arrows: false,
        //     fade: true,
        //     asNavFor: '.slider-nav'
        // });
        // $('.slider-nav').slick({
        //     slidesToShow: 3,
        //     infinite: false,
        //     slidesToScroll: 1,
        //     asNavFor: '.slider-for',
        //     dots: true,
        //     centerMode: true,
        //     focusOnSelect: true
        // });



        $('.jute-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            infinite: false,
            asNavFor: '.nave-slider'
        });
        $('.nave-slider').slick({
            slidesToShow: 4,
            infinite: false,
            slidesToScroll: 1,
            asNavFor: '.jute-slider',
            dots: true,
            centerPadding: '0px',
            centerMode: false,
            focusOnSelect: true,
            useTransform: false
        });

    </script>
@endsection
