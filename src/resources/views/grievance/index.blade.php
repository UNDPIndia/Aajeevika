@extends('layouts.app')
@section('title', 'Grievance Management | UNDP')
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
                        <h3 class="card-title">Grievances </h3>
                    </div>

                    <div class="col-md-6">

                        <form action="" method="GET" role="search">
                            
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search by user name, mobile, ticket id"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name </th>
                                <th>Type </th>
                                <th>Mobile</th>
                                <th>Issue Type</th>
                                <th>Ticket ID</th>
                                <!-- <th>Concern</th> -->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $i = $grievanceData->perPage()  * ($grievanceData->currentPage() - 1) + 1;  @endphp
                            @foreach ($grievanceData as $item)

                                <tr>
                                    <td> {{ $i }}</td>
                                    <td> {{ $item->name }}</td>
                                    <td> @if ($item->role_id == 2)
												CLF
												@elseif($item->role_id == 3)
												SHG Enterprise
												@elseif($item->role_id == 7)
												Saras Center
												@elseif($item->role_id == 8)
												Growth Center
												@elseif($item->role_id == 9)
												SHG Individual
                                                @elseif($item->role_id == 1)
												Buyer
                                                @elseif($item->role_id == 10)
                                                Collection Center
										@endif</td>
                                    <td> {{ $item->mobile }} </td>
                                    <td> {{ $item->title_en }} </td>                                                                   
                                    <td> {{ $item->ticket_id }} </td>                                                                   
                                    <!-- <td> {{ $item->message }} </td>                                                                    -->
                                    <td>
                                        <b>
                                            @if ($item->grievance_status == 1)
                                                <p style="color: green">{{ 'Closed' }}
                                            @else
                                                <p style="color: orange">{{ 'Open' }}</p>
                                            @endif
                                        </b></td>                                                               

                                    <td>
                                        <a href="{{ url('admin/viewGrievance') }}/{{ encrypt($item->grievance_id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a>
                                            @if ($item->grievance_status != 1)
                                                <a href="{{ url('admin/closeTicket') }}/{{ encrypt($item->grievance_id) }}/1" class="btn btn-outline-primary btn-sm">Close</a>
                                                <!-- <a href="#" class="btn btn-outline-primary btn-sm">Reply</a> -->
                                                {{-- <button type="button" class="btn btn-outline-primary btn-sm" data-grievance_id="{{ $item->grievance_id }}" data-toggle="modal" data-target="#replyModal" data-whatever="@mdo">Reply</button> --}}
                                            @endif
                                    </td>
                                </tr>
                                @php $i++; @endphp

                            @endforeach

                        </tbody>
                    </table>
                    {{ $grievanceData->links() }}
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>
    <!-- Reply Modal -->

@endsection
