@extends('layouts.header')
@section('title', 'Profile | UNDP')
@section('content')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
    <style>
        .slect-file-wrep .slect-file {
            z-index: 0;
        }
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

    @php
    //dd(Auth::user()->role_id);
    @endphp

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #fff;
        }

        .uplod-btn .btn-look-success {
            color: green;
            border-bottom: solid 1px #ffc3b0;
        }

    </style>

    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h1 class="text-white"></h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="profile">
            <div class="container">
                <div class="profile-info">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="user-img-blog">
                                <div class="aditya">

                                    {{-- <div class="urs-img">
                                        <img src="assets/images/urs-img.png">

                                    </div> --}}


                                    <a href='{{ url('changeprofileimage') }}'>
                                        <div class="urs-img ">
                                            {{-- @php
                                            dd(Auth::user())
                                        @endphp --}}
                                            @if (!empty(Auth::user()->profileImage))
                                                <img src="{{ asset(Auth::user()->profileImage) }}">
                                            @else
                                                <img src="{{ asset('assets/images/urs-img.png') }}">
                                            @endif
                                            <span><img src="{{ asset('assets/images/edit.svg') }}" alt="edit"> </span>
                                        </div>
                                        <a>

                                            <div class="user-info">
                                                <span>{{Session::get('weblangauge') == 'kn' ? 'नमस्ते!':'Hello!'}}</span>
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <p style="color: orange">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                                @if (Auth::check() && Auth::user()->role_id == 2)
                                                                    सीएलएफ
                                                                @elseif(Auth::check() && Auth::user()->role_id == 3)
                                                                    एसएचजी एंटरप्राइज
                                                                @elseif(Auth::check() && Auth::user()->role_id == 7)
                                                                    सरस केंद्र
                                                                @elseif(Auth::check() && Auth::user()->role_id == 8)
                                                                    विकास केंद्र
                                                                @elseif(Auth::check() && Auth::user()->role_id == 9)
                                                                    किसान
                                                                @endif
                                                    @else
                                                                @if (Auth::check() && Auth::user()->role_id == 2)
                                                                    CLF
                                                                @elseif(Auth::check() && Auth::user()->role_id == 3)
                                                                    SHG Enterprise
                                                                @elseif(Auth::check() && Auth::user()->role_id == 7)
                                                                    Saras Center
                                                                @elseif(Auth::check() && Auth::user()->role_id == 8)
                                                                    Growth Center
                                                                @elseif(Auth::check() && Auth::user()->role_id == 9)
                                                                    SHG Individual
                                                                @endif
                                                    @endif                                    
                                                </p>
                                            </div>
                                </div>
                                <a href="{{url::to('view-rating/'.encrypt(Auth::user()->id))}}">
                                    <div class="showRate">
                            <div class="d-flex justify-content-center align-items-center">    
                                <fieldset class="rating pointer-none">
                                    <input type="radio" id="star5" disabled name="ratings" value="5" {{$ratingAvgStar == 5 ? 'checked':'' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" disabled name="ratings" value="4.5" <?php echo $ratingAvgStar >= 4.5 && $ratingAvgStar < 5 ? 'checked':''; ?> /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" disabled name="ratings" value="4" <?php echo $ratingAvgStar >= 4 && $ratingAvgStar < 4.5 ? 'checked':''; ?> /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" disabled name="ratings" value="3.5" <?php echo $ratingAvgStar >= 3.5 && $ratingAvgStar < 4 ? 'checked':''; ?> /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" disabled name="ratings" value="3" <?php echo $ratingAvgStar >= 3 && $ratingAvgStar < 3.5 ? 'checked':''; ?> /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" disabled name="ratings" value="2.5" <?php echo $ratingAvgStar >= 2.5 && $ratingAvgStar < 3 ? 'checked':''; ?> /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" disabled name="ratings" value="2" <?php echo $ratingAvgStar >= 2 && $ratingAvgStar < 2.5 ? 'checked':''; ?> /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" disabled name="ratings" value="1.5" <?php echo $ratingAvgStar >= 1.5 && $ratingAvgStar < 2 ? 'checked':''; ?> /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" disabled name="ratings" value="1" <?php echo $ratingAvgStar >= 1 && $ratingAvgStar < 1.5 ? 'checked':''; ?> /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" disabled name="ratings" value="0.5" <?php echo $ratingAvgStar >= 0.5 && $ratingAvgStar < 1 ? 'checked':''; ?> /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                <span>{{$ratingAvgStar}}({{$reviewCount}})</span>
                            </div>
                            <div>{{$ratingAvgStar}} {{Session::get('weblangauge') == 'kn' ? ' (5) में से':'out of 5'}}</div>
                            </div>
                            </a>
                                <ul>
                                    @if (Session::get('weblangauge') == 'kn')
                                        <li><a href="{{ url('/changemobileno') }}">मोबाइल नंबर बदलें</a></li>
                                        <li><a href="{{ url('/changeaddress') }}">पता बदल जाना</a></li>
                                        @if (Auth::user()->role_id == '9')
                                            <li><a href="{{ url('/additional-info') }}">अतिरिक्त जानकारी</a></li>
                                        @endif
                                        <li><a href="{{ url('/changepassword') }}">पासवर्ड बदलें</a></li>
                                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">लॉग आउट</a></li>
                                    @else
                                        <li><a href="{{ url('/changemobileno') }}">Change Mobile Number</a></li>
                                        <li><a href="{{ url('/changeaddress') }}">Change Address</a></li>
                                        @if (Auth::user()->role_id == '9')
                                            <li><a href="{{ url('/additional-info') }}">Additional Information</a></li>
                                        @endif
                                        <li><a href="{{ url('/changepassword') }}">Change Password</a></li>
                                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                                    @endif
                                    <form id="logout-form"
                                        action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                                @if (Auth::user()->role_id != '1')
                                    {{-- <div class="btn-block btn-block-10">
                                        <a href="#0" class="them-btn" data-toggle="modal" data-target="#delete-profile">
                                            @if (Session::get('weblangauge') == 'kn') 
                                            प्रोफ़ाइल हटाएं   
                                            @else Delete Profile @endif
                                        </a>
                                    </div> --}}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="profile-form">
                                <form method="POST" action="{{ url('editprofile') }}">
                                    @csrf

                                    @if (Session::get('weblangauge') == 'kn')
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h3>प्रोफ़ाइल विवरण</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-block text-right">
                                                    <div class="form-group">
                                                        <button type="submit" id="" class="them-btn">प्रोफ़ाइल को नवीनतम बनाओ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    @else


                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h3>Profile details</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="btn-block text-right">
                                                    <div class="form-group">
                                                        <button type="submit" id="" class="them-btn">Update Profile</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all(':message') as $error)
                                                {{ $error }}
                                            @endforeach
                                        </div>
                                    @endif

                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif

                                    <div class="row row-2">

                                        <div class="col-md-6">
                                            <div class="form-group form-group-2">
                                                
                                                @if (Session::get('weblangauge') == 'kn')
                                                    <label class="lebul-style">नाम</label>
                                                @else
                                                    <label class="lebul-style">Name</label>
                                                @endif
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group form-group-2">
                                                @if (Session::get('weblangauge') == 'kn')
                                                    <label class="lebul-style">ईमेल</label>
                                                @else
                                                    <label class="lebul-style">Email</label>
                                                @endif
                                                <input type="" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        @php
                                            // dd(Auth::user()->role_id);
                                        @endphp

                                       
                                        @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3')

                                            {{-- <div class="col-md-6">
                                                <div class="form-group form-group-2">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                        <label class="lebul-style">शीर्षक</label>
                                                    @else
                                                        <label class="lebul-style">Title</label>
                                                    @endif
                                                    <input type="" name="title" class="form-control"
                                                        value="{{ Auth::user()->title }}">
                                                </div>
                                            </div> --}}
                                        @endif

                                        

                                        <div class="col-md-6">
                                            <div class="form-group form-group-2">
                                                @if (Session::get('weblangauge') == 'kn')
                                                    <label class="lebul-style">मोबाइल नंबर.</label>
                                                @else
                                                    <label class="lebul-style">Mobile No.</label>
                                                @endif
                                                <input disabled type="text" name="mobile" class="form-control"
                                                    value="{{ Auth::user()->mobile }}">
                                            </div>
                                        </div>
                                        

                                        @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3' || Auth::user()->role_id == '9')
                                            <div class="col-md-12">
                                                <div class="form-group form-group-2">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                        <label class="lebul-style">पता</label>


                                                    @else
                                                        <label class="lebul-style">Address</label>
                                                    @endif
                                                    <?php 
                                                        $block_name = "";
                                                        if(Auth::user()->block){
                                                            $block_id = Auth::user()->block; 
                                                            $language = Session::get('weblangauge');
                                                            $name = 'name';
                                                            if($language == 'kn') {
                                                                $name = 'name_kn as name';
                                                            }
                                                            $block_name = \App\Block::where(['id' => $block_id])->where('status', 0)->select($name)->first()->name;
                                                        }
                                                        
                                                    ?>
                                                    {{-- <input type="tex" name="" class="form-control"
                                                        value="{{ $address['registered']['address_line_one'] }}, {{ $address['registered']['district'] }}, {{ $address['registered']['state'] }}, {{ $address['registered']['country'] }}, Pin : {{ $address['registered']['pincode'] }}"
                                                        disabled> --}}
                                                        <input type="text" name="" class="form-control" value="@if (isset($address['registered']['address_line_one']) !=
                                                    null) {{ isset($address['registered']['address_line_one'])?$address['registered']['address_line_one']:'' }}, {{$block_name}}, {{ isset(Auth::user()->userBlock->name)?Auth::user()->userBlock->name:'' }}, @endif{{ isset(Auth::user()->city->name)?Auth::user()->city->name:'' }},{{ isset(Auth::user()->state->name)?Auth::user()->state->name:'' }}, {{ isset(Auth::user()->country->name)?Auth::user()->country->name:'' }}@if (isset($address['registered']['pincode']) != null), Pin :{{ isset($address['registered']['pincode'])?$address['registered']['pincode']:'' }}@endif" disabled>

                                                </div>
                                            </div>
                                        @endif


                                        @if (Auth::user()->role_id == '1')
                                            <div class="col-md-12">
                                                <div class="form-group form-group-2">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                        <label class="lebul-style">पता</label>
                                                    @else
                                                      <label class="lebul-style">Address</label>
                                                    @endif
                                                    
                                                
                                                    <input type="tex" name="" class="form-control" value="@if (isset(Auth::user()->address_personal->address_line_one) !=
                                                    null) {{ isset(Auth::user()->address_personal->address_line_one)?Auth::user()->address_personal->address_line_one:'' }}, @endif{{ isset(Auth::user()->city->name)?Auth::user()->city->name:'' }},{{ isset(Auth::user()->state->name)?Auth::user()->state->name:'' }}, {{ isset(Auth::user()->country->name)?Auth::user()->country->name:'' }}@if (isset(Auth::user()->address_personal->pincode) != null), Pin :{{ Auth::user()->address_personal->pincode }}@endif" disabled>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </form>
                            </div>



                            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8  || Auth::user()->role_id == 9)

                                <div class="profile-form sytle-2 sytle-3 mt-3">
                                    <form method="POST">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="form-group form-group-2">
                                                    @if (Session::get('weblangauge') == 'kn')
                                                        <h3>दस्तावेज़</h3>
                                                    @else
                                                        <h3>Documents</h3>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row row-2">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-5">
                                                    <div class="slect-file-wrep style-3">
                                                        <div class="position-relative">
                                                            <p class="slect-file">
                                                            <div class="uplod-btn">
                                                                @if (Session::get('weblangauge') == 'kn')
                                                                    <span>आधार कार्ड</span>
                                                                @else
                                                                    <span>Aadhar card</span>
                                                                @endif
                                                                @if (Auth::user()->document->is_adhar_verify == 1)
                                                                    <span class="btn-look-success">
                                                                        @if (Session::get('weblangauge') == 'kn')
                                                                            सत्यापित
                                                                        @else
                                                                            Verified
                                                                        @endif
                                                                    </span>
                                                                @elseif(Auth::user()->document->is_adhar_verify == 2)   
                                                                    <a href="{{ '/uploaddocument/aadhar' }}">
                                                                        <span class="btn-look">
                                                                            @if (Session::get('weblangauge') == 'kn')
                                                                                अस्वीकृत, अपलोड के लिए क्लिक करें
                                                                            @else
                                                                                Rejected, Click To Upload
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                @elseif(Auth::user()->document->is_adhar_verify == 0 && Auth::user()->document->adhar_card_front_file != null)
                                                                    <span class="btn-look">
                                                                        @if (Session::get('weblangauge') == 'kn')
                                                                            विचाराधीन
                                                                        @else
                                                                            Pending
                                                                        @endif
                                                                    </span>
                                                                @else
                                                                    <a href="{{ '/uploaddocument/aadhar' }}">
                                                                        <span class="btn-look">
                                                                            @if (Session::get('weblangauge') == 'kn')
                                                                                अपलोड करें
                                                                            @else
                                                                                Upload Document
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->document->adhar_card_front_file && Auth::user()->document->adhar_card_back_file)
                                                                    <div class="col-sm-2">
                                                                        
                                                                                    <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->adhar_card_front_file) }}" title="" alt="Card image cap">
                                                                                        <img class="card-img-top" src="{{ asset(Auth::user()->document->adhar_card_front_file) }}">
                                                                                    </a>
                                                                                
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                                    <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->adhar_card_back_file) }}" title="" alt="Card image cap">
                                                                                        <img class="card-img-top" src="{{ asset(Auth::user()->document->adhar_card_back_file) }}">
                                                                                    </a>
                                                                                
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @php
                                            echo Auth::user()->role_id;
                                            @endphp --}}
                                            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8)
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-5">
                                                        <div class="slect-file-wrep style-3">
                                                            <div class="position-relative">
                                                                <p class="slect-file">
                                                                    @if (Session::get('weblangauge') == 'kn')
                                                                        <div class="uplod-btn">
                                                                            <span>पैन कार्ड</span>
                                                                            @if (Auth::user()->document->is_pan_verify == 1)
                                                                                <span class="btn-look-success">
                                                                                सत्यापित
                                                                                </span>
                                                                            @elseif(Auth::user()->document->is_pan_verify == 2)
                                                                                <a href="{{ '/uploaddocument/pan' }}">
                                                                                    <span class="btn-look">
                                                                                        अस्वीकृत,अपलोड के लिए क्लिक करें
                                                                                    </span>
                                                                                </a>
                                                                            @elseif(Auth::user()->document->is_pan_verify == 0 && Auth::user()->document->pancard_file != null)
                                                                                <span class="btn-look">विचाराधीन</span>
                                                                            @else
                                                                                <a href="{{ '/uploaddocument/pan' }}">
                                                                                    <span class="btn-look">
                                                                                    अपलोड करें
                                                                                    </span>
                                                                                </a>
                                                                            @endif

                                                                            @if (Auth::user()->document->pancard_file)
                                                                                <div class="col-sm-2">
                                                                                    
                                                                                                <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->pancard_file) }}" title="" alt="Card image cap">
                                                                                                    <img class="card-img-top" src="{{ asset(Auth::user()->document->pancard_file) }}">
                                                                                                </a>
                                                                                            
                                                                                </div>
                                                                                
                                                                            @endif

                                                                        </div>

                                                                    @else

                                                                        <div class="uplod-btn">
                                                                            <span>Pan Card</span>
                                                                            @if (Auth::user()->document->is_pan_verify == 1)
                                                                                <span class="btn-look-success">
                                                                                    Verified
                                                                                </span>
                                                                            @elseif(Auth::user()->document->is_pan_verify == 2)
                                                                                <a href="{{ '/uploaddocument/pan' }}">
                                                                                    <span class="btn-look">
                                                                                        Rejected, Click To Upload
                                                                                    </span>
                                                                                </a>
                                                                            @elseif(Auth::user()->document->is_pan_verify == 0 && Auth::user()->document->pancard_file != null)
                                                                                <span class="btn-look">Pending</span>
                                                                            @else
                                                                                <a href="{{ '/uploaddocument/pan' }}">
                                                                                    <span class="btn-look">
                                                                                    Upload Document
                                                                                    </span>
                                                                                </a>
                                                                            @endif

                                                                            @if (Auth::user()->document->pancard_file)
                                                                                <div class="col-sm-2">
                                                                                    
                                                                                                <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->pancard_file) }}" title="" alt="Card image cap">
                                                                                                    <img class="card-img-top" src="{{ asset(Auth::user()->document->pancard_file) }}">
                                                                                                </a>
                                                                                            
                                                                                </div>
                                                                                
                                                                            @endif

                                                                        </div>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8)
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-5">
                                                            <div class="slect-file-wrep style-3">
                                                                <div class="position-relative">
                                                                    <p class="slect-file">
                                                                        @if (Session::get('weblangauge') == 'kn')
                                                                            <div class="uplod-btn">
                                                                                <span>बीआरएन</span>
                                                                                @if (Auth::user()->document->is_brn_verify == 1)
                                                                                    <span class="btn-look-success">
                                                                                    सत्यापित
                                                                                    </span>
                                                                                @elseif(Auth::user()->document->is_brn_verify == 2)
                                                                                    <a href="{{ '/uploaddocument/brn' }}">
                                                                                        <span class="btn-look">
                                                                                        अस्वीकृत, अपलोड के लिए क्लिक करें
                                                                                        </span>
                                                                                    </a>
                                                                                @elseif(Auth::user()->document->is_brn_verify == 0 && Auth::user()->document->brn_file != null)
                                                                                    <span class="btn-look">
                                                                                        विचाराधीन
                                                                                    </span>
                                                                                @else
                                                                                    <a href="{{ '/uploaddocument/brn' }}">
                                                                                        <span class="btn-look">
                                                                                        अपलोड करें
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                                
                                                                                @if (Auth::user()->document->brn_file)
                                                                                    <div class="col-sm-2">
                                                                                        
                                                                                                    <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->brn_file) }}" title="" alt="Card image cap">
                                                                                                        <img class="card-img-top" src="{{ asset(Auth::user()->document->brn_file) }}">
                                                                                                    </a>
                                                                                                
                                                                                    </div>
                                                                                    
                                                                                @endif
                                                                                
                                                                            </div>
                                                                        @else
                                                                            <div class="uplod-btn">
                                                                                <span>BRN</span>
                                                                                @if (Auth::user()->document->is_brn_verify == 1)
                                                                                    <span class="btn-look-success">
                                                                                        Verified
                                                                                    </span>
                                                                                @elseif(Auth::user()->document->is_brn_verify == 2)
                                                                                    <a href="{{ '/uploaddocument/brn' }}">
                                                                                        <span class="btn-look">
                                                                                            Rejected, Click To Upload
                                                                                        </span>
                                                                                    </a>
                                                                                @elseif(Auth::user()->document->is_brn_verify == 0 && Auth::user()->document->brn_file != null)
                                                                                    <span class="btn-look">
                                                                                        Pending
                                                                                    </span>
                                                                                @else
                                                                                    <a href="{{ '/uploaddocument/brn' }}">
                                                                                        <span class="btn-look">
                                                                                        Upload Document
                                                                                        </span>
                                                                                    </a>
                                                                                @endif
                                                                                @if (Auth::user()->document->brn_file)
                                                                                    <div class="col-sm-2">
                                                                                        
                                                                                                    <a class="image-popup-vertical-fit" href="{{ asset(Auth::user()->document->brn_file) }}" title="" alt="Card image cap">
                                                                                                        <img class="card-img-top" src="{{ asset(Auth::user()->document->brn_file) }}">
                                                                                                    </a>
                                                                                                
                                                                                    </div>
                                                                                    
                                                                                @endif

                                                                            </div>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif

                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (Auth::user()->role_id != '1')
            <form method="POST" action="{{ url('deleteprofile ') }}">
                @csrf
                @if (Session::get('weblangauge') == 'kn')
                    <div class="modal fade product-add" id="delete-profile" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <h3>प्रोफ़ाइल हटाएं</h3>
                                    <p class="mt-2">क्या आप वाकई प्रोफ़ाइल हटाना चाहते हैं?</p>
                                    <p class="mb-3">आपका सारा डेटा हटा दिया जाएगा</p>


                                    {{-- <select required name="reason" class="form-control">
                                        <option> -Select Reason- </option>
                                        <option value="reason1"> -Reason1- </option>
                                        <option value="reason2"> -Reason2- </option>
                                        <option value="reason3"> -Reason3- </option>
                                    </select> --}}
                                    <br>

                                    <button type="submit" class="btn them-btn">ಹೌದು</button>
                                    <a data-dismiss="modal" href="#0" class="btn them-btn">ಇಲ್ಲ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                    <div class="modal fade product-add" id="delete-profile" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <h3>Delete Profile</h3>
                                    <p class="mt-2">Are you sure you want to delete profile?</p>
                                    <p class="mb-3">All your data will be deleted</p>

                                    {{-- <select required name="reason" class="form-control">
                                        <option value=""> -Select Reason- </option>
                                        <option value="reason1"> -Reason1- </option>
                                        <option value="reason2"> -Reason2- </option>
                                        <option value="reason3"> -Reason3- </option>
                                    </select> --}}
                                    <br>

                                    <button type="submit" class="btn them-btn">Yes</button>
                                    <a data-dismiss="modal" href="#0" class="btn them-btn">No</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        @endif



    @endsection

    <script>
        $("#editbtn").click(function(e) {
            alert('submit intercepted');
            e.preventDefault();
            $(this).addClass("update");
        });

    </script>
