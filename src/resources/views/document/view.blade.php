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
<style>
.list-group-flush .list-group-item:first-child {
    border-top-width: 1px;
}
</style>
<?php

// echo "<pre>"; print_r($documentData);
// echo "</pre>";


?>
<section class="content">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Documents</h3></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                <h3>Aadhar Card Details </h3>
                </div>
                <div class="col-md-6">
                <?php if( $documentData->is_adhar_verify != 1 ) { ?>
                    <a href="{{ url('admin/acceptAdhar') }}/{{ $documentData->id }}/1" class="btn btn-primary">Accept Adhar</a>
                <?php }  else { ?>

                    <a href="{{ url('admin/acceptAdhar') }}/{{ $documentData->id }}/2" class="btn btn-danger">Reject</a>

                <?php } ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">

                    <div class="card" style="">
                    @if ($documentData->adhar_card_front_file == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                <img class="card-img-top" height="200" src="{{ asset( $documentData->adhar_card_front_file) }}" alt="Card image cap">

                                @endif
                    
                        <div class="card-body">
                            <h5 class="card-title">Aadhar card front</h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>Aadhar no:  </lable> <label>{{$documentData->adhar_card_no}}</label></li>
                            <li class="list-group-item"><lable>Name:  </lable> {{$documentData->adhar_name}}</li>
                            <li class="list-group-item"><lable>Date of Birth </lable> :{{$documentData->adhar_dob}}</li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card" style="">
                    @if ($documentData->adhar_card_back_file == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                <img class="card-img-top" height="200" src="{{ asset( $documentData->adhar_card_back_file) }}" alt="Card image cap">

                                @endif
                        <div class="card-body">
                            <h5 class="card-title">Aadhar card Back</h5>

                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><lable>Aadhar no:  </lable> <label>{{$documentData->adhar_card_no}}</label></li>
                            <li class="list-group-item"><lable>Name:  </lable> {{$documentData->adhar_name}}</li>
                            <li class="list-group-item"><lable>Date of Birth </lable> :{{$documentData->adhar_dob}}</li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>

@if($documentData->user->role_id == 2 || $documentData->user->role_id == 3 || $documentData->user->role_id == 7 || $documentData->user->role_id == 8)


        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                <h3>PAN Card Details  </h3>
                </div>
            <div class="col-md-6">

                <?php if( $documentData->is_pan_verify != 1 ) { ?>
                <a href="{{ url('admin/acceptPan') }}/{{ $documentData->id }}/1" class="btn btn-primary">Accept PAN</a>
            <?php }  else { ?>

                <a href="{{ url('admin/acceptPan') }}/{{ $documentData->id }}/2" class="btn btn-danger">Reject</a>

            <?php } ?>
            </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">

                    <div class="card" style="">
                    @if ($documentData->pancard_file == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                <img class="card-img-top" height="200" src="{{ asset( $documentData->pancard_file) }}" alt="Card image cap">

                                @endif
                        <div class="card-body">
                            <h5 class="card-title">PAN Card</h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>PAN No :  </lable> <label>{{$documentData->pancard_no}}</label></li>
                            <li class="list-group-item"><lable>Name :  </lable> {{$documentData->pancard_name}}</li>
                            <li class="list-group-item"><lable>Date of Birth :  </lable> {{$documentData->pancard_name}}</li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>


        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
            <h3>BRN Details: </h3>
                </div>
                <div class="col-md-6">
            <?php if( $documentData->is_brn_verify != 1 ) { ?>
                <a href="{{ url('admin/acceptBrn') }}/{{ $documentData->id }}/1" class="btn btn-primary">Accept BRN</a>
            <?php }  else { ?>

                <a href="{{ url('admin/acceptBrn') }}/{{ $documentData->id }}/2" class="btn btn-danger">Reject</a>

            <?php } ?>
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-3">

                    <div class="card" style="">
                    @if ($documentData->brn_file == '')
                                <img src="{{ asset('public/assets/images/notfound.png') }}" height="200px" >

                                @else
                                <img class="card-img-top" height="200" src="{{ asset( $documentData->brn_file) }}" alt="Card image cap">

                                @endif
                        <div class="card-body">
                            <h5 class="card-title">BRN</h5>
                        </div>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><lable>BRN No :  </lable> <label>{{$documentData->brn_no}}</label></li>
                            <li class="list-group-item"><lable>Name :  </lable> {{$documentData->brn_name}}</li>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer">  </div>
    </div>
@endif
</section>



@endsection
