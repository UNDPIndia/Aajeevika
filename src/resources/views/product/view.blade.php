@extends('layouts.app')
@section('title', 'Product Management | UNDP')
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
            <div class="card-header">
                <h3 class="card-title">View Product</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="">Local Name English</label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->localname_en }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Local Name Hindi</label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->localname_kn }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Category </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->category->name_en }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Sub Category </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->subcategory->name_en }}" id="">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Product Type </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->material->name_en }}" id="">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Price </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->price }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Price Unit</label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->price_unit }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Quantity </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->qty }}" id="">
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="">Desription English </label>
                            <textarea class="form-control" name="" disabled
                                 id="">{{ $productDetail->des_en }}</textarea>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="">Desription Hindi </label>
                            <textarea class="form-control" name="" disabled
                                 id="">{{ $productDetail->des_kn }}</textarea>
                        </div>


                    </div>
                </form>
            </div>
            <div class="card-header">
                <h3 class="card-title">Product Measurements</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    @if ($productDetail->length != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Length</label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->length }} {{ $productDetail->length_unit }}" id="">
                        </div>
                    @endif

                    @if ($productDetail->height != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Height</label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->height }} {{ $productDetail->height_unit }}" id="">
                        </div>
                    @endif

                    @if ($productDetail->width != null)

                        <div class="col-sm-3 form-group">
                            <label for="">Width </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->width }} {{ $productDetail->width_unit }}" id="">
                        </div>

                    @endif

                    @if ($productDetail->weight != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Weight </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->weight }} {{ $productDetail->weight_unit }}" id="">
                        </div>
                    @endif



                    @if ($productDetail->vol != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Vol </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $productDetail->vol }} {{ $productDetail->vol_unit }}" id="">
                        </div>
                    @endif

                </div>
            </div>



            <div class="card-header">
                <h3 class="card-title">Product Images</h3>

            </div>
            <div class="card-body">
                @php
                //dd($productDetail->image_1);
                @endphp
                <div class="row">

                    @if ($productDetail->image_1 != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Image 1 </label>
                            <img class="img-thumbnail" src="{{ asset($productDetail->image_1) }}">
                        </div>
                    @endif


                    @if ($productDetail->image_2 != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Image 2 </label>
                            <img class="img-thumbnail" src="{{ asset($productDetail->image_2) }}">
                        </div>
                    @endif

                    @if ($productDetail->image_3 != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Image 3 </label>
                            <img class="img-thumbnail" src="{{ asset($productDetail->image_3) }}">
                        </div>
                    @endif


                    @if ($productDetail->image_4 != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Image 4 </label>
                            <img class="img-thumbnail" src="{{ asset($productDetail->image_4) }}">
                        </div>
                    @endif

                    @if ($productDetail->image_5 != null)
                        <div class="col-sm-3 form-group">
                            <label for="">Image 5 </label>
                            <img class="img-thumbnail" src="{{ asset($productDetail->image_5) }}">
                        </div>
                    @endif

                </div>
            </div>



        </div>


        </div>




    </section>

@endsection
