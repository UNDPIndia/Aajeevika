@extends('layouts.app')
@section('title', 'Individual Product Management | UNDP')
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
                <h3 class="card-title">Add individual Product</h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 form-group">

                    </div>
                </div>

                <form enctype="multipart/form-data" action="{{ url('admin/individual/addproduct') }}" method="post">
                    @csrf
                    <div class="row">
                         <div class="col-sm-6 form-group">
                            <label for=""> Ind Category * : </label>
                            <select name="cat_id" required class="form-control">
                                <option value=""> Select Category</option>
                                @foreach($ind_category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name_en }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Name English * : </label>
                            <input type="text" class="form-control" name="name_en" id="" >
                        </div>
                        

                    </div>

                    <div class="row">
                    <div class="col-sm-6 form-group">
                            <label for="">Name Hindi * : </label>
                            <input type="text" class="form-control" name="name_hi" id="">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Image *: </label>
                            <input type="file" class="form-control" name="image" id="">
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-6 form-group">
                            <label for="" style="visibility:hidden;">No measurement* : </label>
                            <br> <b>No Measurement:</b> &nbsp;&nbsp;
                            <input type="radio" class="no_measure" onclick="mesurementFun(this);" value="0" name="no_measurement" checked>
                            &nbsp;&nbsp;
                            <b>Measurement:</b> &nbsp;&nbsp;
                            <input type="radio" class="no_measure" onclick="mesurementFun(this);" value="1" name="no_measurement" >
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Price Unit * : </label>
                            <select name="price_unit" required class="form-control">
                                <option value="">Price Unit</option>
                                <option value="KG">KG</option>
                                <option value="Piece">Piece</option>
                                <option value="Litre">Litre</option>
                                <option value="Units">Units</option>
                                <option value="Crates">Crates</option>
                                <option value="Packages">Packages</option>
                            </select>
                        </div>



                    </div>

                    <div class="showhide">
                      

                      </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add Individual Product</button>
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
        function mesurementFun(element)
        {
            let vall = element.value;
            let _token = $('meta[name="csrf-token"]').attr('content');

            if(vall=='1')
            {
                $.ajax({
                type:"POST",
                url:"{{ url('admin/individual/ajaxshow') }}",
                data:{_token,vall},
                success:function(response)
                {
                    $('.showhide').html(response);
                }

            });

          }else{
            $('.showhide').html('');
            }
            
    }
    </script>

@endsection
