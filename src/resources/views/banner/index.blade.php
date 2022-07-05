@extends('layouts.app')
@section('title', 'Banner Management | UNDP')
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
                <h3 class="card-title">Banner ( This Manager is to manage Banners.)</h3>
                <a href="{{ url('admin/addbanner') }}" class="btn btn-outline-primary float-sm-right">Add New Banner</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner Image</th>
                                <th>Banner Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($bannerData as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><img src="{{ asset($item->image) }}" height=40 width=40></td>
                                    <td>{{ $item->action }}</td>
                                    <td>
                                        <a href="{{ url('admin/editbanner') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>

                                        <?php if ($item->status == 1) { ?>
                                        <a href="{{ url('admin/deletebanner') }}/{{ encrypt($item->id) }}/0"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-success btn-sm">Enable</a>
                                        <?php } else { ?>
                                        <a href="{{ url('admin/deletebanner') }}/{{ encrypt($item->id) }}/1"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger btn-sm">Disable</a>
                                        <?php } ?>


                                        <a onclick="return confirm('Are you sure?')"
                                            href="{{ url('admin/del') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-danger btn-sm">Delete</a>


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
