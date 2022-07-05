@extends('layouts.header')
@section('title', 'Change Profile Image | UNDP')
@section('content')
    <div class="main">
        <section class="upload-sec">
            <div class="container">
                <form enctype="multipart/form-data" action="{{ url('/changeprofileimage') }}" method="POST">
                    @csrf
                    <div class="upload-doc">


                        <div class="hed-aadhar">
                            <div class="them-img">
                                <img src="assets/images/location5.svg">
                            </div>
                            <h5>{{Session::get('weblangauge') == 'kn' ? 'प्रोफ़ाइल फ़ोटो चुनें':'Select Image'}}</h5>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="uolod">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group form-group-5">
                                        <div class="slect-file-wrep">
                                            <div class="position-relative">
                                                <input type="file" name="profileimage" class="slect-file affile">
                                                <div class="uplod-btn">
                                                    <span class="aftext">{{Session::get('weblangauge') == 'kn' ? 'प्रोफ़ाइल फ़ोटो ':'Profile image'}}</span>
                                                    <span class="btn-look">{{Session::get('weblangauge') == 'kn' ? 'अपलोड करें':'Upload'}}</span>
                                                </div>
                                            </div>
                                        </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(".affile").change(function() {
            filename = this.files[0].name
            console.log(filename);
            $('.aftext').html(filename);
        });

    </script>
@endsection
