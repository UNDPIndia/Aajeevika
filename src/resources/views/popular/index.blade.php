@extends('layouts.app')
@section('title', 'Popular Product Management | UNDP')
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
                <h3 class="card-title">Popular Products (This Manager is to manage Popular Products.)</h3>
                <a href="{{ url('admin/addpopular') }}" class="btn btn-outline-primary float-sm-right">Add New Popular
                    Product</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Product Name</th>
                                <th> Image </th>
                                <th> Action </th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($productData as $key => $item)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->product->localname_en }}</td>
                                    <td><img class=" img-thumbnail rounded-circle"
                                            src="{{ asset($item->product->image_1) }}" height="60" width="60"></td>
                                    <td>
                                        <a href="{{ url('admin/removefrompopular') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-danger btn-sm">Remove Popular</a>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>

@endsection
