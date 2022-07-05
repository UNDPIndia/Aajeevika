@extends('layouts.app')
@section('title', 'User Collection Center Management | UNDP')

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
                        <h3 class="card-title">Users ( This Manager is to manage Collection Users )</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search" id="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" id="collectionText" class="form-control" name="s" placeholder="Search User By Name"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                    <input type="hidden" name="collection_center_id" value="{{ $collection_center_id }}">
                                <span class="input-group-btn">
                                    <button type="submit"  class="btn btn-default">
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
                                <button type="submit" style="visibility:hidden;" value="export" class="btn btn-default">
                                    Export All Collection User
                                </button>
                            </span>
                        </form>
                    </div>
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
             <!--           <a href="{{ url('admin/collection-center/adduser/'.$collection_center_id) }}" class="btn btn-outline-primary float-sm-right">
                            Add New User
                           </a>  -->
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Collection Name </th>
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $userData->perPage() * ($userData->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($userData as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->collection_center_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        

                                        <td>
                                        <!--    <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/collection-center/edituser/') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->isActive == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/collection-center/deleteuser') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/collection-center/deleteuser') }}/{{ $item->id }}/0"
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
                        {{ $userData->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

    <script>
        function submitForm()
        {   
            var col = $('#collectionText').val();
            if(col!='')
            {
                $('#search').submit();
            }
            
        }
        </script>

@endsection
