@extends('layouts.header')
@section('title', 'Change Mobile No | UNDP')
@section('content')
    <div class="main">
        <section class="upload-sec">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all(':message') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <form enctype="multipart/form-data" action="{{ url('/changemobileno') }}" method="POST">
                    @csrf
                    <div class="upload-doc">
                        <div class="hed-aadhar">
                            <div class="them-img">
                                <img src="assets/images/location5.svg">
                            </div>
                            <h5>{{Session::get('weblangauge') == 'kn' ? 'मोबाइल नं बदलें':'Change Mobile no'}}</h5>
                        </div>
                        <div class="uolod">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <input value="{{old('mobile')}}" type="tel" name="mobile" class="form-control form-control2"
                                            placeholder="{{Session::get('weblangauge') == 'kn' ? 'मोबाइल नंबर':'Mobile No'}}" value="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="btn-sub text-center">
                        <input type="submit" name="" value="{{Session::get('weblangauge') == 'kn' ? 'सबमिट करें':'Submit'}}" class="them-btn">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
