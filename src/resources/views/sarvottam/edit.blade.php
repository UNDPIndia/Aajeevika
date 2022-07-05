@extends('layouts.app')
@section('title', 'Sarvottam Management | UNDP')

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
            <h3 class="card-title">Edit </h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/editsarvottam') }}/{{ $id }}" method="post">
                @csrf
             <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="">Title English * : </label>
                    <input type="text" value="{{ $sarvottam->title_en }}" class="form-control" name="title_en" id="">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="">Title Hindi * : </label>
                    <input type="text" value="{{ $sarvottam->title_hi }}" class="form-control" name="title_hi" id="">
                </div>

                </div>

                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">PDF * : </label>
                        <input type="file"  class="form-control" name="download_link" id="">
                    </div>

                 </div>                
                            
                 <div class="row">

                    <div class="col-sm-6 form-group">
                       <iframe src="{{ url($sarvottam->download_link) }}" style="height:200px;width:200px;">  </iframe>
                    </div>

                </div>                  
                
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-primary" allowfullscreen>Save Changes</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
</section>

@endsection