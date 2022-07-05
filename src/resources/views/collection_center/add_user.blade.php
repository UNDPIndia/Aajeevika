@extends('layouts.app')
@section('title', 'User Collection Center | UNDP')
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                <h3 class="card-title">Add User <Center></Center></h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>

            @if(Session::has('max_user'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('max_user') }}</p>
            @endif


            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 form-group">

                    </div>
                </div>

                <form enctype="multipart/form-data" action="{{ url('admin/collection-center/adduser') }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Name * : </label>
                            <input type="text" class="form-control" name="name" id="" required>
                            <input type="hidden" class="form-control" name="collection_center_id" value="{{ $id }}">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Email Address * : </label>
                            <input type="email" class="form-control" name="email" id="" required>
                        </div>

                    </div>

                    <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Phone * : </label>
                        <input type="text" class="form-control" maxlength="10" name="mobile" id="" required>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="">Password * : </label>
                        <input type="password" class="form-control" name="password" id="" required>
                    </div>

                    </div>


                    <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Confirm Password * : </label>
                        <input type="password" class="form-control" name="password_confirmation" id="" required>
                    </div>

                    </div>
                    

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        .hideme {
            display: none;
        }

    </style>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(".check").click(function() {
            var val = $(this).val();
            if (val == "subcategory") {
                $('.subcat').removeClass('hideme')
            }

            if (val == 'category') {
                $('.subcat').addClass('hideme')
            }
        });

    </script>

<script>
$(document).on('change','#state_id',function(){
    console.log($(this).val());
    var _token = $('meta[name="csrf-token"]').attr('content');
    var state_id = $(this).val();
    $.ajax({
        type:"POST",
        url:"{{ url('admin/collection-center/cityAjax') }}",
        data:{_token,state_id},
        success:function(response)
        {
            $('#city_id').html(response);
            //alert(response);
        }
    });  
});
</script>

<script>
$(document).on('change','#city_id',function(){
    console.log($(this).val());
    var _token = $('meta[name="csrf-token"]').attr('content');
    var city_id = $(this).val();
    $.ajax({
        type:"POST",
        url:"{{ url('admin/collection-center/blockAjax') }}",
        data:{_token,city_id},
        success:function(response)
        {
            $('#block_id').html(response);
            //alert(response);
        }
    });  
});
</script>

@endsection
