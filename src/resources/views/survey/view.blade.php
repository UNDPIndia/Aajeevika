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
<style>
.list-group-flush .list-group-item:first-child {
    border-top-width: 1px;
}
</style>
<section class="content">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Certificates</h3></div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-sm-2">

                    <div class="card" style="">
                    @if ($certificateData->certificate_image_1 == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                {{-- <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_1) }}" alt="Card image cap"> --}}
                                <a class="image-popup-vertical-fit" href="{{ asset( $certificateData->certificate_image_1) }}" title="" alt="Card image cap">
                                    <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_1) }}" >
                                </a>
                                @endif
                    
                        <div class="card-body">
                            <h5 class="card-title">Certificate1</h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Status:  </lable> <br>
                                        <b>
                                            @if ($certificateData->certificate_status_1 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($certificateData->certificate_status_1 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                        @if ($certificateData->certificate_status_1 == 0)
                                            <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/1/certificate_status_1" class="btn btn-primary">Accept</a>
                                            <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/2/certificate_status_1" class="btn btn-danger">Reject</a>
                                        @endif
                            </li>
                            <li class="list-group-item"><lable>Type:  </lable> {{ Helper::getCertificateTypeById($certificateData->certificate_type_1, 'en')->name }}</li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card" style="">
                    @if ($certificateData->certificate_image_2 == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                {{-- <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_2) }}" alt="Card image cap"> --}}
                                <a class="image-popup-vertical-fit" href="{{ asset( $certificateData->certificate_image_2) }}" title="" alt="Card image cap">
                                    <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_2) }}" >
                                </a>

                                @endif
                        <div class="card-body">
                            <h5 class="card-title">Certificate2</h5>

                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Status:  </lable> <br>
                                        <b>
                                            @if ($certificateData->certificate_status_2 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($certificateData->certificate_status_2 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                        @if ($certificateData->certificate_status_2 == 0)
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/1/certificate_status_2" class="btn btn-primary">Accept</a>
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/2/certificate_status_2" class="btn btn-danger">Reject</a>
                                        @endif
                            </li>
                            <li class="list-group-item"><lable>Type:  </lable> {{ Helper::getCertificateTypeById($certificateData->certificate_type_2, 'en')->name }}</li>

                        </ul>

                    </div>
                </div>
                <div class="col-sm-2">

                    <div class="card" style="">
                    @if ($certificateData->certificate_image_3 == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                {{-- <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_3) }}" alt="Card image cap"> --}}
                                <a class="image-popup-vertical-fit" href="{{ asset( $certificateData->certificate_image_3) }}" title="" alt="Card image cap">
                                    <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_3) }}" >
                                </a>

                                @endif
                    
                        <div class="card-body">
                            <h5 class="card-title">Certificate3</h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Status:  </lable> <br>
                                        <b>
                                            @if ($certificateData->certificate_status_3 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($certificateData->certificate_status_3 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                        @if ($certificateData->certificate_status_3 == 0)
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/1/certificate_status_3" class="btn btn-primary">Accept</a>
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/2/certificate_status_3" class="btn btn-danger">Reject</a>
                                        @endif
                            </li>
                            <li class="list-group-item"><lable>Type:  </lable> {{ Helper::getCertificateTypeById($certificateData->certificate_type_3, 'en')->name }}</li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card" style="">
                    @if ($certificateData->certificate_image_4 == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                {{-- <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_4) }}" alt="Card image cap"> --}}
                                <a class="image-popup-vertical-fit" href="{{ asset( $certificateData->certificate_image_4) }}" title="" alt="Card image cap">
                                    <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_4) }}" >
                                </a>

                                @endif
                        <div class="card-body">
                            <h5 class="card-title">Certificate4</h5>

                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Status:  </lable> <br>
                                        <b>
                                            @if ($certificateData->certificate_status_4 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($certificateData->certificate_status_4 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                        @if ($certificateData->certificate_status_4 == 0)
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/1/certificate_status_4" class="btn btn-primary">Accept</a>
                                        <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/2/certificate_status_4" class="btn btn-danger">Reject</a>
                                        @endif
                            </li>
                            <li class="list-group-item"><lable>Type:  </lable> {{ Helper::getCertificateTypeById($certificateData->certificate_type_4, 'en')->name }}</li>

                        </ul>

                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card" style="">
                    @if ($certificateData->certificate_image_5 == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                {{-- <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_5) }}" alt="Card image cap"> --}}
                                <a class="image-popup-vertical-fit" href="{{ asset( $certificateData->certificate_image_5) }}" title="" alt="Card image cap">
                                    <img class="card-img-top" height="200" src="{{ asset( $certificateData->certificate_image_5) }}" >
                                </a>
                                @endif
                        <div class="card-body">
                            <h5 class="card-title">Certificate5</h5>

                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Status:  </lable> <br>
                                        <b>
                                            @if ($certificateData->certificate_status_5 == 1)
                                                <p style="color: green">{{ 'Verified' }}</p>
                                                @elseif($certificateData->certificate_status_5 == 2)
                                                <p style="color: red">{{ 'Rejected' }}</p>
                                                @else
                                                <p style="color: orange">{{ 'Pending' }}</p>
                                            @endif
                                        </b>
                                        @if ($certificateData->certificate_status_5 == 0)
                                            <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/1/certificate_status_5" class="btn btn-primary">Accept</a>
                                            <a href="{{ url('admin/acceptCertificate') }}/{{ $certificateData->id }}/2/certificate_status_5" class="btn btn-danger">Reject</a>
                                        @endif

                            </li>
                            <li class="list-group-item"><lable>Type:  </lable> {{ Helper::getCertificateTypeById($certificateData->certificate_type_5, 'en')->name }}</li>

                        </ul>

                    </div>
                </div>

            </div>
        </div>

</section>


@endsection
