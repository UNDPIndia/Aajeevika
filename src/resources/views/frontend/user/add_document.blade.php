@extends('layouts.header')
@section('title', 'Add Document | UNDP')
@section('content')

    <div class="main">
        <section class="upload-sec">
            <div class="container">
                <div class="hefing-wrep">

                    @if (Session::get('weblangauge') == 'kn')
                        <h2>दस्तावेज़</h2>
                        <p>कृपया नीचे विवरण दर्ज करें</p>
                    @else
                        <h2>Documents</h2>
                        <p>Please enter following details to continue..</p>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all(':message') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>
                @if (Session::get('weblangauge') == 'kn')
                    <form enctype="multipart/form-data" action="{{ url('/add_document') }}" method="POST">
                        @csrf
                        <div class="upload-doc">

                            {{-- <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/card-icon.svg">
                                </div>
                                <h5>उपयोगकर्ता प्रकार</h5>
                            </div> --}}

                            @php
                                //dd(Auth::user()->role_id);
                            @endphp
                            <div class="uolod">
                                <div class="row">
                                    <form method="POST" class="chnageroletype" action="{{ '/chnageroletype' }}">

                                        {{-- <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input class="changeRole" value="3" type="radio" name="role_id" @if (Auth::user()->role_id == 3) checked @endif> एस. एच.जी
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input class="changeRole" value="2" type="radio" name="role_id" @if (Auth::user()->role_id == 2) checked @endif>शिल्पकार
                                            </div>
                                        </div> --}}
                                </div>
                            </div>

                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/card-icon.svg">
                                </div>
                                <h5>आधार कार्ड</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input minlength="12" maxlength="12" type="tex" name="adhar_card_no"
                                                class="form-control form-control2" placeholder="आधार कार्ड संख्या"
                                                value="{{ old('adhar_card_no') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="adhar_name" class="form-control form-control2 "
                                                placeholder="आधार के अनुसार नाम" value="{{ old('adhar_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeydown="return false" value="{{ old('adhar_dob') }}"
                                                name="adhar_dob" id="" class="form-control form-control2 datepicker"
                                                placeholder="आधार के अनुसार जन्म तिथि">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input type="file" name="adhar_card_front_file"
                                                        class="slect-file affilekn">
                                                    <div class="uplod-btn">
                                                        <span class="aftextkn">आधार फ्रंट की इमेज अपलोड करें</span>
                                                        <span class="btn-look">अपलोड</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input type="file" name="adhar_card_back_file"
                                                        class="slect-file abfilekn">
                                                    <div class="uplod-btn">
                                                        <span class="abtextkn">आधार बैक की इमेज अपलोड करें</span>
                                                        <span class="btn-look">अपलोड</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3' || Auth::user()->role_id == '7' || Auth::user()->role_id == '8')
                            <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/card-icon.svg">
                                    </div>
                                    <h5>पैन कार्ड</h5>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" type="tex"
                                                    name="pancard_no" minlength="10" maxlength="10"
                                                    class="form-control form-control2"
                                                    placeholder="पैन कार्ड नंबर (ABCDE1234F)"
                                                    value="{{ old('pancard_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input  type="tex" name="pancard_name"
                                                    class="form-control form-control2 " placeholder="पैन के अनुसार नाम"
                                                    value="{{ old('pancard_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input  onkeydown="return false" name="pancard_dob"
                                                    class="form-control form-control2 datepicker"
                                                    placeholder="पैन के अनुसार जन्म तिथि"
                                                    value="{{ old('pancard_dob') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <div class="slect-file-wrep">
                                                    <div class="position-relative file">
                                                        <input  type="file" name="pancard_file"
                                                            class="slect-file pankn">
                                                        <div class="uplod-btn">
                                                            <span class="doc-name pantextkn">पैन की इमेज </span>
                                                            <span class="btn-look">अपलोड</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/card-icon.svg">
                                    </div>
                                    <h5>पहचान कार्ड</h5>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="brn_no" class="form-control form-control2"
                                                    placeholder="बीआरएन नंबर" value="{{ old('brn_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" name="brn_name"
                                                    class="form-control form-control2" placeholder="बीआरएन के अनुसार नाम"
                                                    value="{{ old('brn_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <div class="slect-file-wrep">
                                                    <div class="position-relative">
                                                        <input type="file" name="brn_file"
                                                            class="slect-file brnkn">
                                                        <div class="uplod-btn">
                                                            <span class="brntextkn">बीआरएन की इमेज</span>
                                                            <span class="btn-look">अपलोड</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="upload-doc">
                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/location5.svg">
                                </div>
                                <h5>पंजीकृत पता</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeyup="this.value=this.value.replace(/[^A-z\s]/g,'');" type="text" name="address_line_one_registered"
                                                class="form-control form-control2" placeholder="पता दर्ज करें (प्रथम) *"
                                                value="{{ old('address_line_one_registered') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeyup="this.value=this.value.replace(/[^A-z\s]/g,'');" type="text" name="address_line_two_registered"
                                                class="form-control form-control2" placeholder="पता दर्ज करें (द्वितीय)"
                                                value="{{ old('address_line_two_registered') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select name="country_registered" class="form-control">
                                                <option value="101">भारत</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select name="state_registered" class="form-control">
                                                <option value="39">उत्तराखंड</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="district_registered" class="form-control  district-change">
                                                @php
                                                    //$cityData = \App\City::where(['state_id' => 39])->get();
                                                    $cityData = \App\City::where(['is_district' => 1 , 'state_id' => 39])->get();
                                                @endphp
                                                @foreach ($cityData as $item)
                                                    {{-- <option value="{{ $item->id }}">{{ $item->name_kn }}</option> --}}
                                                    <option value="{{ $item->id }}" <?php echo $item->id == Auth::user()->district? 'selected':'' ?>>{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input required type="tel" name="pincode_registered"
                                                class="form-control form-control2 pincode" placeholder="पिन *"
                                                value="{{ old('pincode_registered') }}">
                                                <span class="msg"><span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="block" class="form-control" id="block_id">
                                                <option value=" ">खंड *</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role_id == '3')
                            {{-- <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/location5.svg">
                                    </div>
                                    <h5>ಕಛೇರಿಯ ವಿಳಾಸ</h5>
                                </div>
                                <div class="check-box">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck"
                                            name="example1">
                                        <label class="custom-control-label" for="customCheck">ಕಛೇರಿಯ ವಿಳಾಸ ಮತ್ತು ನೋಂದಾಯಿತ ವಿಳಾಸ ಒಂದೇ</label>
                                    </div>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="address_line_one_office"
                                                    class="form-control form-control2" placeholder="ವಿಳಾಸ 1ನೇ ಸಾಲು"
                                                    value="{{ old('address_line_one_office') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" name="address_line_two_office"
                                                    class="form-control form-control2" placeholder="ವಿಳಾಸ 2ನೇ ಸಾಲು"
                                                    value="{{ old('address_line_two_office') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="country_office" class="form-control">
                                                    <option value="101">India</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="state_office" class="form-control">
                                                    <option value="17">Bangalore</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="district_office" class="form-control">
                                                    <option value='1558'>Karnataka </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="pincode_office" class="form-control form-control2"
                                                    placeholder="ಪಿನ್ ಕೋಡ್" value="{{ old('pincode_office') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @endif
                        <div class="btn-sub text-center">
                            <input type="submit" name="" value="सत्यापित करें" class="them-btn sbmitbtn">
                        </div>
                    </form>
                @else


                    <form enctype="multipart/form-data" action="{{ url('/add_document') }}" method="POST">
                        @csrf
                        <div class="upload-doc">
                            {{-- <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/card-icon.svg">
                                </div>
                                <h5>User Type</h5>
                            </div> --}}

                            @php
                                //dd(Auth::user()->role_id);
                            @endphp
                            <div class="uolod">
                                <div class="row">
                                    <form method="POST" class="chnageroletype" action="{{ '/chnageroletype' }}">

                                        {{-- <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input class="changeRole" value="3" type="radio" name="role_id" @if (Auth::user()->role_id == 3) checked @endif> SHG
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input class="changeRole" value="2" type="radio" name="role_id" @if (Auth::user()->role_id == 2) checked @endif>Atrisan
                                            </div>
                                        </div> --}}
                                </div>
                            </div>



                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/card-icon.svg">
                                </div>
                                <h5>Aadhar Card</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input minlength="12" maxlength="12" type="tel"
                                                name="adhar_card_no" class="form-control form-control2"
                                                placeholder="Aadhar Card Number" value="{{ old('adhar_card_no') }}">


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="adhar_name" class="form-control form-control2 "
                                                placeholder="Name As per Aadhar" value="{{ old('adhar_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeydown="return false" value="{{ old('adhar_dob') }}"
                                                name="adhar_dob" id="" class="form-control form-control2 datepicker"
                                                placeholder="DOB As per Aadhar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input type="file" name="adhar_card_front_file"
                                                        class="slect-file affile">
                                                    <div class="uplod-btn">
                                                        <span class="aftext">Upload image of aadhar front</span>
                                                        <span class="btn-look">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input type="file" name="adhar_card_back_file"
                                                        class="slect-file abfile">
                                                    <div class="uplod-btn">
                                                        <span class="abtext">Upload image of aadhar back</span>
                                                        <span class="btn-look">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3' || Auth::user()->role_id == '7' || Auth::user()->role_id == '8')
                            <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/card-icon.svg">
                                    </div>
                                    <h5>Pan Card</h5>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}"
                                                    name="pancard_no" minlength="10" maxlength="10"
                                                    class="form-control form-control2"
                                                    placeholder="Pan Card Number (ABCDE1234F)"
                                                    value="{{ old('pancard_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" name="pancard_name"
                                                    class="form-control form-control2" placeholder="Name As per Pan"
                                                    value="{{ old('pancard_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input onkeydown="return false" type="tex" name="pancard_dob"
                                                    class="form-control form-control2 datepicker"
                                                    placeholder="DOB As per Pan" value="{{ old('pancard_dob') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <div class="slect-file-wrep">
                                                    <div class="position-relative file">
                                                        <input type="file" name="pancard_file"
                                                            class="slect-file pan">
                                                        <div class="uplod-btn">
                                                            <span class="doc-name pantext">Pan Image</span>
                                                            <span class="btn-look">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/card-icon.svg">
                                    </div>
                                    <h5>BRN</h5>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="brn_no" minlength="14" maxlength="14"
                                                    class="form-control form-control2" placeholder="BRN Number"
                                                    value="{{ old('brn_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" name="brn_name"
                                                    class="form-control form-control2" placeholder="Name As per BRN"
                                                    value="{{ old('brn_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <div class="slect-file-wrep">
                                                    <div class="position-relative">
                                                        <input type="file" name="brn_file" class="slect-file brn">
                                                        <div class="uplod-btn">
                                                            <span class="brntext">BRN Image</span>
                                                            <span class="btn-look">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="upload-doc">
                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="assets/images/location5.svg">
                                </div>
                                <h5>Registered Address</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeyup="this.value=this.value.replace(/[^A-z\s]/g,'');" required type="text" name="address_line_one_registered"
                                                class="form-control form-control2" placeholder="Address Line 1 *"
                                                value="{{ old('address_line_one_registered') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input onkeyup="this.value=this.value.replace(/[^A-z\s]/g,'');" type="text" name="address_line_two_registered"
                                                class="form-control form-control2" placeholder="Address Line 2"
                                                value="{{ old('address_line_two_registered') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="country_registered" class="form-control">
                                                <option value="101">India</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="state_registered" class="form-control">
                                                <option value="39">Uttarakhand</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="district_registered" class="form-control district-change">
                                                @php
                                                    //$cityData = \App\City::where(['state_id' => 39])->get();
                                                    $cityData = \App\City::where(['is_district' => 1 , 'state_id' => 39])->get();
                                                @endphp
                                                @foreach ($cityData as $item)
                                                    {{-- <option value="{{ $item->id }}">{{ $item->name }}</option> --}}
                                                    <option value="{{ $item->id }}" <?php echo $item->id == Auth::user()->district? 'selected':'' ?>>{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input required maxlength="6" minlength="6" type="tel" name="pincode_registered"
                                                class="form-control form-control2 pincode" placeholder="Pin *"
                                                value="{{ old('pincode_registered') }}">
                                                <span class="msg"><span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="block" class="form-control" id="block_id">
                                                <option value=" ">Block *</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role_id == '3')
                            {{-- <div class="upload-doc">
                                <div class="hed-aadhar">
                                    <div class="them-img">
                                        <img src="assets/images/location5.svg">
                                    </div>
                                    <h5>Office Address</h5>
                                </div>
                                <div class="check-box">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck"
                                            name="example1">
                                        <label class="custom-control-label" for="customCheck">Office Address is same as
                                            registered
                                            address</label>
                                    </div>
                                </div>
                                <div class="uolod">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="address_line_one_office"
                                                    class="form-control form-control2" placeholder="Address Line 1"
                                                    value="{{ old('address_line_one_office') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tex" name="address_line_two_office"
                                                    class="form-control form-control2" placeholder="Address Line 2"
                                                    value="{{ old('address_line_two_office') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="country_office" class="form-control">
                                                    <option value="101">India</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="state_office" class="form-control">
                                                    <option value="17">Bangalore</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <select name="district_office" class="form-control">
                                                    <option value='1558'>Karnataka </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-5">
                                                <input type="tel" name="pincode_office" class="form-control form-control2"
                                                    placeholder="Pin" value="{{ old('pincode_office') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @endif
                        <div class="btn-sub text-center">
                            <input type="submit" name="" value="Verify" class="them-btn sbmitbtn">
                        </div>
                    </form>

                @endif
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
        <script>
        
            $(".changeRole").change(function() {
                // $('.chnageroletype').submit();
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/changeroletype') }}",
                    data: {
                        role_id: id
                    },
                    dataType: "json",

                    success: function(data) {
                        window.location.reload();

                    }
                });


            });



            //$(".pincode").focusout(function() {  remove commnet when use pincode checker
            $(".pincode_hold").focusout(function() {
                var pincode = $(this).val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/checkpincode') }}",
                    data: {
                        pin_code: pincode
                    },
                    dataType: "json",

                    success: function(data) {
                        if(data.status == false){
                            $('.sbmitbtn').prop('disabled', true);
                            $('.msg').html('Invalid PIN Code')

                        }

                        if(data.status == true){
                            $('.sbmitbtn').prop('disabled', false);
                            $('.msg').html('');
                        }
                    }
                });
            });

    // get blocks on city id change
    $(".district-change").change(function() {
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/get-blocks') }}",
                    data: {
                        city_id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data.status == true) {
                            $("#block_id").html(data.html);
                        }
                    }
                });


            });









            $(".affile").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.aftext').html(filename);
            });

            $(".abfile").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.abtext').html(filename);
            });

            $(".pan").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.pantext').html(filename);
            });
            $(".brn").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.brntext').html(filename);
            });


            $(".affilekn").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.aftextkn').html(filename);
            });

            $(".abfilekn").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.abtextkn').html(filename);
            });

            $(".pankn").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.pantextkn').html(filename);
            });
            $(".brnkn").change(function() {
                filename = this.files[0].name
                console.log(filename);
                $('.brntextkn').html(filename);
            });

            $("select.district-change").change();

        </script>



    @endsection
