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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                <h3 class="card-title">View Category</h3>
                <a style="float: right;" href="{{ url('admin/addcategory') }}?category_id={{ $categoryData->id }}"
                    class="btn btn-outline-primary btn-sm">Add Subcategory</a>

            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Name English : </label>
                            <input disabled type="text" class="form-control" name="name_en" id=""
                                value="{{ $categoryData->name_en }}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Name Hindi : </label>
                            <input disabled type="text" class="form-control" name="name_kn" id=""
                                value="{{ $categoryData->name_kn }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Category Image: </label>
                            <br>
                            <img src="{{ asset($categoryData->image) }}" height="200">
                        </div>



                    </div>

                    @if (!empty($categoryData->subcategory))

                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="">Sub Categories </label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name English</th>
                                            <th scope="col">Name Hindi</th>
                                            <th scope="col">Image</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $i = 1;
                                        @endphp

                                        @foreach ($categoryData->subcategory as $item)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $item->name_en }}</td>
                                                <td>{{ $item->name_kn }}</td>
                                                <td><img src="{{ asset($item->image) }}" height="40"></td>
                                                <td> 
                                                    @if($item->is_active == 1)
                                                        <a href="{{ url('admin/enabledisablecategory') }}/{{ $item->id }}/0"
                                                        class="btn btn-outline-danger btn-sm">Disable</a>  
                                                       
                                                        @else

                                                        <a href="{{ url('admin/enabledisablecategory') }}/{{ $item->id }}/1"
                                                            class="btn btn-outline-success btn-sm">Enable</a>  
                                                    @endif


                                                    <a href="{{ url('admin/editCategory') }}/{{ $item->id }}"
                                                        class="btn btn-outline-primary btn-sm">Edit</a>
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

                    @endif




                </form>
            </div>
        </div>
    </section>

@endsection
