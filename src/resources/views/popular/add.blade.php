@extends('layouts.app')
@section('title', 'Popular Product Management | UNDP')
@section('content')
<style>
.select2-container--default .select2-selection--single {
  outline: none;
}

 

.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 36px;
}

 

.select2-container .select2-selection--single {
     height: 38px;
}

</style>
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
            <h3 class="card-title">Add To Popular</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/addpopular') }}" method="post">
                @csrf


                <div class="row">

                        <div class="col-sm-4 form-group">
                            <label for="">Category *:  </label>
                            <select required class="form-control getsubcats" id="">
                                <option value="">--Select Category--</option>
                                 @foreach ($categoryData as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-sm-4 form-group">
                            <label for="">Sub Category *:  </label>
                            <select required class="form-control get_products"  id="subcats">
                                <option value="">--Select Subcategory--</option>

                            </select>
                        </div>


                        <div class="col-sm-4 form-group">
                            <label for="">Products *:  </label>

                            <select  required class="form-control" name="product_id" id="products">
                                <option value="">--Select Products--</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="selected_category" value="" />



                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-primary">Add Popular</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
</section>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    var cat_id = "";
$(".getsubcats").change(function(){
    var id = $(this).val();
    cat_id = $(this).val();



    $(".selected_category").val(id);

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


$(".get_products").change(function(){
    var categoryId = cat_id;
    var subcategoryId = $(this).val();
   

    
        $('#products').empty();
        $('#products').append(' <option value="">--Select Products--</option>');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type:'POST',
            url:"{{ url('/get_products') }}",
            data:{ categoryId: categoryId, subcategoryId : subcategoryId  },
            dataType: "json",

            success:function(data) {
                $.each(data.data,function(i,obj)
                {
                    console.log(obj.name_en);
                    var div_data="<option value="+obj.id+">"+obj.localname_en+"</option>";
                    $(div_data).appendTo('#products');


                });


            }
        });
    

});
</script>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#products').select2();
        });

    </script>
@endsection
