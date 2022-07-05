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
            <div class="card-header">


                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Collection ( This Manager is to manage Collection )</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Collection Name"
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
                                    Export All Collection
                                </button>
                            </span>
                        </form>
                    </div>
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/collection-center/addcollection') }}" class="btn btn-outline-primary float-sm-right">
                            Add New Collection
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
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Block</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $collectionData->perPage() * ($collectionData->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($collectionData as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->name_en }}</td>
                                        <td>{{ $item->name_hi }}</td>
                                        <td>{{ $item->state_name }}</td>
                                        <td>{{ $item->city_name }}</td>
                                        <td>{{ $item->block_name }}</td>

                                        <td>
                                        <!--    <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/collection-center/editcollection') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/collection-center/deletecollection') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/collection-center/deletecollection') }}/{{ $item->id }}/0"
                                                    class="btn btn-danger btn-sm">Disable</a>
                                            @endif
                                            <button type="button" style="font-size:13px;" onclick="window.location.href='{{ url('admin/collection-center/adduser/'.$item->id) }}'" class="btn btn-primary">Add User </button>
                                            <button type="button" style="font-size:13px;" onclick="window.location.href='{{ url('admin/collection-center/viewuser/'.$item->id) }}'" class="btn btn-success">View User </button>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $collectionData->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
