@extends('layouts.app')
@section('title', 'Product Type Management | UNDP')
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
                <h3 class="card-title">Product Type (This Manager is to manage Product Type.)</h3>
                <a href="{{ url('admin/addmaterial') }}" class="btn btn-outline-primary float-sm-right">Add Product
                    Type</a>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <form action="" method="GET" role="search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="s" placeholder="Search Product Type"
                                value="@if(isset($_REQUEST['s']) && $_REQUEST['s'] !='' ){{$_REQUEST['s']}}@endif">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
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
                                {{-- <th>Image</th> --}}
                                <th>Category</th>
                                <th>Sub Category</th>
                                <!-- <th>Date</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @php
                                $i = 1;
                            @endphp
                            @foreach ($materialData as $item)


                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name_en ?? 'NA' }}</td>
                                    <td>{{ $item->name_kn ?? 'NA' }}</td>
                                    {{-- <td><img src="{{ asset("images/material/".$item->image) }}" width="42" height="42"/></td> --}}
                                    <td>{{ $item->category->name_en ?? 'NA' }}</td>
                                    <td>{{ $item->subcategory->name_en ?? 'NA' }}</td>
                                    <!-- <td>{{ $item->created_at }}</td> -->
                                    <td><a href="{{ url('admin/editMaterial') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>
                                            
                                        {{-- <a href="{{ url('admin/deleteAdmin User') }}/{{ $item->id }}" class="btn btn-outline-danger btn-sm">Delete</a> --}}
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach



                        </tbody>
                    </table>
                    {{ $materialData->links() }}
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>

@endsection
