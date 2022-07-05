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
            <h3 class="card-title">Edit Category</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/editCategory') }}/{{ $id }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Name English : </label>
                        <input type="text" class="form-control" name="name_en" id="" value="{{$categoryDetail->name_en}}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Name Hindi : </label>
                        <input type="text" class="form-control" name="name_kn" id="" value="{{$categoryDetail->name_kn}}">
                    </div>

                </div>

                <div class="row">
                        @if($categoryDetail->parent_id != 0)

                        <div class="col-sm-6 form-group">
                            <label for="">Parent Category:  </label>
                            
                            <select class="form-control" name="parent_id" id="">
                                <option value="">--Select Parent Category--</option>
                                @foreach ($categoryData as $item)
                                    <option @if( $categoryDetail->parent_id == $item->id ) selected  @endif value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-sm-6 form-group">
                            <label for="">Select New Image :  </label>
                            <input type="file" class="form-control" name="image" id="">
                        </div>
                </div>

                <div class="row">

                     <div class="col-sm-6 form-group">
                        <label for="">Category Image: </label>
                        <br>
                        <img src="{{asset($categoryDetail->image)}}" height="200" >
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