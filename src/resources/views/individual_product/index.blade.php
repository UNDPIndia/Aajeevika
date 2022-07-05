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
            <div class="card-header">


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Individual Product ( This Manager is to manage Individual Product )</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Product Name"
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
                                    Export All Ind Product
                                </button>
                            </span>
                        </form>
                    </div>
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/individual/addproduct') }}" class="btn btn-outline-primary float-sm-right">
                            Add New Ind Product
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name (En)</th>
                                    <th>Name (Hin)</th>
                                    <th>Category Name</th>
                                    <th>Measurement</th>
                                    <th>Price Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $productData->perPage() * ($productData->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($productData as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->name_en }}</td>
                                        <td>{{ $item->name_hi }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>@if($item->no_measurement=='1')
                                            Measurement
                                            @else
                                                 No Measurement           
                                            @endif
                                        </td>
                                        <td> {{ $item->price_unit }} </td>

                                        <td>
                                         <!--   <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/individual/editproduct') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/individual/deleteproduct') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/individual/deleteproduct') }}/{{ $item->id }}/0"
                                                    class="btn btn-danger btn-sm">Disable</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productData->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
