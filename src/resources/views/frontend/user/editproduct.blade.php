@extends('layouts.header')
@section('title', 'Edit Product| UNDP')
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
        <section class="upload-sec">
            <div class="container">


                <form method="POST" action="{{ url('/editproduct_step_2') }}/{{encrypt($productData->id)}}">
                    @csrf
                    <div class="upload-doc style-2">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{-- @foreach ($errors->all(':message') as $error) --}}
                                {{ $errors->first() }}
                                {{-- @endforeach --}}
                            </div>
                        @endif
                        <div class="uolod">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <select name="categoryId" class="form-control getsubcats" id="">
                                            @if (Session::get('weblangauge') == 'kn')
                                                <option value="">श्रेणी का चयन करें</option>
                                            @else
                                                <option value="">Select Category</option>
                                            @endif
                                            @foreach ($categoryData as $item)
                                                <option @if ($item->id == $productData->categoryId)
                                                    selected
                                                @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <select name="subcategoryId" class="form-control" id="subcats">
                                            @if (Session::get('weblangauge') == 'kn')
                                                <option value="">उप-श्रेणी का चयन करें</option>
                                            @else
                                                <option value="">Select Sub Category</option>
                                            @endif

                                            @foreach ($subcategoryData as $item)
                                                <option @if ($item->id == $productData->subcategoryId)
                                                    selected
                                                @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <select class="form-control" name="material_id" id="materials">
                                            @if (Session::get('weblangauge') == 'kn')
                                                <option value="">उत्पाद का प्रकार *</option>
                                            @else
                                                <option value="">Product Type</option>
                                            @endif

                                            @foreach ($materials as $item)
                                                <option @if ($item->id == $productData->material_id)
                                                    selected
                                                @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <select class="form-control" name="tempalte_id" id="tempalte_id">
                                            @if (Session::get('weblangauge') == 'kn')
                                                <option value="">उत्पाद का चयन करें</option>
                                            @else
                                                <option value="">Select Product</option>
                                            @endif

                                            @foreach ($template as $item)
                                                <option @if ($item->id == $productData->template_id)
                                                    selected
                                                @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        @if (Session::get('weblangauge') == 'kn')
                                        <label class="lbl">उत्पाद की कीमत *</label>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="6" title="please enter number only" name="price" class="form-control form-control2"
                                                placeholder="उत्पाद की कीमत" value="{{$productData->price}}">
                                        @else
                                        <label class="lbl">Product Price *</label>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="6" title="please enter number only" name="price" class="form-control form-control2"
                                                placeholder="Product Price" value="{{$productData->price}}">
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        @if (Session::get('weblangauge') == 'kn')
                                        <label class="lbl">उपलब्ध मात्रा *</label>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" title="please enter number only" name="qty" class="form-control form-control2"
                                                placeholder="उपलब्ध मात्रा" value="{{ $productData->qty }}">
                                        @else
                                        <label class="lbl">Product Quantity *</label>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" title="please enter number only" name="qty" class="form-control form-control2"
                                                placeholder="Product Quantity" value="{{ $productData->qty }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-5">
                                        <select required class="form-control" name="price_unit" id="price_unit">
                                        <option value="Boxes" <?php echo ($productData->price_unit == 'Boxes') ?'selected':''?> >Boxes</option>
                                        <option value="Crates" <?php echo ($productData->price_unit == 'Crates')?'selected':''?> >Crates</option>
                                        <option value="KG" <?php echo ($productData->price_unit == 'KG')?'selected':''?> >KG</option>
                                        <option value="Liter" <?php echo ($productData->price_unit == 'Liter')?'selected':''?> >Liter</option>
                                        <option value="Packages" <?php echo ($productData->price_unit == 'Packages')?'selected':''?> >Packages</option>
                                        <option value="Pakets" <?php echo ($productData->price_unit == 'Pakets')?'selected':''?> >Pakets</option>
                                        <option value="Piece" <?php echo ($productData->price_unit == 'Piece')?'selected':''?> >Piece</option>
                                        <option value="Units" <?php echo ($productData->price_unit == 'Units')?'selected':''?> >Units</option>

                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <h6 class="check-heding">उत्पाद स्थानीय नाम</h6>


                                    @else <h6 class="check-heding">Product Local Name</h6>

                                    @endif


                                    <div class="check-box-2">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-group-5">
                                                    <input maxlength="140" type="tex" pattern="[a-zA-Z.'- ]+" name="localname_en" class="form-control form-control2"
                                                        placeholder="English" value="{{ $productData->localname_en }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-group-5">
                                                    <input maxlength="140" type="tex"  name="localname_kn" class="form-control form-control2"
                                                        placeholder="Kannada" value="{{ $productData->localname_kn }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    @if (Session::get('weblangauge') == 'kn')
                                        <div class="bbtn-sub mt-3 text-center">
                                            <input type="submit" name="submit" value="अगला" class="them-btn">
                                        </div>
                                    @else
                                        <div class="bbtn-sub mt-3 text-center">
                                            <input type="submit" name="submit" value="Next" class="them-btn">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>
            $(".getsubcats").change(function() {
                var id = $(this).val();

                $('#subcats').empty();
                @if (Session::get('weblangauge') == 'kn')
                    $('#subcats').append(' <option value="">उपश्रेणी का चयन करें</option>');
                @else
                    $('#subcats').append(' <option value="">Select Subcategory</option>');
                @endif

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/get_subcats') }}",
                    data: {
                        parent_id: id
                    },
                    dataType: "json",

                    success: function(data) {
                        $.each(data.data, function(i, obj) {
                            console.log(obj.name);
                            var div_data = "<option value=" + obj.id + ">" + obj.name +
                                "</option>";
                            $(div_data).appendTo('#subcats');


                        });


                    }
                });
            });


            $(document).on('change', '#subcats', function() {
                var id = $(this).val();
                $('#materials').empty();
                @if (Session::get('weblangauge') == 'kn')
                    $('#materials').append(' <option value="">प्रकार चुनें</option>');
                @else
                    $('#materials').append(' <option value="">Select Type</option>');
                @endif

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    type: 'POST',
                    url: "{{ url('/get_material') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",

                    success: function(data) {
                        $.each(data.data, function(i, obj) {
                            console.log(obj.name);
                            var div_data = "<option value=" + obj.id + ">" + obj.name +
                                "</option>";
                            $(div_data).appendTo('#materials');
                        });
                    }
                });
            });


            //get template here
            $(document).on('change', '#materials', function() {
                var materialId = $(this).val();
                $('#tempalte_id').empty();
                @if (Session::get('weblangauge') == 'kn')
                    $('#tempalte_id').append(' <option value="">उत्पाद का चयन करें</option>');
                @else
                    $('#tempalte_id').append(' <option value="">Select Product</option>');
                @endif

                var subcategoryId = $("#subcats").val();
                var categoryId = $(".getsubcats").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    type: 'POST',
                    url: "{{ url('/get_template') }}",
                    data: {
                        categoryId: categoryId,
                        subcategoryId: subcategoryId,
                        materialId: materialId
                    },
                    dataType: "json",

                    success: function(data) {
                        console.log(data.data.template);



                        $.each(data.data.template, function(i, obj) {
                            console.log(obj.name);
                            var div_data = "<option value=" + obj.id + ">" + obj.name +
                                "</option>";
                            $(div_data).appendTo('#tempalte_id');
                        });
                    }
                });


            });

        </script>

    @endsection
