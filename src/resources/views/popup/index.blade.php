@extends('layouts.app')
@section('title', 'Popup Management | UNDP')
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
            <h3 class="card-title">Popup Manager ( This Manager is to manage Popups for User, SHG Enterprise, CLF)</h3>
            <a href="{{ url('admin/addpopup') }}" class="btn btn-outline-primary float-sm-right">Add New Popup</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <!-- <th>Description </th> -->
                            <th>Background Image</th>
                            <th>Role</th>
                            <th>Language</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($popupList as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->title}}</td>
                            <td><img src="{{asset($item->background_image)}}" height="50" width="50"></td>                          
                            <td>
                                @if($item->role_id == 1) 
                                    User
                                @endif
                                @if( $item->role_id == 2 )
                                    Artisan
                                @endif
                                @if( $item->role_id == 3 )
                                    SHG
                                @endif
                            </td>
                            <td>{{$item->language}}</td>
                            <td>{{$item->created_at}}</td>
                            
                            <td>
                                <a  href="{{ url('admin/editpopup') }}/{{ encrypt($item->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                @if ($item->status == 1)
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/popupmanager/deletepopup') }}/{{ encrypt($item->id) }}" class="btn btn-outline-success btn-sm">Enable</a>
                                @else
                                <a onclick="return confirm('Are you sure?')" href="{{ url('admin/popupmanager/deletepopup') }}/{{ encrypt($item->id) }}" class="btn btn-outline-danger btn-sm">Disable</a>

                                @endif
                                <a onclick="return confirm('Are you sure?')"  href="{{ url('admin/deletepopupfinal') }}/{{ encrypt($item->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
