@extends('layouts.app')
@section('title', 'Order Management | UNDP')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UK - UNDP</h1>
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
                <h3 class="card-title">Ind Order View ( This Manager is to manage Individual order.)</h3>
                {{-- <a href="{{ url('admin/addbanner') }}" class="btn btn-outline-primary float-sm-right">Add New Banner</a> --}}
            </div>
            <div class="card-body">

                <table class="table table-responsive" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Id</th>
                              <!--  <th>Interest Id</th>-->
                                <th>Date of Sales</th>
                                <th>Date of Creation</th>

                             <!--   <th>Mode of Delivery</th>-->
                               <!-- <th>Order Value</th>-->
                                <th>Delivery Status</th>
                                <th>Individual Name</th>
                                <th>Individual Phone</th>

                                <th>CLF Name</th>
                        <!--    <th>Type</th>-->
                                <th>District</th>
                                <th>Block</th>
                                <th>CLF Phone</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($allorder as $item)
                            <tr>
                            <td>{{ $i }}</td>
                                    <td>{{ $item->order_id_d }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>

                                <!--    <td>{{ $item->mode_of_delivery }}</td>-->
                                    
                                    <td>{{ $item->delivery_status }}</td>
                                    <td>{{ $item->GetIndividual->name }}</td>
                                    <td>{{ $item->GetIndividual->mobile }}</td>
 
                                    <td>{{ $item->getClf->name }}</td>
                                    <!--<td>-->
                                        @php
                                          //  $sellerRole = App\Role::where('id', $item->getClf->role_id)->first();
                                          //  echo $sellerRole->role_name;
                                        @endphp
                                   <!-- </td>-->
                                    <td>{{ $item->getClf->userdistrict->name}}</td>
                                    <td>{{ $item->getClf->userBlock?$item->getClf->userBlock->name : 'NA'}}</td>
                                    <td>{{ $item->getClf->mobile }}</td>

                                
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="col-sm-12">
                    <h3>Products</h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                   
                                <th>Quantity</th>
                           <!--     <th>Total Product Price</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                                $ttlPrice = 0;
                            @endphp
                            @foreach ($allorder[0]->indItems as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->Indproduct->name_en }}</td>
                                    
                                    <td>{{ $item->quantity }}</td>  
                                    <td><!--Rs. {{ $item->quantity  *  $item->Indproduct->price }}-->
                                        @php
                                           // $ttlPrice += ($item->quantity  *  $item->Indproduct->price);
                                        @endphp
                                    </td> 
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                                <tr>
                                   <td colspan=4 style="text-align: right;">
                               <!--       Total Amount Rs. {{ $ttlPrice }}-->
                                   </td> 
                                   <td></td>
                                </tr>

                        </tbody>
                    </table>
                    <!-- <div col-sm-12>
                        <h3>Message</h3>
                        <p class="alert alert-info">{{ $allorder[0]->message }}</p>
                    </div> -->
            </div>
        </div>

    </section>

@endsection
