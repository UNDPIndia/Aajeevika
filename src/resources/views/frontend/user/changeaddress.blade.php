@extends('layouts.header')
@section('title', 'Change Address | UNDP')
@section('content')
    <div class="main">
        <section class="upload-sec">
            <div class="container">
                <form enctype="multipart/form-data" action="{{ url('/changeaddress') }}" method="POST">
                    @csrf
                    <div class="upload-doc">


                        <div class="hed-aadhar">
                            <div class="them-img">
                                <img src="assets/images/location5.svg">
                            </div>
                            <h5>{{Session::get('weblangauge') == 'kn' ? 'पता':'Address'}}</h5>
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
                                    <?php
                                           //    echo "ss page";die;
                                        //echo "<pre>"; print_r($useraddress);die;
                                    ?>

                                        @if (Auth::user()->role_id != '1')
                                            <input type="hidden" name="id"
                                                value="{{ isset($useraddress->id)?$useraddress->id:'' }}" />
                                        @else
                                            <input type="hidden" name="id"
                                                value="{{ isset($useraddress->id)?$useraddress->id:'' }}" />
                                        @endif


                                        <input required type="text" name="address_line_one"
                                            class="form-control form-control2" placeholder="{{Session::get('weblangauge') == 'kn' ? 'पता क्रम 1':'Address Line 1'}}"
                                            value="{{$useraddress ? $useraddress->address_line_one: old('address_line_one') }}">
                                            
                                    </div>
                                </div>
                                @if (Auth::user()->role_id != '1')
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">

                                            <input type="text" name="address_line_two"
                                                class="form-control form-control2" placeholder="{{Session::get('weblangauge') == 'kn' ? 'पता क्रम 2':'Address Line 2'}}"
                                                value="{{ $useraddress ? $useraddress->address_line_two: old('address_line_two') }}">
                                                
                                        </div>
                                    </div>
                                @endif


                                @if (Auth::user()->role_id != '5')


                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select name="country" class="form-control">
                                                <option value="101">{{Session::get('weblangauge') == 'kn' ? 'भारत':'India'}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="state" class="form-control">
                                                <option value="39">{{Session::get('weblangauge') == 'kn' ? 'उत्तराखण्ड':'Uttarakhand'}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="district" class="form-control districtt">
                                                @php
                                                    $language = Session::get('weblangauge');
                                                    $name = 'name';
                                                    if($language == 'kn') {
                                                        $name = 'name_kn as name';
                                                    }
                                                    $cityData = \App\City::where(['is_district' => 1 , 'state_id' => 39])->select($name, 'id')->get();
                                                @endphp
                                                @foreach ($cityData as $item)
                                                    <option value="{{ $item->id }}" <?php echo $item->id == Auth::user()->district? 'selected':'' ?>>{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                @else


                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select name="country" class="form-control con2">
                                                <option value=""> -Select Country- </option>
                                                @php
                                                    $condata = \App\Country::get();
                                                @endphp
                                                @foreach ($condata as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="state" class="form-control state">
                                                <option value=""> -Select State- </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-5">
                                            <select required name="district" class="form-control district">
                                                <option value=""> -Select district- </option>

                                            </select>
                                        </div>
                                    </div>


                                @endif
                                <div class="col-md-6">
                                    <div class="form-group form-group-5">
                                        <input  autocomplete="off" required maxlength="6" minlength="6" type="tel" name="pincode"
                                            class="form-control form-control2 @if (Auth::user()->role_id == '2' || Auth::user()->role_id == '3') pincode @endif" placeholder="Pin"
                                        value="{{  $useraddress ? $useraddress->pincode: old('pincode') }}">
                                        <span class="msg"><span>
                                    </div>
                                </div>
                                @if (Auth::user()->role_id != '1')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-in">
                                                <select name="block" class="form-control blockk  d1" required>
                                                    @php
                                                    $city_id = Auth::user()->block ? Auth::user()->city_id :5219;
                                                    $language = Session::get('weblangauge');
                                                    $name = 'name';
                                                    if($language == 'kn') {
                                                        $name = 'name_kn as name';
                                                    }
                                                        $cityData = \App\Block::where(['city_id' => $city_id])->where('status', 0)->select($name, 'id', 'city_id')->get();
                                                    @endphp
                                                    @foreach ($cityData as $item)
                                                        <option value="{{ $item->id }}" <?php echo $item->id == Auth::user()->block? 'selected':'' ?>>{{ $item->name }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="btn-sub text-center">
                        <input type="submit" name="" value="{{Session::get('weblangauge') == 'kn' ? 'सबमिट करें':'Submit'}}" class="them-btn sbmitbtn">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(".pincode_HOLD").keyup(function() {
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
                    if (data.status == false) {
                        $('.sbmitbtn').prop('disabled', true);
                        $('.msg').html('Invalid PIN Code')

                    }

                    if (data.status == true) {
                        $('.sbmitbtn').prop('disabled', false);
                        $('.msg').html('');
                    }
                }
            });
        });
        $('.con2').change(function() {
            var country_id = $(this).val();
            $('.state').empty();
            $('.state').append(' <option value="">--Select state--</option>');
            $('.district').empty();
            $('.district').append(' <option value="">--Select District--</option>');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/getstate') }}",
                data: {
                    country_id: country_id,
                },
                dataType: "json",

                success: function(data) {
                    $.each(data.data.states, function(i, obj) {
                        console.log(obj.name);
                        var div_data = "<option value=" + obj.id + ">" + obj.name + "</option>";
                        $(div_data).appendTo('.state');


                    });


                }
            });
        });

        $('.state').change(function() {

            var id = $(this).val();

            $('.district').empty();
            $('.district').append(' <option value="">--Select District--</option>');
            $.ajax({
                type: 'POST',
                url: '/api/get_city',
                data: {
                    state_id: id
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'app-key': 'laravelUNDP'
                },

                success: function(data) {
                    $.each(data.data.district, function(i, obj) {
                        console.log(obj.name);
                        var div_data = "<option value=" + obj.id + ">" + obj.name + "</option>";
                        $(div_data).appendTo('.district');
                    });
                }
            });
        });


        $(document).on('change','.districtt',function(){
            var city_id = $(this).val();
           // alert(city_id);
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"{{ url('/blockAjaxx') }}",
                data:{_token,city_id},
                success:function(response)
                {
                    $('.blockk').html(response);

                }  


            });

        });

    </script>
@endsection
