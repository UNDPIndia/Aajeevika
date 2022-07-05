@extends('layouts.header')
@section('title', 'Add New Product step 3| UNDP')
@section('content')

    <div class="main">
        <div class="category-banner">
            <div class="container">
                <div class="row">
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
        <!-- Category List -->
        <section class="new-product-outer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="{{ url('/addproduct') }}" method="POST">
                            @csrf
                            <div class="product-form-inner form-language">

                                <input type="hidden" value="{{$dataset_2}}" name="dataset_2">
                                <input type="hidden" value="{{$certificateData}}" name="certificateData">
                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'विवरण अंग्रेजी में':'Description in English'}}</div>

                                <textarea maxlength="1000" id="tweet" class="form-control"
                                    name="des_en">{{ $template->description_en }}</textarea>
                                <div id="textarea_feedback"></div>

                                <div class="title">{{Session::get('weblangauge') == 'kn' ? 'विवरण हिंदी में':'Description in Hindi'}}</div>

                                <textarea maxlength="1000" id="tweet2" class="form-control" name="des_kn">{{ $template->description_kn }}</textarea>

                                <div id="textarea_feedback2"></div>





                                <div class="btn-outer d-flex justify-content-center mt-4">
                                    <!-- <div class="col-sm-6"><button type="submit" name="submit" value="draft"
                                            class="btn btn-outline-secondary">Save to Draft</button>
                                    </div> -->
                                    <div class="col-sm-6"><button type="submit" name="submit" value="add"
                                            class="btn btn-sm them-btn">{{Session::get('weblangauge') == 'kn' ? 'जोड़ें':'Add'}}</button>
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
            $(document).ready(function() {
                var text_length = '{{ $template->description_en }}';
                var text_max = 1000 - text_length.length;
                $('#textarea_feedback').html(text_max + ' characters remaining');

                $('#tweet').keyup(function() {
                    var text_length = $('#tweet').val().length;
                    var text_remaining = 1000 - text_length;

                    $('#textarea_feedback').html(text_remaining + ' characters remaining');
                });


                var text_length_kn = '{{ $template->description_kn }}';
                var text_max2 = 1000 - text_length_kn.length;
                $('#textarea_feedback2').html(text_max2 + ' characters remaining');

                $('#tweet2').keyup(function() {
                    var text_length2 = $('#tweet2').val().length;
                    var text_remaining2 = 1000 - text_length2;

                    $('#textarea_feedback2').html(text_remaining2 + ' characters remaining');
                });
            });

        </script>
    @endsection
