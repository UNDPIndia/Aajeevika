@extends('layouts.app')

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
                <h3 class="card-title">Add Message</h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>
            <div class="card-body">
                <form id="notify_form" enctype="multipart/form-data" action="{{ url('admin/addEmailbulk') }}" method="post">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">User Role </label>

                            <select class="form-control role" name="role_id[]" id="" multiple="multiple">
                                <option value="">--Select Role --</option>
                                @foreach ($roleList as $item)
                                    <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                                @endforeach
                            </select>



                        </div>


                    </div>
                    <div class="row">



                        <div class="col-sm-12 form-group">
                            <label for="">Message Body (60 chars only)</label>
                            <textarea maxlength="60" class="form-control" name="message" id=""
                                placeholder="Please Write your message here.."></textarea>
                        </div>



                    </div>




                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
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
