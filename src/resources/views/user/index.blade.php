@extends('layouts.app')
@section('title', 'User Management | UNDP')
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
                    <h3 class="card-title">Users (This Manager is to manage User)</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <form action="" method="GET" role="search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="s" placeholder="Search User" value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="col-md-9 form-group">


                    <form action="" method="GET" role="export">

                        @php
                        foreach ($_GET as $key => $value) {
                        if ($key != 'exportlist') {
                        echo "<input type='hidden' name='$key' value='$value' />";
                        }
                        }
                        @endphp
                        @csrf
                        <div class="input-group">

                            <select name="exportlist" class="form-control exportlist">
                                <option> -Selecty Option For export- </option>

                                <option value="all">All </option>
                                <option value="state">State</option>
                                <option value="district">District</option>

                            </select>
                            <select name="state_name" id="subcats" class="form-control getdistrict  d-none">
                                <option>-Select State-</option>
                                @foreach ($stateList as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                            <select id="district" name="district_name" class="form-control district d-none">
                                <option>-Select District-</option>
                            </select>



                            <span class="input-group-btn">
                                <button type="submit" id="exportbutton" name="viewdata" value="viewdata" class="btn btn-default">
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
                            <th>Name</th>
                            <th>Profile Image </th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>District</th>
                            
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = $userData->perPage() * ($userData->currentPage() - 1) + 1;
                        @endphp
                        @foreach ($userData as $item)
                        <?php ?>
                        @php

                        @endphp

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->profileImage == null)
                                <img src="{{ asset('public/assets/images/dummyundp.jpg') }}" height="50px" width="50px">

                                @else
                                <img src="{{ asset($item->profileImage) }}" height="50px" width="50px">
                                @endif
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->district_name ?? 'NA' }}</td>
                            
                            <td>
                                @if ($item->address_line_one)
                                {{ $item->address_line_one }} {{ $item->address_line_two }}
                                @endif
                            </td>
                            <td>{{ $item->pincode }}</td>
                            <td>
                                @if ($item->isActive == 1)
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/blockUser') }}/{{ encrypt($item->id) }}/{{ 0 }}" id={{ $item->id }} class="btn btn-outline-danger btn-sm">Block</a>
                                @else
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/blockUser') }}/{{ encrypt($item->id) }}/{{ 1 }}" id={{ $item->id }} class="btn btn-outline-success btn-sm">Active</a>
                                @endif


                                {{-- <a href="{{ url('admin/deleteAdmin User') }}/{{ $item->id }}" class="btn btn-outline-danger btn-sm">Delete</a> --}}

                            </td>
                        </tr>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                {{ $userData->links() }}
            </div>
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
            if (!$('.getdistrict').hasClass("d-none")) {
                $('.getdistrict').addClass('d-none');
            }
            if (!$('.district').hasClass("d-none")) {
                $('.district').addClass('d-none');
            }
        }

        if (type == 'state') {
            $('.getdistrict').removeClass('d-none');


            $('.district').addClass('d-none');


            if (vars['exportlist'] == 'state') {
                var state_name = vars['state_name'];
                $('#subcats').val(state_name).attr("selected", "selected");
            }
        }

        if (type == "district") {
            $('.getdistrict').removeClass('d-none');
            $('.district').removeClass('d-none');




            $(".getdistrict").change(function() {
                var id = $(this).val();

                $('#district').empty();
                $('#district').append(' <option value="">--Select District--</option>');
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
                            var div_data = "<option value=" + obj.id + ">" + obj
                                .name + "</option>";
                            $(div_data).appendTo('#district');


                        });
                        var district_name = vars['district_name'];
                        $('#district').val(district_name).attr("selected", "selected").trigger('change');

                    }
                });
            });


            var state_name = vars['state_name'];
            $('#subcats').val(state_name).attr("selected", "selected").trigger('change');



        }


    });

    $('.exportlist').val(vars['exportlist']).trigger("change");
</script>
@endsection