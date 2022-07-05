@extends('layouts.app')
@section('title', 'Popup Management | UNDP')
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
                <h3 class="card-title">Add Popup </h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ url('admin/addpopup') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label for="">Title *:</label>
                            <input type="text" class="form-control" name="title" id="">
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="">Language *: </label>

                            <select class="form-control" name="language" id="">
                                <option value="">--Select Language --</option>
                                <option value="en">English</option>
                                <option value="hin">Hindi</option>
                            </select>


                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="">Role *: </label>
                            <select class="form-control role" name="role_id[]" id="" multiple="multiple">
                                <option value="">--Select Role --</option>
                                @foreach ($roleList as $item)
                                    <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Background Image *: </label>
                            <input type="file" class="form-control" name="background_image" id="">
                        </div>

                        {{-- <div class="col-sm-6 form-group">
                            <label for="">Action </label>
                            <input type="text" class="form-control" name="action" id="">
                        </div> --}}
                    </div>



                    {{-- <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Description : </label>
                            <textarea class="form-control" name="description" id="" rows="3"></textarea>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Add Popup</button>
                        </div>
                    </div>





                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.role').select2();
        });

    </script>
@endsection
