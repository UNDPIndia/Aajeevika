@extends('layouts.header')
@section('title', 'Edit Product step 3| UNDP')
@section('content')

    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
                    @if (Session::get('weblangauge') == 'kn')
                        <div class="col-sm-12 text-center">
                            <h1 class="text-white">उत्पाद संपादित करें</h1>
                        </div>
                    @else
                        <div class="col-sm-12 text-center">
                            <h1 class="text-white">Edit Product</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Category Lists -->
        <section class="new-product-outer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ url('/editproduct') }}/{{ encrypt($productData->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="dataset_2" value='{{$dataset_2}}' />
                            <input type="hidden" name="certificateData" value='{{$certificateData}}' />
                            <div class="product-form-inner form-language">


                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'विवरण अंग्रेजी में':'Description in English'}}</div>
                                <textarea id="tweet" maxlength="1000" class="form-control"
                                    name="des_en">{{ $productData->des_en }}</textarea>
                                <div id="textarea_feedback"></div>

                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'विवरण हिंदी में':'Description in Hindi'}}</div>
                                <textarea id="tweet2" maxlength="1000" class="form-control"
                                    name="des_kn">{{ $productData->des_kn }}</textarea>
                                <div id="textarea_feedback2"></div>


                                <div class="btn-outer d-flex justify-content-center mt-4">
                                    <!-- <div class="col-sm-6">
                                        <button @if($flag == 0 ) id="checkdraft" @endif type="submit" name="submit" value="draft" class="btn btn-outline-secondary">
                                            Save to Draft</button>
                                    </div> -->
                                    <div class="col-sm-6"><button type="submit" name="submit" value="update"
                                            class="btn btn-sm them-btn">Update</button>
                                    </div>
                                    <br>
                                    
                                </div>
                                <div class="msgdraft" style="display:none; color: red;text-align: center;margin-top: 10px;"><p>You've already added product in draft</p></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                var text_length = '{{ $productData->des_en }}';
                var text_max = 1000 - text_length.length;
                $('#textarea_feedback').html(text_max + ' characters remaining');

                $('#tweet').keyup(function() {
                    var text_length = $('#tweet').val().length;
                    var text_remaining = 1000 - text_length;

                    $('#textarea_feedback').html(text_remaining + ' characters remaining');
                });


                var text_length_kn = '{{ $productData->des_kn }}';
                var text_max2 = 1000 - text_length_kn.length;
                $('#textarea_feedback2').html(text_max2 + ' characters remaining');

                $('#tweet2').keyup(function() {
                    var text_length2 = $('#tweet2').val().length;
                    var text_remaining2 = 1000 - text_length2;

                    $('#textarea_feedback2').html(text_remaining2 + ' characters remaining');
                });


                $("#checkdraft").click(function(){
                    $(".msgdraft").show();
                    // alert("You've already added product in draft");
                    return false;
                });

            });

        </script>
    @endsection
