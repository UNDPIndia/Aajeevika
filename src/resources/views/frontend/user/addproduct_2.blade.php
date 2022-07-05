@extends('layouts.header')
@section('title', 'Add New Product step 2| UNDP')
@section('content')
    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        @if (Session::get('weblangauge') == 'kn')
                            <div class="col-sm-12 text-center">
                                <h1 class="text-white">उत्पाद जोड़ें</h1>
                            </div>
                        @else
                            <div class="col-sm-12 text-center">
                                <h1 class="text-white">Add Product</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Category List -->
        <section class="new-product-outer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        @php

                        @endphp
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all(':message') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                        <form enctype="multipart/form-data" method="POST" action="{{ url('/addprpduct_final') }}">
                            @csrf

                            <div class="product-form-inner">
                                @if (Session::get('weblangauge') == 'kn')
                                    <!-- <div class="title">ಅಳತೆಯನ್ನು ನಮೂದಿಸಿ</div> -->
                                @else
                                    <!-- <div class="title">Please Enter Dimensions</div> -->
                                @endif

                                @if ($template->length == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="length" placeholder="ಅಗಲ" class="form-control" required />
                                        @else

                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="length" placeholder="Length" class="form-control" required />
                                        @endif
                                        <select name="length_unit" class="form-control">
                                            <option value="Cm">CM</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Inch">Inch</option>
                                            <option value="Feet">Feet</option>
                                        </select>
                                    </div>
                                @endif

                                @if ($template->width == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="width" placeholder="ಎತ್ತರ" class="form-control" required />
                                        @else
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="width" placeholder="Width" class="form-control" required />
                                        @endif

                                        <select name="width_unit" class="form-control">
                                            <option value="Cm">CM</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Inch">Inch</option>
                                            <option value="Feet">Feet</option>

                                        </select>
                                    </div>
                                @endif

                                @if ($template->height == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="height" placeholder="ಉದ್ದ" class="form-control" required />
                                        @else
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="height" placeholder="Height" class="form-control" required />
                                        @endif

                                        <select name="height_unit" class="form-control">
                                            <option value="Cm">CM</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Inch">Inch</option>
                                            <option value="Feet">Feet</option>
                                        </select>
                                    </div>
                                @endif

                                @if ($template->weight == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="weight" placeholder="ತೂಕ" class="form-control" required />
                                        @else
                                            <input type="text" pattern="[0-9]+" title="please enter number only"
                                                name="weight" placeholder="Enter Weight" class="form-control" required />
                                        @endif

                                        <select name="weight_unit" class="form-control">
                                            <option value="KG">KG</option>
                                            <option value="GM">GM</option>

                                        </select>
                                    </div>
                                @endif

                                @if ($template->vol == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input type="text" pattern="[0-9]+" title="please enter number only" name="vol"
                                                placeholder="ಪರಿಮಾಣ" class="form-control" required />
                                        @else
                                            <input type="text" pattern="[0-9]+" title="please enter number only" name="vol"
                                                placeholder="Enter Volume" class="form-control" required />
                                        @endif
                                        <select name="vol_unit" class="form-control">
                                            <option value="MI">Mi</option>
                                            <option value="Liter">Liter</option>

                                        </select>
                                    </div>
                                @endif



                                @if (Session::get('weblangauge') == 'kn')
                                    <div class="title">कृपया कम से कम 1 उत्पाद चित्र जोड़ें</span></div>
                                @else
                                    <div class="title">Please add atleast 1 Product image <p>(jpeg,png,svg) </span></div>
                                @endif

                                <ul>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input required type="file" name="image_1" id="image_1"
                                                class="form-control file-upload input_rms1">
                                            <img src="" id="1" class="image_rms1" style="display: none" />

                                        </div>
                                        <a class="rm1 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_2"
                                                name="image_2" class="form-control file-upload input_rms2">
                                            <img src="" id="2" class="image_rms2" style="display: none" />
                                        </div>
                                        <a class="rm2 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_3"
                                                name="image_3" class="form-control file-upload input_rms3">
                                            <img src="" id="3" class="image_rms3" style="display: none" />
                                        </div>
                                        <a class="rm3 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_4"
                                                name="image_4" class="form-control file-upload input_rms4">
                                            <img src="" id="4" class="image_rms4" style="display: none" />
                                        </div>
                                        <a class="rm4 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_5"
                                                name="image_5" class="form-control file-upload input_rms5">
                                            <img src="" id="5" class="image_rms5" style="display: none" />
                                        </div>
                                        <a class="rm5 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                </ul>
                                <!-- <div class="form-group position-relative field-outer">
                                    <input type="text" name="video_url" placeholder="YouTube URL" class="form-control" />
                                </div> -->
                                <div>{{Session::get('weblangauge') == 'kn' ? 'प्रमाणपत्र जोड़ें':'Add Certificate'}} </div><br>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_1" id="certificate_type_1" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                       
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_1"
                                                name="certificate_image_1" class="form-control file-upload cinput_rms1">
                                            <img src="" id="C1" class="cimage_rms1" style="display: none" />
                                        </div>
                                        <a class="crm1 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_2" id="certificate_type_2" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_2"
                                                name="certificate_image_2" class="form-control file-upload cinput_rms2">
                                            <img src="" id="C2" class="cimage_rms2" style="display: none" />
                                        </div>
                                        <a class="crm2 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_3" id="certificate_type_3" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_3"
                                                name="certificate_image_3" class="form-control file-upload cinput_rms3">
                                            <img src="" id="C3" class="cimage_rms3" style="display: none" />
                                        </div>
                                        <a class="crm3 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_4" id="certificate_type_4" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_4"
                                                name="certificate_image_4" class="form-control file-upload cinput_rms4">
                                            <img src="" id="C4" class="cimage_rms4" style="display: none" />
                                        </div>
                                        <a class="crm4 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_5" id="certificate_type_5" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_5"
                                                name="certificate_image_5" class="form-control file-upload cinput_rms5">
                                            <img src="" id="C5" class="cimage_rms5" style="display: none" />
                                        </div>
                                        <a class="crm5 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <!-- Certificate 6 -->
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_6" id="certificate_type_6" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_6"
                                                name="certificate_image_6" class="form-control file-upload cinput_rms5">
                                            <img src="" id="C6" class="cimage_rms6" style="display: none" />
                                        </div>
                                        <a class="crm6 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <!-- Certificate 7 -->
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_7" id="certificate_type_7" class="form-control">
                                        <option >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_7"
                                                name="certificate_image_7" class="form-control file-upload cinput_rms7">
                                            <img src="" id="C7" class="cimage_rms7" style="display: none" />
                                        </div>
                                        <a class="crm7 d-none" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </div>
                                    </div>
                                </div>

                                <div class="btn-outer d-flex justify-content-center mt-4">
                              
                                <div class="col-md-6">

                                    @if (Session::get('weblangauge') == 'kn')
                                        <input type="submit" value="अगला" class="btn btn-sm them-btn">
                                    @else
                                        <input type="submit" value="Next" class="btn btn-sm them-btn">
                                    @endif

</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#1').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL3(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#3').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL4(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#4').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#5').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#image_1").change(function() {

                var ext = $('#image_1').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('invalid extension!');
                    return false;
                }

                readURL1(this);
                $('.rm1').removeClass('d-none');
                $('.image_rms1').show();
            });
            $("#image_2").change(function() {
                var ext = $('#image_2').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('invalid extension!');
                    return false;
                }

                readURL2(this);
                $('.rm2').removeClass('d-none');
                $('.image_rms2').show();
            });
            $("#image_3").change(function() {
                var ext = $('#image_3').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }

                readURL3(this);
                $('.rm3').removeClass('d-none');
                $('.image_rms3').show();
            });
            $("#image_4").change(function() {
                var ext = $('#image_4').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readURL4(this);
                $('.rm4').removeClass('d-none');
                $('.image_rms4').show();
            });
            $("#image_5").change(function() {

                var ext = $('#image_5').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readURL5(this);
                $('.rm5').removeClass('d-none');
                $('.image_rms5').show();
            });


            $('.rm1').click(function() {
                $('.image_rms1').prop('src', '');
                $('.image_rms1').hide();
                $('.input_rms1').val('');
                $('.img1').val('');
                $("#image_1").prop('required', true);
                $(this).addClass('d-none');
            });

            $('.rm2').click(function() {
                $('.image_rms2').prop('src', '');
                $('.image_rms2').hide();
                $('.input_rms2').val('');
                $('.img2').val('');
                $(this).addClass('d-none');
            });

            $('.rm3').click(function() {
                $('.image_rms3').prop('src', '');
                $('.image_rms3').hide();
                $('.input_rms3').val('');
                $('.img3').val('');
                $(this).addClass('d-none');
            });

            $('.rm4').click(function() {
                $('.image_rms4').prop('src', '');
                $('.image_rms4').hide();
                $('.input_rms4').val('');
                $('.img4').val('');
                $(this).addClass('d-none');
            });

            $('.rm5').click(function() {
                $('.image_rms5').prop('src', '');
                $('.image_rms5').hide();
                $('.input_rms5').val('');
                $('.img5').val('');
                $(this).addClass('d-none');
            });
                //for certificate
                function readCURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C1').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readCURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C2').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readCURL3(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C3').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readCURL4(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C4').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            function readCURL5(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C5').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            function readCURL6(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C6').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            function readCURL7(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#C7').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#certificate_image_1").change(function() {

                var ext = $('#certificate_image_1').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('invalid extension!');
                    return false;
                }

                readCURL1(this);
                $('.crm1').removeClass('d-none');
                $('.cimage_rms1').show();
            });
            $("#certificate_image_2").change(function() {
                var ext = $('#certificate_image_2').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('invalid extension!');
                    return false;
                }

                readCURL2(this);
                $('.crm2').removeClass('d-none');
                $('.cimage_rms2').show();
            });
            $("#certificate_image_3").change(function() {
                var ext = $('#certificate_image_3').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }

                readCURL3(this);
                $('.crm3').removeClass('d-none');
                $('.cimage_rms3').show();
            });
            $("#certificate_image_4").change(function() {
                var ext = $('#certificate_image_4').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL4(this);
                $('.crm4').removeClass('d-none');
                $('.cimage_rms4').show();
            });
            $("#certificate_image_5").change(function() {

                var ext = $('#certificate_image_5').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL5(this);
                $('.crm5').removeClass('d-none');
                $('.cimage_rms5').show();
            });
            $("#certificate_image_6").change(function() {

                var ext = $('#certificate_image_6').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL6(this);
                $('.crm6').removeClass('d-none');
                $('.cimage_rms6').show();
            });
            $("#certificate_image_7").change(function() {

                var ext = $('#certificate_image_7').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL7(this);
                $('.crm7').removeClass('d-none');
                $('.cimage_rms7').show();
            });


            $('.crm1').click(function() {
                $('.cimage_rms1').prop('src', '');
                $('.cimage_rms1').hide();
                $('.cinput_rms1').val('');
                $('.cimg1').val('');
                $("#certificate_type_1").prop('required', true);
                $(this).addClass('d-none');
            });

            $('.crm2').click(function() {
                $('.cimage_rms2').prop('src', '');
                $('.cimage_rms2').hide();
                $('.cinput_rms2').val('');
                $('.cimg2').val('');
                $(this).addClass('d-none');
            });

            $('.crm3').click(function() {
                $('.cimage_rms3').prop('src', '');
                $('.cimage_rms3').hide();
                $('.cinput_rms3').val('');
                $('.cimg3').val('');
                $(this).addClass('d-none');
            });

            $('.crm4').click(function() {
                $('.cimage_rms4').prop('src', '');
                $('.cimage_rms4').hide();
                $('.cinput_rms4').val('');
                $('.cimg4').val('');
                $(this).addClass('d-none');
            });

            $('.crm5').click(function() {
                $('.cimage_rms5').prop('src', '');
                $('.cimage_rms5').hide();
                $('.cinput_rms5').val('');
                $('.cimg5').val('');
                $(this).addClass('d-none');
            });
            $('.crm6').click(function() {
                $('.cimage_rms6').prop('src', '');
                $('.cimage_rms6').hide();
                $('.cinput_rms6').val('');
                $('.cimg6').val('');
                $(this).addClass('d-none');
            });
            $('.crm7').click(function() {
                $('.cimage_rms7').prop('src', '');
                $('.cimage_rms7').hide();
                $('.cinput_rms7').val('');
                $('.cimg7').val('');
                $(this).addClass('d-none');
            });


        </script>
    @endsection
