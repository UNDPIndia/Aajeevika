@extends('layouts.app')
@section('title', 'Admin User Management | UNDP')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UNDP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active"><a href="#">Home</a></li> --}}
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
						<h3 class="card-title">Admin User (This manager is to manager Subadmin)</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search User Name, Email, Mobile."
                                    value="@if(isset($_REQUEST['s']) && $_REQUEST['s'] !='' ){{$_REQUEST['s']}}@endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>


                    {{-- <div class="">
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
                    </div> --}}



                    <div class="col-md-9">
						<a href="{{ url('admin/addadminuser') }}" class="btn btn-outline-primary float-sm-right">Add Admin
							User</a>
                    </div>
                </div>


               
               
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Type</th>
                                <th>District</th>
                                <th>Block</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($userData as $item)
                                @php
                                    
                                @endphp

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>@if ($item->role_id == 4)
                                         DTE
                                         @elseif ($item->role_id == 5)
                                         Admin
                                         @elseif ($item->role_id == 11)
                                         BMM
                                         @endif
                                    </td>
                                    <td>{{ $item->district_name }}</td>
                                    <td>{{ $item->block_name }}</td>
                                    <td>{{ $item->state_name }}</td>

                                    <td>
                                        <a href="{{ url('admin/editAdmin') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>
                                        {{-- <a href="{{ url('admin/deleteAdmin User') }}/{{ $item->id }}" class="btn btn-outline-danger btn-sm">Delete</a> --}}

                                        @if ($item->isActive == 1)
                                            <a onclick="return confirm('Are you sure?')"
                                                href="{{ url('admin/blockunblockAdmin') }}/{{ encrypt($item->id) }}/0"
                                                class="btn btn-outline-danger btn-sm">Block</a>
                                        @else
                                            <a onclick="return confirm('Are you sure?')"
                                                href="{{ url('admin/blockunblockAdmin') }}/{{ encrypt($item->id) }}/1"
                                                class="btn btn-outline-success btn-sm">Un Block</a>
                                        @endif

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
