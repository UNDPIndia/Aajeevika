@extends('layouts.app')
@section('title', 'Category Management | UNDP')
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
                <h3 class="card-title">Add Category</h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 form-group">


                        <div class="form-check">
                            <input class="form-check-input check" type="radio" name="category_type" value="category"
                                @if (!isset($_REQUEST['category_id']))
                            checked
                            @endif >

                            <label class="form-check-label" for="exampleRadios1">
                                Add Category
                            </label>
                        </div>



                        <div class="form-check">
                            <input class="form-check-input check" type="radio" name="category_type" value="subcategory"
                                @if (isset($_REQUEST['category_id']))
                            checked
                            @endif>
                            <label class="form-check-label" for="exampleRadios2">
                                Add Subcategory
                            </label>
                        </div>



                    </div>
                </div>

                <form enctype="multipart/form-data" action="{{ url('admin/addcategory') }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Name English * : </label>
                            <input type="text" class="form-control" name="name_en" id="">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Name Hindi * : </label>
                            <input type="text" class="form-control" name="name_kn" id="">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6 form-group subcat hideme " >
                            <label for="">Parent Category *: </label>
                            <select class="form-control" name="parent_id">

                                <option value="0"> -Select Parent Category- </option>
                                    @foreach ($categoryData as $item)
                                    <option @if (isset($_REQUEST['category_id']) && $_REQUEST['category_id'] == $item->id)
                                        selected
                                @endif value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Category Image *: </label>
                            <input type="file" class="form-control" name="image" id="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add Category</button>
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
@endsection
