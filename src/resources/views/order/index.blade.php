@extends('layouts.app')
@section('title', 'Order Management | UK - UNDP')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UK-UNDP</h1>
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
                <h3 class="card-title">Order Mangement ( This Manager is to manage Order.)</h3>
               <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Order Id / Interest Id"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="">
                        <form action="" method="GET" role="search">
                            @csrf

                            <span class="input-group-btn">
                                <input type="hidden" name="exportlist" value="all" />
                                <button type="submit" value="export" class="btn btn-default">
                                    Export All Order
                                </button>
                            </span>
                        </form>
                    </div>     


                </div>
                
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Id</th>
                                <th>Interest Id</th>
                                <th>Date of Sales</th>
                                <th>Date of Creation</th>

                                <th>Mode of Delivery</th>
                                <th>Order Value</th>
                                <th>Order Status</th>
                                <th>Buyer Name</th>
                                <th>Buyer Phone</th>

                                <th>Seller Name</th>
                                <th>Type</th>
                                <th>District</th>
                                <th>Block</th>
                                <th>Seller Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = $allorder->perPage()  * ($allorder->currentPage() - 1) + 1;
                            @endphp
                            @foreach ($allorder as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->order_id_d }}</td>
                                    <td>{{ $item->interest->interest_Id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->updated_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>

                                    <td>@if($item->mode_of_delivery=='1')
                                           Collection Center
                                           @else
                                           Self
                                           @endif
                                     </td>
                                    <td>

                                        <?php
                                            // print_r($item->items); 
                                            // die("check");
                                            $ttlPrice = 0;
                                            // if($item->items) {
                                                foreach($item->items as $value) {
                                                    $ttlPrice += ($value->quantity  *  $value->product_price);
                                                }
                                            // }

                                            echo 'Rs. '.$ttlPrice;
                                        ?>          
                                    </td>
                                    <td>{{ $item->order_status }}</td>
                                    <td>{{ $item->buyer->name }}</td>
                                    <td>{{ $item->buyer->mobile }}</td>
 
                                    <td>{{ $item->seller->name }}</td>
                                    <td>
                                        @php
                                            $sellerRole = App\Role::where('id', $item->seller->role_id)->first();
                                            echo $sellerRole->role_name;
                                        @endphp
                                    </td>
                                    <td>{{ $item->seller->userdistrict->name}}</td>
                                    <td>{{ $item->seller->userBlock?$item->seller->userBlock->name : 'NA'}}</td>
                                    <td>{{ $item->seller->mobile }}</td>

                                    <td>
                                        <a href="{{ url('admin/orders/view') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                    {{ $allorder?$allorder->links():'' }}
                    
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>

@endsection
