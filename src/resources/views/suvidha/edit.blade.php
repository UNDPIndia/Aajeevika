@extends('layouts.app')
@section('title', 'Suvidha | UNDP')

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
            <h3 class="card-title">Edit Suvidha</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/editsuvidha') }}/{{ $id }}" method="post">
                @csrf
             <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="">Title English * : </label>
                    <input type="text" value="{{ $suvidha->title_en }}" class="form-control" name="title_en" id="">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="">Title Hindi * : </label>
                    <input type="text" value="{{ $suvidha->title_hi }}" class="form-control" name="title_hi" id="">
                </div>

                </div>

                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Image1 * : </label>
                        <input type="file"  class="form-control" name="image1" id="">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Image2 * : </label>
                        <input type="file"  class="form-control" name="image2" id="">
                    </div>

                 </div>                
                            
                 <div class="row">

                    <div class="col-sm-6 form-group">
                       <img src="{{ url($suvidha->image1) }}" style="height:200px;width:200px;">  
                    </div>
                    <div class="col-sm-6 form-group">
                       <img src="{{ url($suvidha->image2) }}" style="height:200px;width:200px;">  
                    </div>
                </div>                  
                <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="">Image3 * : </label>
                    <input type="file"  class="form-control" name="image3" id="">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="">Image4 * : </label>
                    <input type="file"  class="form-control" name="image4" id="">
                </div>

                </div>                
                        
                <div class="row">

                <div class="col-sm-6 form-group">
                <img src="{{ url($suvidha->image3) }}" style="height:200px;width:200px;">  
                </div>
                <div class="col-sm-6 form-group">
                <img src="{{ url($suvidha->image4) }}" style="height:200px;width:200px;">  
                </div>
                </div>  
                <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="">Desc En * : </label>
                    <textarea  class="form-control" name="desc_en" id="">{{ $suvidha->desc_en }}</textarea>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="">Desc Hi * : </label>
                    <textarea  class="form-control" name="desc_hi" id="">{{ $suvidha->desc_hi }}</textarea>
                </div>

                </div>   
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
</section>

@endsection