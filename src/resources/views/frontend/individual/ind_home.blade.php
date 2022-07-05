@extends('layouts.header')
@section('title', $user_name . ' | UNDP')
@section('content')
<div class="main">
    <div class="product-banner">
        <div class="container">
            <div class="popSeller">
                <div class="product-heading white">
                <div class="row align-items-center">
                    <div class="col-sm-8 col-8">
                        <h2>{{Session::get('weblangauge') == 'kn' ? 'मंगनी करने वाला विक्रेता':'Matchmaking Seller'}}</h2>
                    </div>
                    <div class="col-sm-4 col-4 text-right">
                        {{-- <a href="#" class="btn">View More</a> --}}
                    </div>
                </div>
                </div>
                <div class="chat-slider">
                    @forelse ($data['matchingUser'] as $matchingUser)
                    @if ($loop->index == 100)
                        @break
                    @endif                        
                        <div class="chat-slider-item">
                            <a href="{{url::to('ind-profile/'.encrypt($matchingUser->id))}}">
                            <div class="sellerCard shadow">
                                <div class="image-box">
                                    @if($matchingUser->profileImage)
                                        <img src="{{ asset($matchingUser->profileImage)}}" class="img-fluid" alt="" />
                                    @else
                                        <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                    @endif
                                </div>
                                <div class="detail-box">
                                    <div class="title">{{$matchingUser->name}}</div>
                                    <div class="btnWrap">
                                        <a href="{{url::to('ind-chat?id='.encrypt($matchingUser->id))}}" class="btn btn-lg btn-light-orange btn-block"><img src="assets/images/chat-icon.svg" alt="">{{Session::get('weblangauge') == 'kn' ? 'चैट':'Chat'}}</a>
                                    </div>
                                </div>
                            </div>        
                        </div>
                        </a>
                    @empty
                        <p>{{Session::get('weblangauge') == 'kn' ? 'कोई उपयोगकर्ता नहीं':'No users'}}</p>                    
                    @endforelse
                </div>
            </div>
        </div>

    </div>
    <div class="main-content">
        <div class="container">
            <div class="product-heading">
                <div class="row align-items-center">
                    <div class="col-sm-8 col-8">
                        <h2>{{Session::get('weblangauge') == 'kn' ? 'मेरे पसंदीदा व्यक्ति':'My Favourite Individuals'}}</h2>
                    </div>
                    <div class="col-sm-4 col-4 text-right">
                        <!-- <a href="#" class="btn">View More</a> -->
                    </div>
                </div>
            </div>

            <div class="myFavourite">
                <div class="row">
                @forelse($data['favUser'] as $favUser)
                        <div class="col-lg-4 col-sm-6">
                            <div class="individualCard d-flex justify-content-between align-items-center">
                                <div class="left-box d-flex justify-content-start align-items-center">
                                    <div class="image">
                                        @if($favUser->profileImage)
                                            <img src="{{ asset($favUser->profileImage)}}" class="img-fluid" alt="" />
                                        @else
                                            <img src="{{ asset('public/images/dummy.jpg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="name">{{$favUser->name}}</div>
                                </div>
                                <div class="right-box"><a href="{{url::to('ind-chat?id='.encrypt($favUser->id))}}" class="btn btn-lg btn-light-orange btn-block"><img src="assets/images/chat-icon.svg" alt="">{{Session::get('weblangauge') == 'kn' ? 'चैट':'Chat'}}</a></div>
                            </div>
                        </div>
                @empty
                    <p></p>                    
                @endforelse    
                    
                    
                </div>
            </div>
        </div>
    </div>
    


@endsection
