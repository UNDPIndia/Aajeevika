@extends('layouts.app')
@section('title', 'sadhan Management | UNDP')

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
            <form enctype="multipart/form-data" action="{{ url('admin/editsadhan') }}/{{ $id }}" method="post">
                @csrf
             <div class="row">
             <div class="col-sm-6 form-group">
                    <label for="">Category * : </label>
                            <select class="form-control" name="category_id">
                            @foreach($sadhanCat as $cat)
                               
                                <option value="{{$cat->id}}" <?php echo $cat->id == $sadhan->category_id ?'selected':'' ?> >{{$cat->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="col-sm-6 form-group">
                    <label for="">Title English * : </label>
                    <input type="text" value="{{ $sadhan->title_en }}" class="form-control" name="title_en" id="">
                </div>

                </div>

                <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="">Title Hindi * : </label>
                    <input type="text" value="{{ $sadhan->title_hi }}" class="form-control" name="title_hi" id="">
                </div>
               
                    <div class="col-sm-6 form-group">
                        <label for="">Youtube Code * : </label>
                        <input type="text" value="{{ $sadhan->youtube_url }}" class="form-control" name="youtube_url" id="">
                        
                    </div>

                 </div>                
                            
                 <div class="row">

                 <div class="col-sm-6 form-group">
                            <label for="">Desc En * : </label>
                            <textarea type="text" class="form-control" name="desc_en" id="">{{ $sadhan->desc_en }}</textarea>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Desc Hi * : </label>
                            <textarea type="text" class="form-control" name="desc_hi" id="">{{ $sadhan->desc_hi }}</textarea>
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