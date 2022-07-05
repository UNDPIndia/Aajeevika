@extends('layouts.app')
@section('title', 'Individual Product Management | UNDP')

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
            <h3 class="card-title">Edit Individual Product</h3>
            <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" action="{{ url('admin/individual/editproduct') }}/{{ $id }}" method="post">
                @csrf
                <div class="row">
                         <div class="col-sm-6 form-group">
                            <label for=""> Individual Category * : </label>
                            <select name="cat_id" required class="form-control">
                                <option value=""> Select Category</option>
                                @foreach($ind_category as $cat)
                                <option value="{{ $cat->id }}"
                                    @if($productDetail->cat_id==$cat->id)    
                                    selected
                                    @endif >{{ $cat->name_en }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Name English * : </label>
                            <input type="text" value="{{$productDetail->name_en }}" class="form-control" name="name_en" id="">
                        </div>
                        

                    </div>

                    <div class="row">

                    <div class="col-sm-6 form-group">
                            <label for="">Name Hindi * : </label>
                            <input type="text" value="{{ $productDetail->name_hi }}" class="form-control" name="name_hi" id="">
                        </div>


                        <div class="col-sm-6 form-group">
                        <label for="" style="visibility:hidden;">No measurement* : </label>
                            <br> <b>No Measurement:</b> &nbsp;&nbsp;
                            <input type="radio" class="no_measure" onclick="mesurementFun(this);" value="0" name="no_measurement" 
                            @if($productDetail->no_measurement=='0')
                                       checked
                            @endif
                            >
                            &nbsp;&nbsp;
                            <b>Measurement:</b> &nbsp;&nbsp;
                            <input type="radio" class="no_measure" onclick="mesurementFun(this);" value="1" name="no_measurement" 
                            @if($productDetail->no_measurement=='1')
                                       checked
                            @endif  
                            >
                        </div>
                    </div>


                        
                        <div class="showhide"
                        @if($productDetail->no_measurement=='0')
                        style="display:none;"
                        @endif
                        >
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Length : </label>
                            <input type="number" value="{{$productDetail->length }}" class="form-control" name="length" id="">
                        </div>

                    <div class="col-sm-6 form-group">
                            <label for="">Length Unit : </label>
                            <select name="length_unit"  class="form-control">
                                <option value="">Length Unit</option>
                                <option value="Inch"
                                @if($productDetail->length_unit=='Inch')
                                selected
                                @endif   
                                >Inch</option>
                                <option value="Feet"
                                @if($productDetail->length_unit=='Feet')
                                selected
                                @endif   
                                >Feet</option>

                                <option value="Meter"
                                @if($productDetail->length_unit=='Meter')
                                selected
                                @endif   
                                >Meter</option>

                                <option value="CM"
                                @if($productDetail->length_unit=='CM')
                                selected
                                @endif   
                                >CM</option>

                                <option value="MM"
                                @if($productDetail->length_unit=='MM')
                                selected
                                @endif   
                                >MM</option>                                

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Width : </label>
                            <input type="number" value="{{$productDetail->width }}" class="form-control" name="width" id="">
                        </div>

                    <div class="col-sm-6 form-group">
                            <label for="">Width Unit : </label>
                            <select name="width_unit"  class="form-control">
                                <option value="">Width Unit</option>
                                <option value="Inch"
                                @if($productDetail->width_unit=='Inch')
                                selected
                                @endif   
                                >Inch</option>
                                <option value="Feet"
                                @if($productDetail->width_unit=='Feet')
                                selected
                                @endif   
                                >Feet</option>

                                <option value="Meter"
                                @if($productDetail->width_unit=='Meter')
                                selected
                                @endif   
                                >Meter</option>

                                <option value="CM"
                                @if($productDetail->width_unit=='CM')
                                selected
                                @endif   
                                >CM</option>

                                <option value="MM"
                                @if($productDetail->width_unit=='MM')
                                selected
                                @endif   
                                >MM</option> 
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Height : </label>
                            <input type="number" value="{{ $productDetail->height }}" class="form-control" name="height" id="">
                        </div>

                    <div class="col-sm-6 form-group">
                            <label for="">Height Unit : </label>
                            <select name="height_unit"  class="form-control">
                                <option value="">Height Unit</option>
                                <option value="Inch"
                                @if($productDetail->height_unit=='Inch')
                                selected
                                @endif   
                                >Inch</option>
                                <option value="Feet"
                                @if($productDetail->height_unit=='Feet')
                                selected
                                @endif   
                                >Feet</option>

                                <option value="Meter"
                                @if($productDetail->height_unit=='Meter')
                                selected
                                @endif   
                                >Meter</option>

                                <option value="CM"
                                @if($productDetail->height_unit=='CM')
                                selected
                                @endif   
                                >CM</option>

                                <option value="MM"
                                @if($productDetail->height_unit=='MM')
                                selected
                                @endif   
                                >MM</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Weight : </label>
                            <input type="number" value="{{ $productDetail->weight }}" class="form-control" name="weight" id="">
                        </div>

                    <div class="col-sm-6 form-group">
                            <label for="">Weight Unit : </label>
                            <select name="weight_unit"  class="form-control">
                                <option value="">Weight Unit</option>
                                <option value="KG"
                                @if($productDetail->weight_unit=='KG')
                                selected
                                @endif   
                                >KG</option>
                                <option value="GM"
                                @if($productDetail->weight_unit=='GM')
                                selected
                                @endif   
                                >GM</option>

                                <option value="MG"
                                @if($productDetail->weight_unit=='MG')
                                selected
                                @endif   
                                >MG</option>
                            </select>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Vol : </label>
                            <input type="number" value="{{ $productDetail->vol }}" class="form-control" name="vol" id="" >
                        </div>

                    <div class="col-sm-6 form-group">
                            <label for="">Vol Unit : </label>
                            <select name="vol_unit"  class="form-control">
                                <option value="">Select Vol Unit</option>
                                <option value="Litre"
                                  @if($productDetail->vol_unit=='Litre')
                                  selected
                                  @endif
                                >Litre</option>
                                <option value="ML"
                                @if($productDetail->vol_unit=='ML')
                                  selected
                                  @endif
                                >ML</option>
                            </select>
                        </div>
                    </div>



                </div>

                   
                    

                    <div class="row">

                    <div class="col-sm-6 form-group">
                            <label for="">Image* : </label>
                            <input type="file" class="form-control" name="image" id="">
                            
                        </div>

                        <div class="col-sm-6 form-group">
                                <label for="">Price Unit * : </label>
                                <select name="price_unit" required class="form-control">
                                    <option value="">Price Unit</option>
                                    <option value="KG" 
                                    @if($productDetail->price_unit=='KG')
                                    selected
                                    @endif
                                    >KG</option>
                                    <option value="Piece"
                                    @if($productDetail->price_unit=='Piece')
                                    selected
                                    @endif
                                    >Piece</option>
                                </select>
                            </div> 
                </div>
                  
                <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="">Product Image: </label>
                    <br>
                    <img src="{{ asset($productDetail->image) }}" height="200" >
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

    <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script>
        function mesurementFun(element)
        {
            let vall = element.value;
            let _token = $('meta[name="csrf-token"]').attr('content');

            if(vall=='1')
            {
                $('.showhide').css({'display':'block'});
            }else{
                $('.showhide').css({'display':'none'});
            }

            /*
            if(vall=='1')
            {
                $.ajax({
                type:"POST",
                url:"{{ url('admin/individual/ajaxshow') }}",
                data:{_token,vall},
                success:function(response)
                {
                    $('.showhide').html(response);
                }

            });

          }else{
            $('.showhide').html('');
            }
            */
            
    }
    </script>

@endsection