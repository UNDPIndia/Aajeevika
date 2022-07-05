@php
    //dd($shgartisanDetail)
@endphp
@extends('layouts.app')
@section('title', 'SHG/Atrisan Listing | UNDP')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UNDP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/shgartisans') }}">shgartisans</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ url('admin/addcategory') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label for="">Profile Image </label>
                            @if ($shgartisanDetail->profileImage != null)
                                <img class="img-thumbnail" height="50px" width="50px"
                                    src="{{ asset($shgartisanDetail->profileImage) }}">
                                    @else
                                    <img class="img-thumbnail" height="50px" width="50px"
                                    src="{{ asset('public/assets/images/user.jfif') }}">
                            @endif

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-4 form-group">
                            <label for="">Name </label>
                            <input type="text" class="form-control" name="{{ $shgartisanDetail->name }}" disabled
                                value="{{ $shgartisanDetail->name }}" id="">
                        </div>


                        <div class="col-sm-4 form-group">
                            <label for="">Email </label>
                            <input type="text" class="form-control" name="{{ $shgartisanDetail->email }}" disabled
                                value="{{ $shgartisanDetail->email }}" id="">
                        </div>


                        <div class="col-sm-4 form-group">
                            <label for="">Type </label>
                            <input type="text" class="form-control" name="{{ $shgartisanDetail->role_id }}" disabled
                                value="{{ $shgartisanDetail->userRole->role_name }}" id="">
                        </div>

                    </div>

                    <div class="row">

                        <!-- <div class="col-sm-3 form-group">
                            <label for="">Title </label>
                            <input type="text" class="form-control" name="{{ $shgartisanDetail->Title }}" disabled
                                value="{{ $shgartisanDetail->title }}" id="">
                        </div> -->
                        <div class="col-sm-3 form-group">
                            <label for="">Organization Name </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $shgartisanDetail->organization_name }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Member Id </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $shgartisanDetail->member_id }}" id="">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="">Member Designaion </label>
                            <input type="text" class="form-control" name="" disabled
                                value="{{ $shgartisanDetail->member_designation }}" id="">
                        </div>

                    </div>


                </form>
            </div>
        </div>
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="" disabled value="{{ $shgartisanDetail->address_registerd->address_line_one ?? "Address Line 1" }}" id="">
                </div>
             <?php //echo "<pre>"; print_r($shgartisanDetail->address_registerd); die; ?>
                 <div class="col-sm-4 form-group">
                    <label for="">Address Line 2 </label>
                     {{-- <input type="text" class="form-control" name="{{ $shgartisanDetail->address_registerd->address_line_two  }}" disabled value="{{ $shgartisanDetail->address_registerd->address_line_two ?? "Address Line 2" }}" id=""> --}}
                     <input type="text" class="form-control" name="" disabled value="{{ $shgartisanDetail->address_registerd ? $shgartisanDetail->address_registerd->address_line_two : "Address Line 2" }}" id=""> 
                </div> 

                <div class="col-sm-4 form-group">
                    <label for="">District </label>
                    <input type="text" class="form-control" name="" disabled value=" @if($shgartisanDetail->city != null)
                    {{ $shgartisanDetail->city->name }}
                    @endif" id="">
                </div>
                <!-- <div class="col-sm-4 form-group">
                    <label for="">Village </label>
                    <input type="text" class="form-control" name="" disabled value="NA" id="">
                </div> -->
                <div class="col-sm-4 form-group">
                    <label for="">Block </label>
                    <input type="text" class="form-control" name="" disabled value="@if($shgartisanDetail->userBlock != null)
                    {{ $shgartisanDetail->userBlock->name }}
                    @endif" id="">
                </div>
                <div class="col-sm-4 form-group">
                    <label for="">State </label>
                    <input type="text" class="form-control" name="" disabled value="@if($shgartisanDetail->state != null)
                    {{ $shgartisanDetail->state->name }}
                    @endif" id="">
                </div>


                <div class="col-sm-4 form-group">
                    <label for="">Country </label>
                    <input type="text" class="form-control" name="" disabled value="@if($shgartisanDetail->country != null)
                    {{ $shgartisanDetail->country->name }}
                    @endif" id="">
                </div>

                <div class="col-sm-4 form-group">
                    <label for="">Pincode </label>
                    <input type="text" class="form-control" name="" disabled value="{{ $shgartisanDetail->address_registerd->pincode ?? "Pincode" }}" id="">
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Product Name</th>
                            <th> Local Name English</th>
                            <th> Local Name Hindi</th>
                            <th> Measurements</th>
                            <th> Category</th>
                            <th> Sub category</th>
                            <th> Material</th>
                            <th> Quantity</th>
                            <th> Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($shgartisanDetail->products as $key => $item)

                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->template->name_en }}</td>
                                <td>{{ $item->localname_en }}</td>
                                <td>{{ $item->localname_kn }}</td>

                                @if ($item->length != null || $item->height != null || $item->width != null || $item->weight != null || $item->vol != null)
                                    <td>

                                        {{ $item->length }} {{ $item->length_unit }} x
                                        {{ $item->height }} {{ $item->height_unit }} x
                                        {{ $item->width }} {{ $item->width_unit }} x
                                        {{ $item->weight }} {{ $item->weight_unit }} x
                                        {{ $item->vol }} {{ $item->vol_unit }}

                                    </td>
                                @endif


                                <td>{{ $item->category->name_en }}</td>
                                <td>{{ $item->subcategory->name_en }}</td>
                                <td>{{ $item->material->name_en }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }} Rs.</td>

                            </tr>

                            @php
                            $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </div>


    </section>

@endsection
