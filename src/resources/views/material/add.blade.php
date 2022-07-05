@extends('layouts.app')
@section('title', 'Material Management | UNDP')

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
            <h3 class="card-title">Add Product Type</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/addmaterial') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Name English *: </label>
                        <input type="text" class="form-control" name="name_en" id="">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Name Hindi *: </label>
                        <input type="text" class="form-control" name="name_kn" id="">
                    </div>

                </div>

                <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Category *:   </label>
                            <select class="form-control getsubcats" name="category_id" id="">
                                <option value="">--Select Category--</option>
                                 @foreach ($categoryData as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach  
                            </select>
                        </div>


                        <div class="col-sm-6 form-group">
                            <label for="">Sub Category *:  </label>
                            <select class="form-control" name="subcategory_id" id="subcats">
                                <option value="">--Select Subcategory--</option>
                            
                            </select>
                        </div>

                   
                </div>

                {{-- <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="">Material Image: </label>
                        <input type="file" class="form-control" name="image" id="">
                    </div>
                
                </div> --}}
                
                
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-primary">Add Product Type</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
</section>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      
<script>
$(".getsubcats").change(function(){
var id = $(this).val();

$('#subcats').empty();
$('#subcats').append(' <option value="">--Select Subcategory--</option>'); 

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        type:'POST',
        url:"{{ url('/get_subcats') }}",
        data:{ parent_id: id },
        dataType: "json",
        
        success:function(data) {
            $.each(data.data,function(i,obj)
            {
                console.log(obj.name_en);
                var div_data="<option value="+obj.id+">"+obj.name_en+"</option>";
                $(div_data).appendTo('#subcats'); 


            }); 
            
            
        }
    });
});

</script>

@endsection