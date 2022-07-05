@extends('layouts.app')
@section('title', 'Document Management | UNDP')
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
                        <h3 class="card-title">Documents (This manager is to manage Documents of SHG Enterprise and CLF.)</h3>
                    </div>
                </div>
                <br>
                <div class="row">    
                    <div class="col-md-3">

                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search SHG Enterprise/CLF"
                                    value="@if (isset($_REQUEST['s']) && $_REQUEST['s'] !='' ) {{ $_REQUEST['s'] }} @endif">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                            
                        </form>
                    </div>
                    <div class="col-md-4 form-group">

                        <form action="" method="GET" role="search">
                            @csrf
                            <div class="input-group">
                                @if(Auth::user()->role_id == 5)
                                    <select name="district" class="form-control" id="">
                                        <option value="">--Select District--</option>
                                        @foreach ($alldistrict as $value)
                                            <option value="{{ $value->id }}" @if(isset($_REQUEST['district']) && $_REQUEST['district'] !='')  
                                                @if($value->id == $_REQUEST['district']) selected @endif
                                                @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            View
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
                                <th>Name </th>
                                <th>Mobile</th>
                                <th>District</th>
                                <th>Type</th>
                                <th>Adhar Card No</th>
                                <th>PAN Card No</th>
                                <th>BRN No</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $i = $documentData->perPage()  * ($documentData->currentPage() - 1) + 1;  @endphp

                            {{-- @dd($documentData); --}}
                            @foreach ($documentData as $item)



                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>
                                        @if ($item->user != '') {{ $item->user->name }}
                                        @endif
                                    </td>
                                    <td>  @if ($item->user != '') {{ $item->user->mobile }} @endif</td>
                                    <td>  @if ($item->user != '') {{ $item->user->userdistrict['name'] }} @endif</td>
                                    <td>
                                    @if ($item->user != '')
                                            @if ($item->user->role_id == 2)
                                        CLF
                                        @elseif($item->user->role_id == 3)
                                        SHG Enterprise
                                        @elseif($item->user->role_id == 7)
                                        Saras Center
                                        @elseif($item->user->role_id == 8)
                                        Growth Center
                                        @elseif($item->user->role_id == 9)
                                        SHG Individual
                                        @endif
                                @endif
                                    </td>

                                    <td>
                                        {{ $item->adhar_card_no }}
                                        <br>
                                        <b>
                                            @if ($item->is_adhar_verify == 1)
                                                <p style="color: green">{{ 'Accepted' }}
                                                @elseif($item->is_adhar_verify == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                    </td>


                                    <td>
                                        @if ($item->user != '')
                                            @if ($item->pancard_no == "")
                                                N/A
                                            @else
                                                {{ $item->pancard_no }}
                                                <br>
                                                <b>
                                                    @if ($item->is_pan_verify == true)
                                                        <p style="color: green">{{ 'Accepted' }}
                                                        @elseif($item->is_pan_verify == 2)
                                                         <p style="color: red">{{ 'Rejected' }}</p>
                                                         @else
                                                          <p style="color: orange">{{ 'Pending' }}</p>
                                                    @endif
                                                </b>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->user != '')
                                            @if ($item->brn_no == "")
                                                N/A
                                            @else
                                                {{ $item->brn_no }}

                                                <br>
                                                <b>
                                                    @if ($item->is_brn_verify == true)
                                                        <p style="color: green">{{ 'Accepted' }}
                                                        @elseif($item->is_brn_verify == 2)
                                                         <p style="color: red">{{ 'Rejected' }}</p>
                                                         @else
                                                          <p style="color: orange">{{ 'Pending' }}</p>
                                                    @endif
                                                </b>
                                            @endif
                                        @endif
                                    </td>

                                    <td><a href="{{ url('admin/viewDocument') }}/{{ encrypt($item->id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a></td>
                                </tr>
                                @php $i++; @endphp

                            @endforeach

                        </tbody>
                    </table>
                    {{ $documentData->links() }}
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>

@endsection
