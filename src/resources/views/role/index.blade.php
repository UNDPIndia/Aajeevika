@extends('layouts.app')
@section('title', 'View Stakeholders | UNDP')
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
                        <h3 class="card-title">Role (This manager is to manager Roles for user, SHG and Artisans)</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- <div class="col-md-2">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Role"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div> -->
                    <div class="col-md-10 form-group">

                        {{-- <a href="{{ url('admin/addrole') }}" class="btn btn-outline-primary float-sm-right">Add Role</a>
                        <a href="{{ url('admin/permission') }}" class="btn btn-outline-primary float-sm-right">Add Permission</a> --}}
                        {{-- <a href="{{ url('admin/rolepermission') }}" class="btn btn-outline-primary float-sm-right">Add Permission to Role</a> --}}


                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                {{-- <th>Action</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($roleList as $item)


                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->role_name }}</td>
                                    {{-- <td><a href="{{ url('admin/rolepermission') }}/{{ $item->id  }}">Update Permission</a></td> --}}
                                    <!-- <td>
                                        <a href="{{ url('admin/editrole') }}/{{ $item->id }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>
                                        {{-- <a
                                            href="{{ url('admin/deleterole') }}/{{ $item->id }}"
                                            class="btn btn-outline-danger btn-sm">Delete</a>
                                        --}}

                                    </td> -->
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
