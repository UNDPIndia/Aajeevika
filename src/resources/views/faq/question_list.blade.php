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
                        <h3 class="card-title">Faq Question</h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- <div class="col-md-3">
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
                    </div> -->


                   
                    <div class="col-md-3">
                   </div>



                    <div class="col-md-4">
                        <a href="{{ url('admin/addfaqquestion/'.$id) }}" class="btn btn-outline-primary float-sm-right">
                            Add Question
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                    <th>Topic Name</th>
                                    <th>Question (En)</th>
                                    <th>Question (Hin)</th>
                                    <th>Desc (En)</th>
                                    <th>Desc (Hin)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = $faqQuest->perPage() * ($faqQuest->currentPage() - 1) + 1;
                                @endphp
                                @foreach ($faqQuest as $item)


                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->getFaq->topic_en }}</td>
                                        <td>{{ $item->question_en }}</td>
                                        <td>{{ $item->question_hi }}</td>
                                        <td>{{ $item->desc_en }}</td>
                                        <td>{{ $item->desc_hi }}</td>

                                        <td>
                                        <!--    <a href="{{ url('admin/viewcategory') }}/{{ $item->id }}"
                                                class="btn  btn-outline-primary btn-sm">View</a>-->
                                            <a href="{{ url('admin/editfaqquestion') }}/{{ encrypt($item->id) }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>



                                            @if ($item->status == 0)
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/updatefaqquestion') }}/{{ $item->id }}/1"
                                                    class="btn btn-success btn-sm">Enable</a>
                                            @else
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/updatefaqquestion') }}/{{ $item->id }}/0"
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
                        {{ $faqQuest->links() }}
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>

    </section>

@endsection
