@extends('layouts.app')
@section('title', 'Individual Category | UNDP')
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
                <h3 class="card-title">Add Category <Center></Center></h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 form-group">

                    </div>
                </div>

                <form enctype="multipart/form-data" action="{{ url('admin/addsadhancat') }}" method="post">
                    @csrf
                    <div class="row">
                  
                        <div class="col-sm-6 form-group">
                            <label for="">Name English * : </label>
                            <input type="text" class="form-control" name="name_en" id="">
                        </div>
                       
                        <div class="col-sm-6 form-group">
                            <label for="">Name Hindi * : </label>
                            <input type="text" class="form-control" name="name_hi" id="">
                        </div>
                    </div>

                               


                    <div class="row">
                  
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add </button>
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

@endsection
