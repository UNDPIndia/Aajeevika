@extends('layouts.app')
@section('title', 'Collection Center Management | UNDP')

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
            <h3 class="card-title">Edit Collection Center</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/collection-center/editcollection') }}/{{ $id }}" method="post">
                @csrf
             <div class="row">

                <div class="col-sm-6 form-group">
                    <label for="">Name English * : </label>
                    <input type="text" value="{{ $collectionDetail->name_en }}" class="form-control" name="name_en" id="">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="">Name Hindi * : </label>
                    <input type="text" value="{{ $collectionDetail->name_hi }}" class="form-control" name="name_hi" id="">
                </div>

                </div>


                <div class="row">
                <div class="col-sm-6 form-group">
                <label for="">State * : </label>
                <select class="form-control" name="state_id" id="state_id" required>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}"
                        @if($state->id==$collectionDetail->state_id)
                        selected
                        @endif >{{ $state->name }}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-sm-6 form-group">
                <label for="">District * : </label>
                <select class="form-control" name="city_id" id="city_id" required>
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}"
                        @if($city->id==$collectionDetail->city_id)
                        selected
                        @endif 
                        >{{ $city->name }}</option>
                    @endforeach
                </select>
                </div>
                </div>

                <div class="row">
                <div class="col-sm-6 form-group">
                <label for="">Block * : </label>
                <select class="form-control" name="block_id" id="block_id">
                    <option value="">Select Block </option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}"
                        @if($block->id==$collectionDetail->block_id)
                        selected
                        @endif 
                        >{{ $block->name }}</option>
                    @endforeach
                </select>
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
$(document).on('change','#state_id',function(){
    console.log($(this).val());
    var _token = $('meta[name="csrf-token"]').attr('content');
    var state_id = $(this).val();
    $.ajax({
        type:"POST",
        url:"{{ url('admin/collection-center/cityAjax') }}",
        data:{_token,state_id},
        success:function(response)
        {
            $('#city_id').html(response);
            //alert(response);
        }
    });  
});
</script>

<script>
$(document).on('change','#city_id',function(){
    console.log($(this).val());
    var _token = $('meta[name="csrf-token"]').attr('content');
    var city_id = $(this).val();
    $.ajax({
        type:"POST",
        url:"{{ url('admin/collection-center/blockAjax') }}",
        data:{_token,city_id},
        success:function(response)
        {
            $('#block_id').html(response);
            //alert(response);
        }
    });  
});
</script>
@endsection