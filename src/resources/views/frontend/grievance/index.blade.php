@extends('layouts.header') @section('title', 'Grievance | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white mb-3">{{Session::get('weblangauge') == 'kn' ? 'शिकायत':'Grievance'}}</h1>
                    <a href="{{URL::to('raise-ticket')}}" class="btn btn-lg btn-orange"><img src="assets/images/add-circle-icon.svg" alt="">{{Session::get('weblangauge') == 'kn' ? 'टिकट रेज करे':'Raise Ticket'}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1">
        <div class="container">
            <div class="row">
            
                @foreach($grievanceList as $key=>$value)
                <div class="col-lg-4 col-sm-6 col-12">
                <a href="{{URL::to('grievance-chat/'.encrypt($value->id))}}" class="text-dark">
                    <div class="orderCard ticket style-2">
                        <div class="ticket-row d-flex justify-content-between align-items-center">
                            <div class="left-part">
                                {{Session::get('weblangauge') == 'kn' ? 'टिकट संख्या:':'Ticket no.:'}} <b>{{$value->ticket_id}}</b>
                            </div>
                            <div class="right-part">
                            @if(Session::get('weblangauge') == 'kn')
                                <span class='btn-open'>  {{$value->status == 0?'खुला है':'बंद'}} </span>
                            @else
                                <span class='btn-open'>  {{$value->status == 0?'OPEN':'CLOSE'}} </span>
                            @endif
                            </div>
                        </div>
                        <div class="title">{{$value->message}}</div>
                        <div class="createDate">
                            {{Session::get('weblangauge') == 'kn' ? 'बनाया गया:':'Created on:'}} <b>{{date('j M Y g:i A', strtotime($value->created_at))}}</b>
                        </div>
                    </div>
                    </a>
                </div>
                
               @endforeach
            </div>
        </div>
    </div>

   


    @endsection