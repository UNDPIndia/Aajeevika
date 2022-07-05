@extends('layouts.app')
@section('title', 'Certificate Management | UNDP')
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
                        <h3 class="card-title">Certificates (This manager is to manage Certificate of SHG Enterprise and CLF.)</h3>
                    </div>

                    <div class="col-md-6">

                        <form action="" method="GET" role="search">
                            
                            <div class="input-group">
                                <input type="text" class="form-control" name="s" placeholder="Search by organization  name, product name, product id"
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
                                <th>Organization Name </th>
                                <th>Type</th>
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Certificate Image1</th>
                                <th>Certificate Image2</th>
                                <th>Certificate Image3</th>
                                <th>Certificate Image4</th>
                                <th>Certificate Image5</th>
                                <th>Certificate Image6</th>
                                <th>Certificate Image7</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $i = $certificateData->perPage()  * ($certificateData->currentPage() - 1) + 1;  @endphp
                            @foreach ($certificateData as $item)

                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->organization_name }}</td>
                                    <td>  
                                            @if ($item->role_id == 2)
												CLF
												@elseif($item->role_id == 3)
												SHG Enterprise
												@elseif($item->role_id == 7)
												Saras Center
												@elseif($item->role_id == 8)
												Growth Center
												@elseif($item->role_id == 9)
												SHG Individual
										@endif</td>
                                    <td>  {{ $item->localname_en }} </td>
                                    <td>
										{{ $item->product_id_d }} 
                                    </td>

                                    <td>
                                    @if ($item->certificate_image_1 == '')
                                        <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                        <b><p>Not Available</p></b>
                                    @else
                                        <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_1) }}" alt="">
                                        <b>
                                            @if ($item->certificate_status_1 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($item->certificate_status_1 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                    @endif
                                        
                                    </td>
									<td>
                                    @if ($item->certificate_image_2 == '')
                                        <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                        <b><p>Not Available</p></b>
                                    @else
                                        <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_2) }}" alt="">
                                        <b>
                                            @if ($item->certificate_status_2 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($item->certificate_status_2 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                    @endif
                                    
                                    </td>
									<td>
                                    @if ($item->certificate_image_3 == '')
                                        <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                        <b><p>Not Available</p></b>
                                    @else
                                        <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_3) }}" alt="">
                                        <b>
                                            @if ($item->certificate_status_3 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($item->certificate_status_3 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                    @endif
                                    
                                    </td>
									<td>
                                    @if ($item->certificate_image_4 == '')
                                        <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                        <b><p>Not Available</p></b>
                                    @else
                                        <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_4) }}" alt="">
                                        <b>
                                            @if ($item->certificate_status_4 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($item->certificate_status_4 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                    @endif
                                    
                                    </td>
									<td>
                                        @if ($item->certificate_image_5 == '')
                                            <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                            <b><p>Not Available</p></b>
                                        @else    
                                            <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_5) }}" alt="">
                                            <b>
                                                @if ($item->certificate_status_5 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($item->certificate_status_5 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            </b>
                                        @endif
                                    
                                    </td> 
                                    <td>
                                        @if ($item->certificate_image_6 == '')
                                            <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                            <b><p>Not Available</p></b>
                                        @else    
                                            <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_6) }}" alt="">
                                            <b>
                                                @if ($item->certificate_status_6 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($item->certificate_status_6 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            </b>
                                        @endif
                                    
                                    </td>
                                    <td>
                                        @if ($item->certificate_image_7 == '')
                                            <img src="{{ asset('public/assets/images/notfound.png') }}" height="50" >
                                            <b><p>Not Available</p></b>
                                        @else    
                                            <img class="card-img-top" height="50" src="{{ asset( $item->certificate_image_7) }}" alt="">
                                            <b>
                                                @if ($item->certificate_status_7 == 1)
                                                    <p style="color: green">{{ 'Verified' }}</p>
                                                    @elseif($item->certificate_status_7 == 2)
                                                    <p style="color: red">{{ 'Rejected' }}</p>
                                                    @else
                                                    <p style="color: orange">{{ 'Pending' }}</p>
                                                @endif
                                            </b>
                                        @endif
                                    
                                    </td>                                  

                                    <td><a href="{{ url('admin/viewCertificate') }}/{{ encrypt($item->certificate_id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a></td>
                                </tr>
                                @php $i++; @endphp

                            @endforeach

                        </tbody>
                    </table>
                    {{ $certificateData->links() }}
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

    </section>

@endsection
