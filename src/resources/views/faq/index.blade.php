@extends('layouts.app')
@section('title', 'Faq Management | UNDP')

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
                        <h3 class="card-title">Faq</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <form action="" method="GET" role="search">
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
                        </form>
                    </div>


                   
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/addfaq') }}" class="btn btn-outline-primary float-sm-right">
                            Add Faq Topic
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Topic (En)</th>
                                    <th>Topic (Hin)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $faq->perPage() * ($faq->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($faq as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->topic_en }}</td>
                                        <td>{{ $item->topic_hi }}</td>

                                        <td>
                                        <!--    <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/editfaq') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/deletefaq') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/deletefaq') }}/{{ $item->id }}/0"
                                                    class="btn btn-danger btn-sm">Disable</a>
                                            @endif

                                            <a href="{{ url('admin/faqquestion') }}/{{ encrypt($item->id) }}"
                                                class="btn btn-outline-primary btn-sm">Question</a>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $faq->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
