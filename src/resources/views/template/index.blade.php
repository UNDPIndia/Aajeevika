@extends('layouts.app')
@section('title', 'Template Management | UNDP')
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
                        <h3 class="card-title">Templates (This Manager is to manage Templates for Products.)</h3>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Template Name"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">


                        <form action="" method="GET" role="search">
                            @csrf
                            <span class="input-group-btn">
                                <input type="hidden" name="exportlist" value="all" />
                                <button type="submit" value="export" class="btn btn-default">
                                    Export All Template
                                </button>
                            </span>
                        </form>




                    </div>
                    <div class="col-md-6"> <a href="{{ url('admin/addTemplate') }}"
                            class="btn btn-outline-primary float-sm-right">Add New Template</a>
                    </div>
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
                                <th>Category</th>
                                <th>Sub Category</th>
                                <!-- <th>Material</th> -->
                                {{-- <th>Date</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($temp as $item)
                                <tr>

                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name_en }}</td>
                                    <td>{{ $item->name_kn }}</td>
                                    <td>{{ $item->category->name_en }}</td>
                                    @if (!empty($item->subcategory->name_en))
                                        <td>{{ $item->subcategory->name_en }}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    <!-- <td>{{ $item->material->name_en }}</td> -->
                                    {{-- <td>{{ $item->created_at }}</td> --}}
                                    <td> <a href="{{ url('admin/editTemplate') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a></td>
                                    @php
                                        $i++;
                                    @endphp

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $temp->links() }}
            </div>
        </div>

    </section>

@endsection
