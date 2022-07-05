@extends('layouts.app')
@section('title', 'Survey Management | UNDP')
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
                        <h3 class="card-title">Surveys (This manager is to manage Survey of SHG Enterprise and CLF.)</h3>
                    </div>

                    <div class="col-md-3">

                        <form action="" method="GET" role="search">
                            
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search by heading"
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
                        <a href="{{ url('admin/addsurvey') }}" class="btn btn-outline-primary float-sm-right">
                            Add New Survey
                        </a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Heading </th>
                                <th>Url </th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php 
                            $i = $surveyData->perPage()  * ($surveyData->currentPage() - 1) + 1;
                            $today_date = date('Y-m-d');  
                            @endphp
                            @foreach ($surveyData as $item)

                                <tr>
                                    <td> {{ $i }}</td>
                                    <td> {{ $item->message }}</td>
                                    <td> {{ $item->google_url }}</td>
                                    <td> {{ $item->start_date }} </td>
                                    <td> {{ $item->end_date }} </td>                                                                   
                                    <td> @php 
                                            $end_date = strtotime($item->end_date);
                                            $end_date = date('Y-m-d', $end_date);
                                        @endphp
                                        @if($today_date <= $end_date)
                                         Open
                                        @else
                                            Closed
                                        @endif
                                    </td>
                                    <td>
                                        <!-- <a href="{{ url('admin/viewGrievance') }}/{{ encrypt($item->grievance_id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a> -->
                                            <a href="{{ url('admin/editSurvey') }}/{{ $item->id }}"
                                                class="btn btn-outline-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                                @php $i++; @endphp

                            @endforeach

                        </tbody>
                    </table>
                    {{ $surveyData->links() }}
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>
    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('admin/grievanceReply') }}">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div> -->
                    <input type="hidden" id="input_grievance_id" name="grievance_id">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="message" id="message-text"></textarea>
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>
@endsection
