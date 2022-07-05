@extends('layouts.app')
@section('title', 'Product Management | UNDP')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UNDP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <form enctype="multipart/form-data" action="{{ url('admin/editproduct') }}/{{ encrypt($id) }}" method="post">
        @csrf
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Product</h3>
                </div>
                <div class="card-body">

                    @csrf
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="">Local Name English*</label>
                            <input required type="text" class="form-control" name="localname_en"
                                value="{{ $productDetail->localname_en }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Local Name Hindi*</label>
                            <input required type="text" class="form-control" name="localname_kn"
                                value="{{ $productDetail->localname_kn }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Category* </label>

                            <select required class="form-control getsubcats" name="categoryId" id="">
                                <option value="">--Select Parent Category--</option>
                                @foreach ($categoryData as $item)
                                    <option @if ($productDetail->categoryId == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name_en }}
                                    </option>
                                @endforeach
                            </select>


                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Sub Category* </label>
                            <select required class="form-control" name="subcategoryId" id="subcats">
                                <option value="">--Select Sub Category--</option>

                                @foreach ($subcategoryData as $item)
                                    <option @if ($productDetail->subcategoryId == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name_en }}
                                    </option>
                                @endforeach


                            </select>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Material* </label>


                            <select required class="form-control" name="material_id" id="materials">
                                <option value="">--Select Material--</option>

                                @foreach ($materialData as $item)
                                    <option @if ($productDetail->material_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name_en }}
                                    </option>
                                @endforeach


                            </select>

                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Price* </label>
                            <input required type="text" class="form-control" name="price" value="{{ $productDetail->price }}"
                                id="">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Quantity* </label>
                            <input required type="text" class="form-control" name="qty" value="{{ $productDetail->qty }}"
                                id="">
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="">Desription English* </label>
                            <textarea required class="form-control" name="des_en" id="">{{ $productDetail->des_en }}</textarea>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Desription Hindi* </label>
                            <textarea required class="form-control" name="des_kn" id="">{{ $productDetail->des_kn }}</textarea>
                        </div>


                    </div>

                </div>
                <div class="card-header">
                    <h3 class="card-title">Product Measurements</h3>

                </div>
                <div class="card-body">
                    <div class="row">

                        @if ($productDetail->length != null)
                            <div class="col-sm-3 form-group" >
                                <label for="">Length*</label>
                                <input required type="text" class="form-control" name="length"
                                    value="{{ $productDetail->length }}" id="">

                                    <span class="input-group-btn" >
                                    <select required name="length_unit" class="form-control">
                                        <option @if ($productDetail->length_unit == "cm") selected @endif value="Cm">CM</option>

                                        <option  @if ($productDetail->length_unit == "Meter") selected @endif value="Meter">Meter</option>
                                        <option  @if ($productDetail->length_unit == "Inch") selected @endif value="Inch">Inch</option>
                                        <option  @if ($productDetail->length_unit == "Feet") selected @endif value="Feet">Feet</option>
                                    </select></span>



                            </div>
                        @endif

                        @if ($productDetail->height != null)
                            <div class="col-sm-3 form-group" >
                                <label for="">Height*</label>
                                <input required type="text" class="form-control" name="height"
                                    value="{{ $productDetail->height }} " id="">

                                    <span class="input-group-btn" >
                                        <select required name="height_unit" class="form-control">
                                            <option @if ($productDetail->height_unit == "cm") selected @endif value="Cm">CM</option>

                                            <option  @if ($productDetail->height_unit == "Meter") selected @endif value="Meter">Meter</option>
                                            <option  @if ($productDetail->height_unit == "Inch") selected @endif value="Inch">Inch</option>
                                            <option  @if ($productDetail->height_unit == "Feet") selected @endif value="Feet">Feet</option>
                                        </select></span>
                            </div>
                        @endif

                        @if ($productDetail->width != null)

                            <div class="col-sm-3 form-group" >
                                <label for="">Width* </label>
                                <input required type="text" class="form-control" name="width"
                                    value="{{ $productDetail->width }}" id="">

                                    <span class="input-group-btn" >
                                        <select required name="width_unit" class="form-control">
                                            <option @if ($productDetail->width_unit == "cm") selected @endif value="Cm">CM</option>

                                            <option  @if ($productDetail->width_unit == "Meter") selected @endif value="Meter">Meter</option>
                                            <option  @if ($productDetail->width_unit == "Inch") selected @endif value="Inch">Inch</option>
                                            <option  @if ($productDetail->width_unit == "Feet") selected @endif value="Feet">Feet</option>
                                        </select></span>
                            </div>

                        @endif

                        @if ($productDetail->weight != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Weight* </label>
                                <input required type="text" class="form-control" name="weight"
                                    value="{{ $productDetail->weight }}" id="">

                                    <select name="weight_unit" class="form-control">
                                        <option  @if ($productDetail->weight_unit == "KG") selected @endif value="KG">KG</option>
                                        <option  @if ($productDetail->weight_unit == "GM") selected @endif value="GM">GM</option>

                                    </select>
                            </div>
                        @endif



                        @if ($productDetail->vol != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Vol* </label>
                                <input required type="text" class="form-control" name="vol"
                                    value="{{ $productDetail->vol }}" id="">

                                    <select name="vol_unit" class="form-control">
                                        <option @if ($productDetail->vol_unit == "MI") selected @endif value="MI">Mi</option>
                                        <option @if ($productDetail->vol_unit == "Liter") selected @endif value="Liter">Liter</option>

                                    </select>
                            </div>
                        @endif

                    </div>
                </div>



                <div class="card-header">
                    <h3 class="card-title">Product Images</h3>

                </div>
                <div class="card-body">
                    @php
                    //dd($productDetail->image_1);
                    @endphp
                    <div class="row">

                        @if ($productDetail->image_1 != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Image 1 </label>
                                <img class="img-thumbnail" src="{{ asset($productDetail->image_1) }}">
                            </div>
                        @endif


                        @if ($productDetail->image_2 != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Image 2 </label>
                                <img class="img-thumbnail" src="{{ asset($productDetail->image_2) }}">
                            </div>
                        @endif

                        @if ($productDetail->image_3 != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Image 3 </label>
                                <img class="img-thumbnail" src="{{ asset($productDetail->image_3) }}">
                            </div>
                        @endif


                        @if ($productDetail->image_4 != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Image 4 </label>
                                <img class="img-thumbnail" src="{{ asset($productDetail->image_4) }}">
                            </div>
                        @endif

                        @if ($productDetail->image_5 != null)
                            <div class="col-sm-3 form-group">
                                <label for="">Image 5 </label>
                                <img class="img-thumbnail" src="{{ asset($productDetail->image_5) }}">
                            </div>
                        @endif

                    </div>

                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label for="">Select New Image 1 : </label>
                            <input type="file" class="form-control" name="image_1" id="">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="">Select New Image 2 : </label>
                            <input type="file" class="form-control" name="image_2" id="">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="">Select New Image 3 : </label>
                            <input type="file" class="form-control" name="image_3" id="">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="">Select New Image 4 : </label>
                            <input type="file" class="form-control" name="image_4" id="">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="">Select New Image 5 : </label>
                            <input type="file" class="form-control" name="image_5" id="">
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button name="edit" class="btn btn-outline-success" type="submit">Save Changes</button>
                </div>



            </div>

            </div>




        </section>
    </form>


@endsection
@section('script')
<script>
    $(".getsubcats").change(function() {
        var id = $(this).val();

        $('#subcats').empty();
        $('#subcats').append(' <option value="">--Select Subcategory--</option>');

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
                    console.log(obj.name_en);
                    var div_data = "<option value=" + obj.id + ">" + obj.name_en +
                        "</option>";
                    $(div_data).appendTo('#subcats');


                });


            }
        });
    });


    $(document).on('change', '#subcats', function() {
        var id = $(this).val();
        $('#materials').empty();
        $('#materials').append(' <option value="">--Select materials--</option>');

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
                    console.log(obj.name_en);
                    var div_data = "<option value=" + obj.id + ">" + obj.name_en +
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
        $('#tempalte_id').append(' <option value="">--Select Product--</option>');

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
                subcategoryId:subcategoryId,
                materialId:materialId
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
