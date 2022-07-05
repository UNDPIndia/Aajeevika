@extends('layouts.header') @section('title', 'Grievance | UNDP') @section('content')
<div class="main">
    <div class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1 class="text-white">{{Session::get('weblangauge') == 'kn' ? 'शिकायत':'Grievance'}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content bg-style-1 bg-light-gray">
        <div class="container">
            <form action="{{url::to('/raise-ticket')}}" method="post" >
            @csrf
            <div class="whiteCard w-480">
               <div class="inner">
                   <div class="form-group">
                       <select name="issue_type_id" class="form-control" id="" required>
                           <option value=''>{{Session::get('weblangauge') == 'kn' ? 'समस्या का चयन करें *':'Select Issue *'}}</option>
                           @foreach($typeList as $val)
                           <option value="{{$val->id}}">{{$val->name}}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group">
                       <textarea name="message" id="" class="form-control" rows="10" required placeholder="{{Session::get('weblangauge') == 'kn' ? 'अपनी चिंता स्पष्ट करें *':'Explain Your Concern *'}}"></textarea>
                   </div>
                   <input type="submit" class="btn btn-orange btn-xl btn-block" value="{{Session::get('weblangauge') == 'kn' ? 'प्रश्न सबमिट करें':'Submit Query'}}" />
               </div>
        </form>
            </div>
        </div>
    </div>

    


    @endsection