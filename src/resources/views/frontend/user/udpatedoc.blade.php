@extends('layouts.header')
@section('title', 'Update Document | UNDP')
@section('content')
    <div class="main">
        <section class="upload-sec">
            <div class="container">
                <form enctype="multipart/form-data" action="{{ url('/uploaddocument') }}/{{ $type }}"
                    method="POST">

                    @csrf
                    @if ($type == 'aadhar')
                        <div class="upload-doc">
                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="{{ asset('assets/images/card-icon.svg') }}">
                                </div>
                                <h5>Aadhar Card</h5>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all(':message') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input minlength="12" maxlength="12" value="{{ old('adhar_card_no') }}" type="tex" name="adhar_card_no"
                                                class="form-control form-control2" placeholder="Aadhar Card Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input value="{{ old('adhar_name') }}" type="tex" name="adhar_name"
                                                class="form-control form-control2" placeholder="Name As per Aadhar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input value="{{ old('adhar_dob') }}" type="tex" name="adhar_dob"
                                                class="form-control form-control2 datepicker" placeholder="DOB As per Aadhar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input value="{{ old('adhar_card_front_file') }}" type="file"
                                                        name="adhar_card_front_file" class="slect-file affile">
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
                                                    <input value="{{ old('adhar_card_back_file') }}" type="file"
                                                        name="adhar_card_back_file" class="slect-file abfile">
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

                    @endif

                    @if ($type == 'pan')
                        <div class="upload-doc">
                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="{{ asset('assets/images/card-icon.svg') }}">
                                </div>
                                <h5>Pan Card</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="pancard_no"  pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" class="form-control form-control2" minlength="10" maxlength="10"
                                                placeholder="Pan Card Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="pancard_name" class="form-control form-control2"
                                                placeholder="Name As per Pan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="pancard_dob" class="form-control form-control2"
                                                placeholder="DOB As per Pan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative file">
                                                    <input type="file" name="pancard_file" class="slect-file">
                                                    <div class="uplod-btn pan">
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
                    @endif

                    @if ($type == 'brn')
                        <div class="upload-doc">
                            <div class="hed-aadhar">
                                <div class="them-img">
                                    <img src="{{ asset('assets/images/card-icon.svg') }}">
                                </div>
                                <h5>BRN</h5>
                            </div>
                            <div class="uolod">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tel" minlength="14" maxlength="14" name="brn_no" class="form-control form-control2"
                                                placeholder="BRN Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <input type="tex" name="brn_name" class="form-control form-control2"
                                                placeholder="Name As per BRN">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <div class="slect-file-wrep">
                                                <div class="position-relative">
                                                    <input type="file" name="brn_file" class="slect-file">
                                                    <div class="uplod-btn brn">
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

                    <div class="btn-sub text-center">
                        <input type="submit" name="submit" value="Verify" class="them-btn">
                    </div>
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

    </script>
@endsection
