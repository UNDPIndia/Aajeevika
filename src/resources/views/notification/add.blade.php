@extends('layouts.app')
@section('title', 'Promo & Marketing Management | UNDP')
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
            <h3 class="card-title">Add Notification</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form id="notify_form" enctype="multipart/form-data" action="{{ url('admin/addnotification') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-3 form-group">
                        <label for="">Title *</label>
                        <input type="text" class="form-control" name="title" id="">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label for="">Body *</label>
                        <input type="text" class="form-control" name="body" id="">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label for="">Language *</label>
                        <select class="form-control" name="language" id="">
                            <option value="">--Select Language--</option>
                            <option value="en">English</option>
                            <option value="hi">Hindi</option>
                        </select>
                    </div>

                </div>

                <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">User Role *</label>

                        <select class="form-control" name="role_id" id="">
                            <option value="">--Select User Role--</option>
                            @foreach ($roleList as $item)
                                <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                            @endforeach
                        </select>



                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="">Notification Image : </label>
                        <input type="file" class="form-control" name="image" id="">
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-primary">Add Notification</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
</section>

@endsection

@section('script')
<script>
    // $(document).ready(function(){
    //     $("#notify_form").submit(function(e){
    //         e.preventDefault();
    //         alert('sending notification');


    //     });
    // });


</script>
@endsection
