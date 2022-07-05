@extends('layouts.app')
@section('title', 'Suvidha Management | UNDP')

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
                        <h3 class="card-title">Suvidha</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Name"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>


                    <!-- <div class="">
                        <form action="" method="GET" role="search">
                            @csrf

                            <span class="input-group-btn">
                                <input type="hidden" name="exportlist" value="all" />
                                <button type="submit" value="export" class="btn btn-default">
                                    Export All Interest Type
                                </button>
                            </span>
                        </form>
                    </div> -->
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/addsuvidha') }}" class="btn btn-outline-primary float-sm-right">
                            Add Suvidha
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title (En)</th>
                                    <th>Title (Hin)</th>
                                    <th>Image1</th>
                                    <th>Image2</th>
                                    <th>Image3</th>
                                    <th>Image4</th>
                                    <th>desc en</th>
                                    <th>desc hi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $suvidhas->perPage() * ($suvidhas->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($suvidhas as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->title_en }}</td>
                                        <td>{{ $item->title_hi }}</td>
                                        <td><img src="{{ asset($item->image1) }}" width="50px"></td>
                                        <td><img src="{{ asset($item->image2) }}" width="50px"></td>
                                        <td><img src="{{ asset($item->image3) }}" width="50px"></td>
                                        <td><img src="{{ asset($item->image4) }}" width="50px"></td>
                                        <td>{{ $item->desc_en }}</td>
                                        <td>{{ $item->desc_hi }}</td>

                                        <td>
                                        <!--    <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/editsuvidha') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/deletesuvidha') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/deletesuvidha') }}/{{ $item->id }}/0"
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
                        {{ $suvidhas->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
