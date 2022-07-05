@extends('layouts.app')
@section('title', 'Template Management | UNDP')
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
            <h3 class="card-title">Edit Template</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/editTemplate') }}/{{encrypt($id)}}" method="post">
                @csrf

                <div class="row">

                        <div class="col-sm-4 form-group">
                            <label for="">Category *:  </label>
                            <select class="form-control getsubcats" name="category_id" id="" disabled="true">
                                <option value="">--Select Category--</option>
                                 @foreach ($categoryData as $item)
                                    <option @if( $templateData->category_id == $item->id ) selected  @endif value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach  
                            </select>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="">Sub Category *:  </label>
                            <select class="form-control" name="subcategory_id" id="subcats" disabled="true">
                                <option value="">--Select Subcategory--</option>
                                @foreach ($subcategoryData as $item)
                                <option @if( $templateData->subcategory_id == $item->id ) selected  @endif value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach  
                            </select>
                        </div>


                        <!-- <div class="col-sm-4 form-group">
                            <label for="">Material *:  </label>
                            <select class="form-control" name="material_id" id="materials" class="">
                                <option value="">--Select Material--</option>
                                @foreach ($materialData as $item)
                                <option @if( $templateData->material_id == $item->id ) selected  @endif value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach 
                            
                            </select>
                        </div> -->

                   
                </div>


                <div class="row">

                    <div class="col-sm-6 form-group">
                        <label for="">Name English *: </label>
                        <input type="text" class="form-control" value="{{ $templateData->name_en }}" name="name_en" id="">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Name Hindi *: </label>
                        <input type="text" class="form-control" name="name_kn" value="{{ $templateData->name_kn }}" id="">
                    </div>

                </div>
                
                <div class="form-check row form-group">
                    <div class="">
                        <label for="">Select Measurement : (Check atleast one Measurement)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="height" type="checkbox" @if( $templateData->height == 'on' ) checked  @endif id="inlineCheckbox1" >
                        
                        <label class="form-check-label" for="inlineCheckbox1">Height</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if( $templateData->width == 'on' ) checked  @endif name="width" type="checkbox" id="inlineCheckbox2" >
                        <label class="form-check-label" for="inlineCheckbox2">Width</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  @if( $templateData->length == 'on' ) checked  @endif name="length" type="checkbox" id="inlineCheckbox31" >
                        <label class="form-check-label" for="inlineCheckbox31">Length </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if( $templateData->volume == 'on' ) checked  @endif name="volume" type="checkbox" id="inlineCheckbox30" >
                        <label class="form-check-label" for="inlineCheckbox30">Volume </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if( $templateData->weight == 'on' ) checked  @endif name="weight" type="checkbox" id="inlineCheckbox3" >
                        <label class="form-check-label" for="inlineCheckbox3">Weight </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if( $templateData->no_measurement == 'on' ) checked  @endif name="no_measurement" type="checkbox" id="inlineCheckbox8" >
                        <label class="form-check-label" for="inlineCheckbox8">No Measurement </label>
                    </div>
                </div>
                
               <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="">Description English *:</label>
                        <textarea class="form-control" name="description_en" id="" rows="3">{{$templateData->description_en}}</textarea>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Description Hindi *: </label>
                        <textarea class="form-control" name="description_kn" id="" rows="3">{{$templateData->description_kn}}</textarea>
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


$(document).on('change', '#subcats', function() {
    var id = $(this).val();
    $('#materials').empty();
    $('#materials').append(' <option value="">--Select materials--</option>'); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url:"{{ url('/get_material')}}",
        data:{ id: id },
        dataType: "json",
        
        success:function(data) {
            $.each(data.data,function(i,obj)
            {
                console.log(obj.name_en);
                var div_data="<option value="+obj.id+">"+obj.name_en+"</option>";
                $(div_data).appendTo('#materials'); 


            }); 
            
            
        }
    });
});




</script>

@endsection