@extends('layouts.app')
@section('title', 'Survey Management | UNDP')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
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
                <h3 class="card-title">Add Survey</h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>


            <div class="card-body">
                {{-- <div class="row">
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
                </div> --}}

                <form action="{{ url('admin/addsurvey') }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Message * : </label>
                            <input type="text" class="form-control" name="message" id="message">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Url * : </label>
                            <input type="text" class="form-control" name="google_url" id="google_url">
                        </div>

                    </div>
                    <div class="row">

                        {{-- <div class="col-sm-6 form-group">
                            <label for="">Start Date : </label>
                            <input type="text" class="form-control" name="start_date" id="start_date">
                        </div> --}}

                        <div class="col-sm-6 form-group">
                            <label for="">Start Date : </label>
                            <input data-date-format="yyyy-mm-dd" class="form-control" name="start_date" id="start_date">
                        </div>


                        <div class="col-sm-6 form-group">
                            <label for="">End Date : </label>
                            <input data-date-format="yyyy-mm-dd"  class="form-control" name="end_date" id="end_date">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add Survey</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
    $('#start_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#start_date').datepicker("setDate", new Date());

    $('#end_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#end_date').datepicker("setDate", new Date());

    </script>
@endsection
