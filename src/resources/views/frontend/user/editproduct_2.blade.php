@extends('layouts.header')
@section('title', 'Edit Product step 2| UNDP')
@section('content')
    <style>
        /* .rm1{
                    display: none;
                }
                .rm2{
                    display: none;
                }
                .rm3{
                    display: none;
                }
                .rm4{
                    display: none;
                }
                .rm5{
                    display: none;
                } */

    </style>
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
                                <h1 class="text-white">Edit Product</h1>
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
                        <form enctype="multipart/form-data" method="POST"
                            action="{{ url('/editprpduct_final') }}/{{ encrypt($productData->id) }}">
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
                                            <input value="{{ $productData->length }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="length" placeholder="लंबाई"
                                                class="form-control" required />
                                        @else

                                            <input value="{{ $productData->length }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="length"
                                                placeholder="Length" class="form-control" required />
                                        @endif
                                        <select name="length_unit" class="form-control">
                                            <option @if ($productData->length_unit == 'Cm') selected @endif value="Cm">CM</option>


                                            <option @if ($productData->length_unit == 'Meter') selected @endif value="Meter">Meter</option>
                                            <option @if ($productData->length_unit == 'Inch') selected @endif value="Inch">Inch</option>
                                            <option @if ($productData->length_unit == 'Feet') selected @endif value="Feet">Feet</option>
                                        </select>
                                    </div>
                                @endif

                                @if ($template->width == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input value="{{ $productData->width }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="width"
                                                placeholder="चौड़ाई" class="form-control" required />
                                        @else
                                            <input value="{{ $productData->width }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="width"
                                                placeholder="Width" class="form-control" required />
                                        @endif

                                        <select name="width_unit" class="form-control">
                                            <option @if ($productData->width_unit == 'Cm') selected @endif value="Cm">CM</option>
                                            <option @if ($productData->width_unit == 'Meter') selected @endif value="Meter">Meter</option>
                                            <option @if ($productData->width_unit == 'Inch') selected @endif value="Inch">Inch</option>
                                            <option @if ($productData->width_unit == 'Feet') selected @endif value="Feet">Feet</option>

                                        </select>
                                    </div>
                                @endif

                                @if ($template->height == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input value="{{ $productData->height }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="height"
                                                placeholder="ऊंचाई" class="form-control" required />
                                        @else
                                            <input value="{{ $productData->height }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="height"
                                                placeholder="Height" class="form-control" required />
                                        @endif

                                        <select name="height_unit" class="form-control">
                                            <option @if ($productData->height_unit == 'Cm') selected @endif value="Cm">CM</option>
                                            <option @if ($productData->height_unit == 'Meter') selected @endif value="Meter">Meter</option>
                                            <option @if ($productData->height_unit == 'Inch') selected @endif value="Inch">Inch</option>
                                            <option @if ($productData->height_unit == 'Feet') selected @endif value="Feet">Feet</option>
                                        </select>
                                    </div>
                                @endif

                                @if ($template->weight == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input value="{{ $productData->weight }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="weight" placeholder="वज़न"
                                                class="form-control" required />
                                        @else
                                            <input value="{{ $productData->weight }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="weight"
                                                placeholder="Enter Weight" class="form-control" required />
                                        @endif

                                        <select name="weight_unit" class="form-control">
                                            <option @if ($productData->weight_unit == 'KG') selected @endif value="KG">KG</option>
                                            <option @if ($productData->weight_unit == 'GM') selected @endif value="GM">GM</option>


                                        </select>
                                    </div>
                                @endif

                                @if ($template->vol == 'on')
                                    <div class="form-group position-relative field-outer">
                                        @if (Session::get('weblangauge') == 'kn')
                                            <input value="{{ $productData->vol }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="vol" placeholder="आयतन"
                                                class="form-control" required />
                                        @else
                                            <input value="{{ $productData->vol }}" pattern="[0-9]+"
                                                title="please enter number only" type="text" name="vol"
                                                placeholder="Enter Volume" class="form-control" required />
                                        @endif
                                        <select name="vol_unit" class="form-control">
                                            <option @if ($productData->vol_unit == 'MI') selected @endif value="MI">MI</option>
                                            <option @if ($productData->vol_unit == 'Liter') selected @endif value="Liter">Liter</option>

                                        </select>
                                    </div>
                                @endif



                                @if (Session::get('weblangauge') == 'kn')
                                    <div class="title">कम से कम एक उत्पाद फ़ोटो जोड़ें</span></div>
                                @else
                                    <div class="title">Please add atleast 1 image <p>(jpeg,png,svg)</p> </span></div>
                                @endif

                                <ul>
                                    <li class="upload-img">
                                        @php
                                            //  dd($productData);
                                        @endphp
                                        <div class="form-group upload-file position-relative">


                                            @if ($productData->image_1 != null)
                                                <input type="file" name="image_1" id="image_1"
                                                    class="form-control file-upload input_rms1">

                                                <img class="image_rms1" src="{{ asset($productData->image_1) }}"
                                                    id="1" />
                                                <input type="hidden" value="{{ $productData->image_1 }}" name="img1"
                                                    class="img1" />
                                            @else
                                                <input accept="image/x-png,image/gif,image/jpeg" required type="file"
                                                    name="image_1" id="image_1" class="form-control file-upload input_rms1">
                                                <img class="image_rms1" src="" id="1" />
                                            @endif


                                        </div>

                                        <a class="rm1 @if ($productData->image_1 == null) d-none @endif" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_2"
                                                name="image_2" class="form-control file-upload input_rms2">

                                            @if ($productData->image_2 != null)
                                                <img class="image_rms2" src="{{ asset($productData->image_2) }}"
                                                    id="2" />
                                                <input type="hidden" value="{{ $productData->image_2 }}" name="img2"
                                                    class="img2" />
                                            @else
                                                <img class="image_rms2" src="" id="2" style="display: none" />
                                            @endif

                                        </div>

                                        <a class="rm2 @if ($productData->image_2 == null) d-none @endif" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_3"
                                                name="image_3" class="form-control file-upload input_rms3">
                                            @if ($productData->image_3 != null)
                                                <img class="image_rms3" src="{{ asset($productData->image_3) }}"
                                                    id="3" />
                                                <input type="hidden" value="{{ $productData->image_3 }}" name="img3"
                                                    class="img3" />
                                            @else
                                                <img class="image_rms3" src="" id="3" style="display: none" />
                                            @endif
                                        </div>
                                        <a class="rm3  @if ($productData->image_3 == null) d-none @endif" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_4"
                                                name="image_4" class="form-control file-upload input_rms4">
                                            @if ($productData->image_4 != null)
                                                <img class="image_rms4" src="{{ asset($productData->image_4) }}"
                                                    id="4" />
                                                <input type="hidden" value="{{ $productData->image_4 }}" name="img4"
                                                    class="img4" />
                                            @else
                                                <img class="image_rms4" src="" id="4" style="display: none" />
                                            @endif
                                        </div>
                                        <a class="rm4 @if ($productData->image_4 == null) d-none @endif" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                    <li class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                            <input accept="image/x-png,image/gif,image/jpeg" type="file" id="image_5"
                                                name="image_5" class="form-control file-upload input_rms5">
                                            @if ($productData->image_5 != null)
                                                <img class="image_rms5" src="{{ asset($productData->image_5) }}"
                                                    id="5" />
                                                <input type="hidden" value="{{ $productData->image_5 }}" name="img5"
                                                    class="img5" />
                                            @else
                                                <img class="image_rms5" src="" id="5" style="display: none" />
                                            @endif
                                        </div>
                                        <a class="rm5 @if ($productData->image_5 == null) d-none @endif" href="#0">
                                            <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                        </a>
                                    </li>
                                </ul>

                                <div><?php echo (Session::get('weblangauge') == 'kn')?' प्रमाणपत्र जोड़ें':'Add Certificate' ?> </div><br>

                                <div class="form-group selectField d-flex justify-content-start">
                                @php
                                $disbale_attr_1 = "";
                                $disbale_attr_2 = "";
                                $disbale_attr_3 = "";
                                $disbale_attr_4 = "";
                                $disbale_attr_5 = "";
                                $disbale_attr_6 = "";
                                $disbale_attr_7 = "";
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_1 != null ){
                                    $disbale_attr_1 = $productData->getCertificate->certificate_status_1 == 1 || $productData->getCertificate->certificate_status_1 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_2 != null ){
                                    $disbale_attr_2 = $productData->getCertificate->certificate_status_2 == 1 || $productData->getCertificate->certificate_status_2 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_3 != null ){
                                    $disbale_attr_3 = $productData->getCertificate->certificate_status_3 == 1 || $productData->getCertificate->certificate_status_3 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_4 != null ){
                                    $disbale_attr_4 = $productData->getCertificate->certificate_status_4 == 1 || $productData->getCertificate->certificate_status_4 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_5 != null ){
                                    $disbale_attr_5 = $productData->getCertificate->certificate_status_5 == 1 || $productData->getCertificate->certificate_status_5 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_6 != null ){
                                    $disbale_attr_6 = $productData->getCertificate->certificate_status_6 == 1 || $productData->getCertificate->certificate_status_6 == 0 ?'disabled':'';
                                }
                                if ($productData->getCertificate && $productData->getCertificate->certificate_image_7 != null ){
                                    $disbale_attr_7 = $productData->getCertificate->certificate_status_7 == 1 || $productData->getCertificate->certificate_status_7 == 0 ?'disabled':'';
                                }
                                @endphp
                                    <div class="left-part">
                                        <select name="certificate_type_1" id="certificate_type_1" class="form-control" {{ $disbale_attr_1 }} >
                                        <option value="">{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_1 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}} </option>
                                           @endforeach
                                       
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_1 != null )
                                            @if ($productData->getCertificate->certificate_status_1 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_1 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                        
                                    </div>
                                    <div class="right-part">
                                        <div class="upload-img">
                                            <div class="form-group upload-file position-relative">
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_1 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_1"
                                                    name="certificate_image_1" class="form-control file-upload cinput_rms1">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_1) }}" id="C1" class="cimage_rms1"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_1 }}" name="cimg1"
                                                        class="cimg1" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_1" id="certificate_image_1" class="form-control file-upload cinput_rms1">
                                                    <img class="cimage_rms1 d-none" src="" id="C1" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_1 != null)
                                            <a class="crm1 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_1 == null) d-none @endif" href="#0" {{$disbale_attr_1}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_2" id="certificate_type_2" class="form-control" {{$disbale_attr_2}}>
                                        <option  value="" >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_2 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_2 != null )
                                            @if ($productData->getCertificate->certificate_status_2 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_2 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                        @if ($productData->getCertificate && $productData->getCertificate->certificate_image_2 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_2"
                                                    name="certificate_image_2" class="form-control file-upload cinput_rms2">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_2) }}" id="C2" class="cimage_rms2"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_2 }}" name="cimg2"
                                                        class="cimg2" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_2" id="certificate_image_2" class="form-control file-upload cinput_rms2">
                                                    <img class="cimage_rms2 d-none" src="" id="C2" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_2 != null)
                                            <a class="crm2 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_2 == null) d-none @endif" href="#0" {{$disbale_attr_2}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_3" id="certificate_type_3" class="form-control"  {{$disbale_attr_3 }}>
                                        <option  value="" >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_3 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_3 != null )
                                            @if ($productData->getCertificate->certificate_status_3 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_3 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                        @if ($productData->getCertificate && $productData->getCertificate->certificate_image_3 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_3"
                                                    name="certificate_image_3" class="form-control file-upload cinput_rms3">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_3) }}" id="C3" class="cimage_rms3"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_3 }}" name="cimg3"
                                                        class="cimg3" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_3" id="certificate_image_3" class="form-control file-upload cinput_rms3">
                                                    <img class="cimage_rms3 d-none" src="" id="C3" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_3 != null)
                                            <a class="crm3 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_3 == null) d-none @endif" href="#0" {{$disbale_attr_3}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif 
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_4" id="certificate_type_4" class="form-control" {{$disbale_attr_4 }}>
                                        <option value=""  >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_4 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_4 != null )
                                            @if ($productData->getCertificate->certificate_status_4 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_4 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                    <div class="form-group upload-file position-relative">
                                    @if ($productData->getCertificate && $productData->getCertificate->certificate_image_4 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_4"
                                                    name="certificate_image_4" class="form-control file-upload cinput_rms4">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_4) }}" id="C4" class="cimage_rms4"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_4 }}" name="cimg4"
                                                        class="cimg4" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_4" id="certificate_image_4" class="form-control file-upload cinput_rms4">
                                                    <img class="cimage_rms4 d-none" src="" id="C4" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_4 != null)
                                            <a class="crm4 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_4 == null) d-none @endif" href="#0" {{$disbale_attr_4}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif 
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_5" id="certificate_type_5" class="form-control" {{$disbale_attr_5 }}>
                                        <option  value="" >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_5 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_5 != null )
                                            @if ($productData->getCertificate->certificate_status_5 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_5 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                        <div class="form-group upload-file position-relative">
                                                @if ($productData->getCertificate && $productData->getCertificate->certificate_image_5 != null)
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_5"
                                                        name="certificate_image_5" class="form-control file-upload cinput_rms5">
                                                    <img src="{{ asset($productData->getCertificate->certificate_image_5) }}" id="C5" class="cimage_rms5"  />
                                                    <input type="hidden" value="{{ $productData->getCertificate->certificate_image_5 }}" name="cimg5"
                                                            class="cimg5" />
                                                @else
                                                        <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                            name="certificate_image_5" id="certificate_image_5" class="form-control file-upload cinput_rms5">
                                                        <img class="cimage_rms5 d-none" src="" id="C5" />
                                                @endif      
                                        </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_5 != null)
                                            <a class="crm5 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_5 == null) d-none @endif" href="#0" {{$disbale_attr_5}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif
                                    </div>
                                    </div>
                                </div>

                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_6" id="certificate_type_6" class="form-control" {{$disbale_attr_6 }}>
                                        <option value=""  >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_6 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_6 != null )
                                            @if ($productData->getCertificate->certificate_status_6 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_6 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                    <div class="form-group upload-file position-relative">
                                    @if ($productData->getCertificate && $productData->getCertificate->certificate_image_6 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_6"
                                                    name="certificate_image_6" class="form-control file-upload cinput_rms6">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_6) }}" id="C6" class="cimage_rms6"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_6 }}" name="cimg6"
                                                        class="cimg6" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_6" id="certificate_image_6" class="form-control file-upload cinput_rms6">
                                                    <img class="cimage_rms6 d-none" src="" id="C6" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_6 != null)
                                            <a class="crm6 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_6 == null) d-none @endif" href="#0" {{$disbale_attr_6}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="form-group selectField d-flex justify-content-start">
                                    <div class="left-part">
                                        <select name="certificate_type_7" id="certificate_type_7" class="form-control" {{$disbale_attr_7 }}>
                                        <option  value="" >{{Session::get('weblangauge') == 'kn' ? 'प्रमाण-पत्र नाम':'Certificate Name'}}</option>
                                            @foreach($typeList as $type)
                                            <option @if ($productData->getCertificate && $productData->getCertificate->certificate_type_7 == $type->id)
                                                    selected
                                                @endif value="{{$type->id}}">{{$type->name}}</option>
                                           @endforeach
                                        </select>
                                        @if($productData->getCertificate && $productData->getCertificate->certificate_image_7 != null )
                                            @if ($productData->getCertificate->certificate_status_7 == 1)
                                                <span class="green">{{Session::get('weblangauge') == 'kn' ? 'सत्यापित':'Verified'}}</span>
                                            @elseif($productData->getCertificate->certificate_status_7 == 2)
                                                <span class="red">{{Session::get('weblangauge') == 'kn' ? 'अस्वीकृत':'Rejected'}}</span>
                                            @else
                                                <span class="orange">{{Session::get('weblangauge') == 'kn' ? 'लंबित':'Pending'}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="right-part">
                                    <div class="upload-img">
                                    <div class="form-group upload-file position-relative">
                                    @if ($productData->getCertificate && $productData->getCertificate->certificate_image_7 != null)
                                                <input accept="image/x-png,image/gif,image/jpeg" type="file" id="certificate_image_7"
                                                    name="certificate_image_7" class="form-control file-upload cinput_rms7">
                                                <img src="{{ asset($productData->getCertificate->certificate_image_7) }}" id="C7" class="cimage_rms7"  />
                                                <input type="hidden" value="{{ $productData->getCertificate->certificate_image_7 }}" name="cimg7"
                                                        class="cimg7" />
                                                        @else
                                                    <input accept="image/x-png,image/gif,image/jpeg" type="file"
                                                        name="certificate_image_7" id="certificate_image_7" class="form-control file-upload cinput_rms7">
                                                    <img class="cimage_rms7 d-none" src="" id="C7" />
                                                @endif      
                                            </div>
                                            @if ($productData->getCertificate && $productData->getCertificate->certificate_image_7 != null)
                                            <a class="crm7 @if ($productData->getCertificate && $productData->getCertificate->certificate_image_7 == null) d-none @endif" href="#0" {{$disbale_attr_7}}>
                                                <img src="{{ asset('assets/images/delete.svg') }}" alt="delete">
                                            </a>
                                            @endif
                                    </div>
                                    </div>
                                </div>

                                <div class="btn-outer d-flex justify-content-center mt-4">
                                

                             
                                <div class="col-md-6">

                                    @if (Session::get('weblangauge') == 'kn')
                                        <input type="submit" value="अगला" class="btn btn-lg them-btn">
                                    @else
                                        <input type="submit" value="Next" class="btn btn-lg them-btn">
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
            function readURL6(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#6').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            function readURL7(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#7').attr('src', e.target.result);
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
//certificate
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
                $('.cimage_rms1').removeClass('d-none');
            });
            $("#certificate_image_2").change(function() {
                var ext = $('#certificate_image_2').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('invalid extension!');
                    return false;
                }

                readCURL2(this);
                $('.crm2').removeClass('d-none');
                $('.cimage_rms2').removeClass('d-none');
            });
            $("#certificate_image_3").change(function() {
                var ext = $('#certificate_image_3').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }

                readCURL3(this);
                $('.crm3').removeClass('d-none');
                $('.cimage_rms3').removeClass('d-none');
            });
            $("#certificate_image_4").change(function() {
                var ext = $('#certificate_image_4').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL4(this);
                $('.crm4').removeClass('d-none');
                $('.cimage_rms4').removeClass('d-none');
            });
            $("#certificate_image_5").change(function() {

                var ext = $('#certificate_image_5').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL5(this);
                $('.crm5').removeClass('d-none');
                $('.cimage_rms5').removeClass('d-none');
            });
            $("#certificate_image_6").change(function() {

                var ext = $('#certificate_image_6').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL6(this);
                $('.crm6').removeClass('d-none');
                $('.cimage_rms6').removeClass('d-none');
            });
            $("#certificate_image_7").change(function() {

                var ext = $('#certificate_image_7').val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif','jfif', 'png', 'jpg', 'jpeg']) == -1) {

                    alert('invalid extension!');
                    return false;
                }
                readCURL7(this);
                $('.crm7').removeClass('d-none');
                $('.cimage_rms7').removeClass('d-none');
            });


            $('.crm1').click(function() {
                @if ($disbale_attr_1 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms1').prop('src', '');
                $('.cimage_rms1').hide();
                $('.cinput_rms1').val('');
                $('.cimg1').val('');
                //$("#certificate_type_1").prop('required', true);
                $(this).addClass('d-none');
            });

            $('.crm2').click(function() {
                @if ($disbale_attr_2 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms2').prop('src', '');
                $('.cimage_rms2').hide();
                $('.cinput_rms2').val('');
                $('.cimg2').val('');
                $(this).addClass('d-none');
            });

            $('.crm3').click(function() {
                @if ($disbale_attr_3 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms3').prop('src', '');
                $('.cimage_rms3').hide();
                $('.cinput_rms3').val('');
                $('.cimg3').val('');
                $(this).addClass('d-none');
            });

            $('.crm4').click(function() {
                @if ($disbale_attr_4 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms4').prop('src', '');
                $('.cimage_rms4').hide();
                $('.cinput_rms4').val('');
                $('.cimg4').val('');
                $(this).addClass('d-none');
            });

            $('.crm5').click(function() {
                @if ($disbale_attr_5 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms5').prop('src', '');
                $('.cimage_rms5').hide();
                $('.cinput_rms5').val('');
                $('.cimg5').val('');
                $(this).addClass('d-none');
            });

            $('.crm6').click(function() {
                @if ($disbale_attr_6 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms6').prop('src', '');
                $('.cimage_rms6').hide();
                $('.cinput_rms6').val('');
                $('.cimg6').val('');
                $(this).addClass('d-none');
            });

            $('.crm7').click(function() {
                @if ($disbale_attr_7 == 'disabled')
                    return false;
                @endif
                $('.cimage_rms7').prop('src', '');
                $('.cimage_rms7').hide();
                $('.cinput_rms7').val('');
                $('.cimg7').val('');
                $(this).addClass('d-none');
            });


        </script>
    @endsection
