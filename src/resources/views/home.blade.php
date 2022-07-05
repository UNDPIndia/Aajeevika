@extends('layouts.app')
@section('title', 'Dashboard | UNDP')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                {{-- <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="#">Home</a></li>
        </ol>
      </div> --}}
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <section class="content">

        @if (Auth::user()->role_id == 5)
            {{-- <div class="row">
    <form action="{{ url('/admin') }}" method="get">
      @csrf
      <div class="row">
        <div class="form-group col-sm-10">
          <select name="district" class="form-control">
            <option value="">--Please Select District--</option>
            @foreach ($dataCount['district'] as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
          
        </div>
        <div class="form-group col-sm-2" >
          <input type="submit" class="btn btn-primary">
        </div>
    </div>
    </form>
  </div> --}}

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>

                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <div class="row">

                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-color1">
                                <div class="inner">
                                <div class="title">Total Sellers</div>
                                    <h3><?php if (isset($dataCount['totalSeller'])) {
                                        echo $dataCount['totalSeller'];
                                    } else {
                                        echo 0;
                                    } ?></h3>
                                <a href="{{ url('/admin/shgartisans') }}" class="small-box-footer">More info 
                                                                 <i class="fas fa-arrow-circle-right"></i> 
                                                            </a>
                                    
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-bag"></i> --}}
                                    <!-- <i class="fa fa-list-alt"></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-color2">
                                <div class="inner">
                                <div class="title">Total SHG Individual </div>
                                    <h3><?php if (isset($dataCount['totalSHGInd'])) {
                                        echo $dataCount['totalSHGInd'];
                                    } else {
                                        echo 0;
                                    } ?></h3>
                                <a href="{{ url('/admin/ind-users') }}" class="small-box-footer">More info 
                                                                 <i class="fas fa-arrow-circle-right"></i> 
                                                            </a>
                                    
                                </div>
                                <div class="icon">
                                    <!-- <i class="fa fa-list-alt"></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-color3">
                                <div class="inner">
                                <div class="title">Total Buyers</div>
                                    <h3><?php if (isset($dataCount['totalUser'])) {
                                        echo $dataCount['totalUser'];
                                    } else {
                                        echo 0;
                                    } ?></h3>

                                <a href="{{ url('/admin/users') }}" class="small-box-footer">More info
                                                                 <i class="fas fa-arrow-circle-right"></i> 
                                                                </a>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-person-add"></i> --}}

                                    <!-- <i class="ion ion-bag"></i> -->

                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-color4">
                                <div class="inner">
                                <div class="title">Total Orders Placed</div>
                                    <h3><?php if (isset($dataCount['totalOrder'])) {
                                        echo $dataCount['totalOrder'];
                                    } else {
                                        echo 0;
                                    } ?></h3>
                                <a href="/admin/orders" class="small-box-footer">More info 
                                                                 <i class="fas fa-arrow-circle-right"></i> 
                                                            </a>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-pie-graph"></i> --}}
                                    <!-- <i class="fa fa-text-width"></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-color2">
                                <div class="inner">
                                <div class="title">Total Interest Raised</div>
                                    <h3><?php if (isset($dataCount['totalInterest'])) {
                                        echo $dataCount['totalInterest'];
                                    } else {
                                        echo 0;
                                    } ?></h3>
                                <a href="/admin/interest" class="small-box-footer">More info 
                                                                 <i class="fas fa-arrow-circle-right"></i> 
                                                            </a>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-pie-graph"></i> --}}
                                    <!-- <i class="fa fa-text-width"></i> -->
                                </div>
                                
                            </div>
                        </div>
                        <!-- ./col -->
                       
                       
                    </div>

                    <div class="row">
                        <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <div class="card-header">
                                    <h5 class="widget-user-desc ml-0">Sales Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start">
                                                <div class="icon purple">
                                                    <img src="assets/images/category.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalCategory'])) {
                                                                                  echo $dataCount['totalCategory'];
                                                                                 } else {
                                                                                               echo 0;
                                                                            } ?>
                                                     </div>
                                                    <div class="name">Total Category</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start">
                                                <div class="icon red">
                                                    <img src="assets/images/sub-category.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['subCategory'])) {
                                        echo $dataCount['subCategory'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">Total Sub Category</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start mb-0">
                                                <div class="icon solid-green">
                                                    <img src="assets/images/Total-product-templates.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['ProductTemplate'])) {
                                        echo $dataCount['ProductTemplate'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">Total Product Templates</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start mb-0">
                                                <div class="icon green">
                                                    <img src="assets/images/total-product.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalProduct'])) {
                                        echo $dataCount['totalProduct'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">Total Product</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <div class="card-header">
                                    <h5 class="widget-user-desc ml-0">Registered Sellers</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start">
                                                <div class="icon purple">
                                                    <img src="assets/images/shg.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalSHGSeller'])) {
                                        echo $dataCount['totalSHGSeller'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">SHG Enterprise</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start">
                                                <div class="icon red">
                                                    <img src="assets/images/clf.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalArtisan'])) {
                                        echo $dataCount['totalArtisan'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">CLF</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start mb-0">
                                                <div class="icon solid-green">
                                                    <img src="assets/images/growth-center.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalGrothCenter'])) {
                                        echo $dataCount['totalGrothCenter'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">Growth Center</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="salesinfo d-flex align-items-center justify-content-start mb-0">
                                                <div class="icon green">
                                                    <img src="assets/images/saras-center.svg" alt="" />
                                                </div>
                                                <div class="detail">
                                                    <div class="count"><?php if (isset($dataCount['totalSarasCenter'])) {
                                        echo $dataCount['totalSarasCenter'];
                                    } else {
                                        echo 0;
                                    } ?></div>
                                                    <div class="name">Saras center</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-warning">

                                    <!-- /.widget-user-image -->
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h5 class="widget-user-desc ml-0">Total SHG Enterprise</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="float-right">
                                                @if (isset($dataCount['totalSHGSeller']))
                                                {{ $dataCount['totalSHGSeller'] }} @else 0 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer p-0">
                                    <div class="navHead d-flex align-items-center justify-content-between">
                                        <div class="left">District</div>
                                        <div class="right">No. Of Seller</div>
                                    </div>
                                    <ul class="nav flex-column">
                                        @foreach ($dataCount['district'] as $item)
                                            <?php
                                            $shgcount = \App\User::where(['role_id' => 3, 'district' => $item->id])->count();
                                            ?>
                                            <li class="nav-item">
                                                <p href="javascript:void(0);" class="nav-link">
                                                    {{ $item->name }} <span
                                                        class="float-right">{{ $shgcount }}</span>
                                                </p>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-warning">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h5 class="widget-user-desc ml-0">Total CLF</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="float-right">
                                                @if (isset($dataCount['totalArtisan']))
                                                {{ $dataCount['totalArtisan'] }} @else 0 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                <div class="navHead d-flex align-items-center justify-content-between">
                                        <div class="left">District</div>
                                        <div class="right">No. Of Seller</div>
                                    </div>
                                    <ul class="nav flex-column">
                                        @foreach ($dataCount['district'] as $item)
                                            <?php
                                            $artisancount = \App\User::where(['role_id' => 2, 'district' => $item->id])->count();
                                            ?>
                                            <li class="nav-item">
                                                <p href="javascript:void(0);" class="nav-link">
                                                    {{ $item->name }} <span
                                                        class="float-right">{{ $artisancount }}</span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-warning">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h5 class="widget-user-desc ml-0">Total SHG Individual</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="float-right">
                                                @if (isset($dataCount['totalSHGInd']))
                                                {{ $dataCount['totalSHGInd'] }} @else 0 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                <div class="navHead d-flex align-items-center justify-content-between">
                                        <div class="left">District</div>
                                        <div class="right">No. Of Seller</div>
                                    </div>
                                    <ul class="nav flex-column">
                                        @foreach ($dataCount['district'] as $item)
                                            <?php
                                            $artisancount = \App\User::where(['role_id' => 9, 'district' => $item->id])->count();
                                            ?>
                                            <li class="nav-item">
                                                <p href="javascript:void(0);" class="nav-link">
                                                    {{ $item->name }} <span
                                                        class="float-right">{{ $artisancount }}</span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-warning">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h5 class="widget-user-desc ml-0">Growth Center</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="float-right">
                                                @if (isset($dataCount['totalGrothCenter']))
                                                {{ $dataCount['totalGrothCenter'] }} @else 0 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                <div class="navHead d-flex align-items-center justify-content-between">
                                        <div class="left">District</div>
                                        <div class="right">No. Of Seller</div>
                                    </div>
                                    <ul class="nav flex-column">
                                        @foreach ($dataCount['district'] as $item)
                                            <?php
                                            $artisancount = \App\User::where(['role_id' => 7, 'district' => $item->id])->count();
                                            ?>
                                            <li class="nav-item">
                                                <p href="javascript:void(0);" class="nav-link">
                                                    {{ $item->name }} <span
                                                        class="float-right">{{ $artisancount }}</span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 shadow-sm">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-warning">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h5 class="widget-user-desc ml-0">Total Saras Center</h5>
                                        </div>
                                        <div class="col-3 text-right">
                                            <span class="float-right">
                                                @if (isset($dataCount['totalSarasCenter']))
                                                {{ $dataCount['totalSarasCenter'] }} @else 0 @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                <div class="navHead d-flex align-items-center justify-content-between">
                                        <div class="left">District</div>
                                        <div class="right">No. Of Seller</div>
                                    </div>
                                    <ul class="nav flex-column">
                                        @foreach ($dataCount['district'] as $item)
                                            <?php
                                            $artisancount = \App\User::where(['role_id' => 8, 'district' => $item->id])->count();
                                            ?>
                                            <li class="nav-item">
                                                <p href="javascript:void(0);" class="nav-link">
                                                    {{ $item->name }} <span
                                                        class="float-right">{{ $artisancount }}</span>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="masterExport">
                        <div class="title">Master Export</div>
                        <p>Download All data of the platform with just one click</p>
                        <div class="btnWrap mt-3">
                            <a href="#" class="btn btn-lg btn-outline-white">Download Data</a>
                        </div>
                        <div class="image-box">
                            <img src="assets/images/export-data-img.png" class="img-fluid" alt="" />
                        </div>
                    </div>
                </div>
            </div>
                    <center>
                        {{-- <h1>Welcome {{ Auth::user()->name }}!</h1> --}}
                    </center>

                </div>
            </div>
        @endif
    </section>


@endsection
