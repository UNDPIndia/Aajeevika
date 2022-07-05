@extends('layouts.app')
@section('title', 'Promo & Marketing Management | UNDP')
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
            <h3 class="card-title">Notification (This manager is to manager Notification for User, SHG and Artisans.)</h3>

            <!-- <button class="btn btn-outline-primary float-sm-right" disabled>Send Bulk Email</button> -->
            <!-- <a href="{{ url('admin/sendbulkemail') }}" class="btn btn-outline-primary float-sm-right">Send Bulk Email</a> -->

            <!-- <a href="{{ url('admin/sendbulkmessage') }}" class="btn btn-outline-primary float-sm-right">Send Bulk Message</a> -->

            <a href="{{ url('admin/addnotification') }}" class="btn btn-outline-primary float-sm-right" >Add New Notification</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Title </th>
                            <th>Body</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Date</th>
                        </tr>

                    </thead>
                    <tbody>
                        @php
                        $i = $notificationList->perPage()  * ($notificationList->currentPage() - 1) + 1;
                        @endphp

                        @foreach ($notificationList as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->body}}</td>
                            <td>@if($item->image != "")
                                <img src="{{asset($item->image)}}" height="50" width="50">
                                @else 
                                N/A
                                @endif

                            </td>
                            <td>{{$item->role->role_name}}</td>
                            <td>{{$item->created_at}}</td>
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
