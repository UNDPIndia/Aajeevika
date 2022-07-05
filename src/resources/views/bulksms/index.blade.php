@extends('layouts.app')

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
                <h3 class="card-title">Bulk SMS (This manager is to manage Bulk SMS for User, SHG and Artisans.)</h3>
                {{-- <a href="{{ url('admin/sendbulkemail') }}" class="btn btn-outline-primary float-sm-right">Send Bulk Email</a>

            <a href="{{ url('admin/sendbulkmessage') }}" class="btn btn-outline-primary float-sm-right">Send Bulk Message</a> --}}

                <a href="{{ url('admin/addbulk') }}" class="btn btn-outline-primary float-sm-right">Send New Bulk
                    SMS</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Message</th>
                                <th>Role</th>
                                <th>Date</th>
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $i = $bulklist->perPage() * ($bulklist->currentPage() - 1) + 1;
                            @endphp

                            @foreach ($bulklist as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ $item->role->role_name }}</td>
                                    <td>{{ $item->created_at }}</td>
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
