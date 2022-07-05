@extends('layouts.app')
@section('title', 'Category Management | UNDP')

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
                        <h3 class="card-title">Category ( This Manager is to manage Categories and subcategoies )</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Category Name"
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
                                    Export All Categories
                                </button>
                            </span>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <span class="input-group-btn">
                                <input type="hidden" name="exportlist" value="subcat" />
                                <button type="submit" value="export" class="btn btn-default">
                                    Export All Sub-Categories
                                </button>
                            </span>
                        </form>
                    </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/addcategory') }}" class="btn btn-outline-primary float-sm-right">
                            Add New Category
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
                                    <th>Image</th>
                                    <th>Creator</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $categoryData->perPage() * ($categoryData->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($categoryData as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->name_en }}</td>
                                        <td>{{ $item->name_kn }}</td>
                                        <td><img src="{{ asset($item->image) }}" height="50" width="50"></td>
                                        <td>{{ $item->admin_name }}</td>



                                        <td>
                                            <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>
                                            <a href="{{ url('admin/editCategory') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->is_active == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/enabledisablecategory') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/enabledisablecategory') }}/{{ $item->id }}/0"
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
                        {{ $categoryData->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
