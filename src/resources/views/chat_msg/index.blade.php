@extends('layouts.app')
@section('title', 'Chat Messages Management | UNDP')

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
                        <h3 class="card-title">Chat Messages</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        {{-- <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search Name"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form> --}}
                    </div>


                   
                    <div class="col-md-3">
                   </div>

                    <div class="col-md-4">
                        <a href="{{ url('admin/add-chat-message') }}" class="btn btn-outline-primary float-sm-right">
                            Add Chat Messages
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Message (En)</th>
                                    <th>Message (Hin)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    //$i = $chat_message_list->perPage() * ($chat_message_list->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($chat_message_list as $item)


                                    <tr>
                                        <td>{{-- {{ $i }} --}}{{$loop->iteration  }}</td>
                                        <td>{{ $item->msg_en }}</td>
                                        <td>{{ $item->msg_hi }}</td>

                                        <td>
                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/delete_msg') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/delete_msg') }}/{{ $item->id }}/0"
                                                    class="btn btn-danger btn-sm">Disable</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        //$i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $chat_message_list->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
