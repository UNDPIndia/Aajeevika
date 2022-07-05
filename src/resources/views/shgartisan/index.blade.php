@extends('layouts.app')
@section('title', 'SHG/CLF Listing | UNDP')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>UNDP</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="/admin">Home</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">

                    <h3 class="card-title">SHG Enterprise / CLF (This Manager is to manage SHG Enterprise and CLF)</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <form action="" method="GET" role="search" class="viewForm">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="s" placeholder="Search SHG/CLF" value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- <form action="" method="GET" role="search">
                                                                                                        @csrf
                                                                                                        <div class="input-group">
                                                                                                            <input type="hidden" class="form-control" name="s" placeholder="Search SHG/Artisans"
                                                                                                                value="">
                                                                                                            <span class="input-group-btn">
                                                                                                                <button type="submit" class="btn btn-default">
                                                                                                                    Reset
                                                                                                                </button>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </form> -->
                </div>

                <div class="col-md-8 form-group">


                    <form action="" method="GET" role="export">

                        {{-- @php
                            dd($_GET);
                                foreach ($_GET as $key => $value) {
                                    if ($key != 'exportlist') {
                                        echo "<input type='hidden' name='$key' value='$value' />";
                                    }
                                }
                            @endphp --}}



                        @csrf
                        <div class="input-group">

                            <select name="exportlist" class="form-control exportlist" required>
                                <option value=""> -Select Option- </option>
                                <option value="all">All SHG/ CLF</option>
                                <option value="category">Category wise</option>
                                <option value="subcategory">Sub-category wise</option>
                                <option value="material">Product Type wise</option>
                                <option value="product">Product Name wise</option>
                                <?php if (Auth::user()->role_id == '5') { ?>
                                <option value="district">District wise</option>
                                <?php } ?>
                                <option value="shg">All SHG Enterprise</option>
                                <option value="artisan">All CLF</option>
                            </select>


                            <select name="category_name" id='cats' class="form-control category getsubcats d-none">
                                <option value="">-Select Category-</option>
                            </select>

                            <select name="subcategory_name" id="subcats" class="form-control subcategory  d-none">
                                <option value="">-Select Sub Category-</option>
                            </select>

                            <select id="materials" name="material_name" class="form-control material d-none">
                                <option value="">-Select Product Type-</option>
                            </select>

                            <select id="tempalte_id" name="products_name" class="form-control products d-none">
                                <option value="">-Select Product-</option>
                            </select>
                            <?php if (Auth::user()->role_id == '5') { ?>
                            <select id="district_id" name="district_id" class="form-control district d-none">
                                <option value="">-Select District-</option>

                                @foreach ($districtList as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                                <?php } ?>

                            <span class="input-group-btn">
                                <button type="submit" id="exportbuttonview" name="viewdata" value="viewdata" class="btn btn-default">
                                    View
                                </button>
                            </span>

                            <span class="input-group-btn">
                                <button type="submit" id="exportbutton" name="exportdata" value="exportdata" class="btn btn-default">
                                    Export
                                </button>
                            </span>



                        </div>
                    </form>




                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Organization Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th>District</th>
                            <!-- <th>Village</th> -->
                            <th>Block</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $shgartisanData->perPage() * ($shgartisanData->currentPage() - 1) + 1;

                        @endphp
                        @if (count($shgartisanData) > 0)
                        @foreach ($shgartisanData as $item)
                        @php

                        @endphp

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->organization_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>
                                @if ($item->role_id == 2)
                                CLF
                                @elseif($item->role_id == 3)
                                SHG Enterprise
                                @elseif($item->role_id == 7)
                                Saras Center
                                @elseif($item->role_id == 8)
                                Growth Center
                                @endif
                            </td>
                            <td>{{ $item->district_name ?? 'NA' }}</td>
                            
                            <td>{{ $item->block_name ?? 'NA' }}</td>
                            <td>
                                @if ($item->address_line_one)
                                {{ $item->address_line_one }} {{ $item->address_line_two }}
                                @endif
                            </td>
                            <td>{{ $item->pincode }}</td>
                            <td>
                                <a href="{{ url('admin/viewshgatrisan') }}/{{ encrypt($item->id) }}" class="btn btn-outline-primary btn-sm">View</a>

                                @if ($item->isActive == 1)
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/blockshgatrisan') }}/{{ encrypt($item->id) }}/0" class="btn btn-outline-danger btn-sm">Block</a>
                                @else
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/blockshgatrisan') }}/{{ encrypt($item->id) }}/1" class="btn btn-outline-success btn-sm">Un Block</a>
                                @endif


                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">
                                <center>
                                    <p>Data not found</p>
                                </center>
                            </td>
                        </tr>

                        @endif
                    </tbody>
                </table>
                {{ $shgartisanData->appends(Request::except('page'))->links() }}
                {{-- {{ $shgartisanData->links() }} --}}
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>

</section>



@endsection
@section('script')

<script>
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    console.log(vars);


    $('#exportbuttonview').click(function(e) {
        // e.preventDefault();
        // var exportlist = $('.exportlist').val();
        // alert(exportlist);


        // var formValues= $(".viewForm").serialize();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     type: 'GET',
        //     url: "{{ url('/admin/shgartisans') }}",
        //     dataType: "json",

        //     success: function(data) {

        //     }
        // });


    });

    $('.exportlist').change(function() {

        var type = $(this).val();
        if (type == 'all') {

            if (!$('.category').hasClass("d-none")) {
                $('.category').addClass('d-none');
            }
            if (!$('.subcategory').hasClass("d-none")) {
                $('.subcategory').addClass('d-none');
            }
            if (!$('.material').hasClass("d-none")) {
                $('.material').addClass('d-none');
            }
            if (!$('.products').hasClass("d-none")) {
                $('.products').addClass('d-none');

            }
            if (!$('.district').hasClass("d-none")) {
                $('.district').addClass('d-none');
            }
        }

        if (type == 'shg' || type == 'artisan') {
            if (!$('.category').hasClass("d-none")) {
                $('.category').addClass('d-none');
            }
            if (!$('.subcategory').hasClass("d-none")) {
                $('.subcategory').addClass('d-none');
            }
            if (!$('.material').hasClass("d-none")) {
                $('.material').addClass('d-none');
            }
            if (!$('.products').hasClass("d-none")) {
                $('.products').addClass('d-none');

            }
            if (!$('.district').hasClass("d-none")) {
                $('.district').addClass('d-none');
            }
        }
        if (type == "category") {


            $('.category').removeClass('d-none');

            if (!$('.subcategory').hasClass("d-none")) {
                $('.subcategory').addClass('d-none');
            }
            if (!$('.material').hasClass("d-none")) {
                $('.material').addClass('d-none');
            }
            if (!$('.products').hasClass("d-none")) {
                $('.products').addClass('d-none');
            }

            $('.district').addClass('d-none');

            $('#cats').empty();
            var div_data = "<option value> --Select Category-- </option>";
            $(div_data).appendTo('.category');

            $('#subcats').empty();
                var div_data1 = "<option value>--Select Subcategory--</option>";
                        $(div_data1).appendTo('#subcats');
                      var  div_data ='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/get_allcategories') }}",
                dataType: "json",
                success: function(data) {
                    $.each(data.data, function(i, obj) {
                        console.log(obj.name_en);
                        var div_data = "<option value=" + obj.id + ">" + obj.name_en + "</option>";
                        $(div_data).appendTo('.category');
                    });

                    if (vars['exportlist'] == 'category') {
                        var category = vars['category_name'];
                        $('#cats').val(category).attr("selected", "selected");
                    }
                }
            });




        }

        if (type == "subcategory") {
            $('.category').removeClass('d-none');
            $('.subcategory').removeClass('d-none');
            $('.district').addClass('d-none');
            if (!$('.material').hasClass("d-none")) {
                $('.material').addClass('d-none');
            }
            if (!$('.products').hasClass("d-none")) {
                $('.products').addClass('d-none');
            }

            $('#cats').empty();
            var div_data = "<option value> --Select Category-- </option>";
            $(div_data).appendTo('.category');

            $('#subcats').empty();
                var div_data1 = "<option value>--Select Subcategory--</option>";
                     $(div_data1).appendTo('#subcats');
                 var  div_data ='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/get_allcategories') }}",
                dataType: "json",
                success: function(data) {
                    $.each(data.data, function(i, obj) {
                        console.log(obj.name_en);
                        var div_data = "<option value=" + obj.id + ">" + obj.name_en +
                            "</option>";
                        $(div_data).appendTo('.category');
                    });
                    var category = vars['category_name'];
                    $('#cats').val(category).attr("selected", "selected").trigger('change');


                }
            });


            $(".getsubcats").change(function() {
                var id = $(this).val();
                //$('#cats').empty();
                $('#subcats').empty();
                var div_data = "<option value>--Select Subcategory--</option>";
                       $(div_data).appendTo('#subcats');
                var div_data = '';
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
                        $.each(data.data, function(i, objj) {
                            console.log(objj.name_en);
                            var div_data = "<option value=" + objj.id + ">" + objj
                                .name_en +
                                "</option>";
                            $(div_data).appendTo('#subcats');


                        });

                        var subcategory = vars['subcategory_name'];
                        $('#subcats').val(subcategory).attr("selected", "selected");


                    }
                });
            });
        }


        if (type == 'material') {
            $('.category').removeClass('d-none');
            $('.subcategory').removeClass('d-none');
            $('.material').removeClass('d-none');
            if (!$('.products').hasClass("d-none")) {
                $('.products').addClass('d-none');
            }
            $('.district').addClass('d-none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/get_allcategories') }}",
                dataType: "json",
                success: function(data) {
                    $.each(data.data, function(i, obj) {
                        console.log(obj.name_en);
                        var div_data = "<option value=" + obj.id + ">" + obj.name_en +
                            "</option>";
                        $(div_data).appendTo('.category');
                    });
                    var category = vars['category_name'];
                    $('#cats').val(category).attr("selected", "selected").trigger('change');
                }
            });


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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name_en +
                                "</option>";
                            $(div_data).appendTo('#subcats');


                        });

                        var subcategory = vars['subcategory_name'];
                        $('#subcats').val(subcategory).attr("selected", "selected").trigger('change');


                    }
                });
            });


            $(document).on('change', '#subcats', function() {
                var id = $(this).val();
                $('#materials').empty();
                $('#materials').append(' <option value="">--Select Product Type--</option>');

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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name_en +
                                "</option>";
                            $(div_data).appendTo('#materials');
                        });

                        var material_name = vars['material_name'];
                        $('#materials').val(material_name).attr("selected", "selected").trigger('change');
                    }
                });
            });



        }

        if (type == 'product') {
            $('.category').removeClass('d-none');
            $('.subcategory').removeClass('d-none');
            $('.material').removeClass('d-none');
            $('.products').removeClass('d-none');
            $('.district').addClass('d-none');
            $('#cats').empty();
            var div_data = "<option value>--Select Category--</option>";
                        $(div_data).appendTo('.category');

                $('#subcats').empty();
                var div_data1 = "<option value>--Select Subcategory--</option>";
                        $(div_data1).appendTo('.subcategory');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('/get_allcategories') }}",
                dataType: "json",
                success: function(data) {
                    $.each(data.data, function(i, obj) {
                        console.log(obj.name_en);
                        var div_data = "<option value=" + obj.id + ">" + obj.name_en +
                            "</option>";
                        $(div_data).appendTo('.category');
                    });
                    var category = vars['category_name'];
                    $('#cats').val(category).attr("selected", "selected").trigger('change');
                }
            });


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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name_en +
                                "</option>";
                            $(div_data).appendTo('#subcats');


                        });
                        var subcategory = vars['subcategory_name'];
                        $('#subcats').val(subcategory).attr("selected", "selected").trigger('change');


                    }
                });
            });


            $(document).on('change', '#subcats', function() {
                var id = $(this).val();
                $('#materials').empty();
                $('#materials').append(' <option value="">--Select Product Type--</option>');

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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name_en +
                                "</option>";
                            $(div_data).appendTo('#materials');
                        });

                        var material_name = vars['material_name'];
                        $('#materials').val(material_name).attr("selected", "selected").trigger('change');
                    }
                });
            });


            $(document).on('change', '#materials', function() {
                var materialId = $(this).val();
                //alert(materialId);
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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name +
                                "</option>";
                            $(div_data).appendTo('#tempalte_id');
                        });

                        var products_name = vars['products_name'];
                        $('#tempalte_id').val(products_name).attr("selected", "selected").trigger('change');
                    }
                });


            });
        }

        if (type == 'district') {
            $('.category').addClass('d-none');
            $('.subcategory').addClass('d-none');
            $('.material').addClass('d-none');
            $('#tempalte_id').addClass('d-none');

            
            $('.district').removeClass('d-none');

            var district_id = vars['district_id'];
            $('#district_id').val(district_id).attr("selected", "selected");


        }
    });






    $('.exportlist').val(vars['exportlist']).trigger("change");
</script>

<script>
    $(document).ready(function() {
        // $('#category').select2();
        // $('#subcats').select2();
        // $('#materials').select2();
        // $('#tempalte_id').select2();
    });
</script>
@endsection