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

    <section class="content">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Products (This manager is to manage Products and Product Details. )</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Name,id"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-10 form-group">


                        <form action="" method="GET" role="export">

                            @php
                                // foreach ($_GET as $key => $value) {
                                //     if ($key != "exportlist") {
                                //         echo("<input type='hidden' name='$key' value='$value'/>");
                                //     }
                                // }
                            @endphp
                            @csrf
                            <div class="input-group">

                                <select name="exportlist" class="form-control exportlist">
                                    <option> -Selecty Option For export- </option>
                                    <option value="all">All Products</option>
                                    <option value="category">Category wise</option>
                                    <option value="subcategory">Sub-category wise</option>
                                    <option value="material">Product Type Wise</option>

                                </select>


                                <select name="category_name" id='cats' class="form-control category getsubcats d-none">
                                    <option>-Select Category-</option>
                                </select>

                                <select name="subcategory_name" id="subcats" class="form-control subcategory  d-none">
                                    <option>-Select Sub Category-</option>
                                </select>

                                <select id="materials" name="material_name" class="form-control material d-none">
                                    <option>-Select Product Type-</option>
                                </select>

                                
                                <span class="input-group-btn">
                                    <button type="submit" name="viewdata" value="viewdata" class="btn btn-default">
                                        View
                                    </button>
                                </span>

                                <span class="input-group-btn">
                                    <button type="submit" name="exportdata" value="exportdata" class="btn btn-default">
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

                                <th> Product Id</th>
                                <th> Product Name</th>
                                <th> Local Name</th>
                                <th> SHG Enterprise / CLF Name</th>
                                <th> Category</th>
                                <th> Sub category</th>
                                <th> Type</th>
                                <th> Quantity</th>
                                <th> Price</th>
                                <th> Price Unit</th>
                                <th> Image 1</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = $productData->perPage() * ($productData->currentPage() - 1) + 1;
                            @endphp
                            @foreach ($productData as $key => $item)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->product_id_d }}</td>
                                    <td>{{ $item->template->name_en }}</td>
                                    <td>{{ $item->localname_en }}</td>
                                    <td>{{ $item->user->name }}</td>

                                    <td>{{ $item->category->name_en }}</td>
                                    <td>{{ $item->subcategory->name_en }}</td>
                                    <td>{{ $item->material->name_en }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }} Rs.</td>
                                    <td>{{ $item->price_unit }}</td>
                                    <td>
                                    <img class="card-img-top" height="50" src="{{ asset( $item->image_1) }}" alt="">
                                </td>
                                    <td>
                                        <a href="{{ url('admin/viewproduct') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a>
                                        <a href="{{ url('admin/editproduct') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>


                                            @if ($item->is_active == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/products') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable </a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/products') }}/{{ $item->id }}/0"
                                                    class="btn btn-danger btn-sm">Disable</a>
                                            @endif

                                   <!--     <a onclick="return confirm('Are you sure?')"
                                            href="{{ url('admin/deleteproduct') }}/{{ encrypt($item->id) }}"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-outline-danger btn-sm">Delete</a>-->



                                        {{-- @if (!empty($item->popular))
                              <a href="{{ url('admin/removepopular') }}/{{ $item->id }}" class="btn btn-danger btn-sm">Remove Popular</a>
                            @else
                              <a href="{{ url('admin/addtopopular') }}/{{ $item->id }}" class="btn btn-outline-primary btn-sm">Make Popular</a>
                            @endif --}}


                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $productData->links() }} --}}
                    {{ $productData->appends(Request::except('page'))->links() }}
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

            }
            if (type == "category") {
                $('.category').removeClass('d-none');

                if (!$('.subcategory').hasClass("d-none")) {
                    $('.subcategory').addClass('d-none');
                }
                if (!$('.material').hasClass("d-none")) {
                    $('.material').addClass('d-none');
                }




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

                if (!$('.material').hasClass("d-none")) {
                    $('.material').addClass('d-none');
                }




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
                            $('#subcats').val(subcategory).attr("selected", "selected");


                        }
                    });
                });
            }


            if (type == 'material') {
                $('.category').removeClass('d-none');
                $('.subcategory').removeClass('d-none');
                $('.material').removeClass('d-none');

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


        });

        $('.exportlist').val(vars['exportlist']).trigger("change");

    </script>
@endsection
