@extends('layouts.app')
@section('title', 'Admin User Management | UNDP')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>UNDP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active"><a href="#">Home</a></li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                <h3 class="card-title">Edit Admin User</h3>
                <!-- <a href="{{ url('admin/addAdmin User') }}" class="btn btn-outline-primary float-sm-right">Add Admin User</a> -->
            </div>
            <div class="card-body">
                <form action="{{ url('admin/editAdmin/') }}/{{ encrypt($id) }}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Name : </label>
                            <input type="text" class="form-control" name="name" id="" value="{{ $adminDetail->name }}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Email : </label>
                            <input type="text" class="form-control" name="email" id="email"
                                value="{{ $adminDetail->email }}">
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label for="">Mobile : </label>
                            <input type="text" maxlength="10" minlength="10" class="form-control" name="mobile" id=""
                                value="{{ $adminDetail->mobile }}">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label for="">Role : </label>

                            <select class="form-control roleclass" name="role_id" id="">
                                <option value="">--Select Role--</option>
                                @foreach ($roleList as $item)
                                    <option @if ($adminDetail->role_id == $item->id) selected @endif value="{{ $item->id }}">
                                        {{ $item->role_name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="row">

                        <!-- <div class="col-sm-6 form-group">
                            <label for="">State : </label>
                            <select class="form-control getdistrict" name="state_id" id="">
                                <option value="">--Select State--</option>
                                @foreach ($stateList as $item)
                                    <option @if ($adminDetail->state_id == $item->id) selected @endif value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div> -->

                        <div class="col-sm-6 form-group district">
                            <label for="">District : </label>

                            <select class="form-control" name="district" id="district">
                                <option value="">--Select District--</option>
                                @foreach ($districtList as $item)
                                    <option @if ($adminDetail->district == $item->id) selected @endif value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>


                        </div>
                        <div class="col-sm-6 form-group block_id">
                <label for="">Block * : </label>
                <select class="form-control" name="block" id="block_id">
                    <option value="">Select Block </option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}"
                        @if($block->id==$adminDetail->block)
                        selected
                        @endif 
                        >{{ $block->name }}</option>
                    @endforeach
                </select>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="">
                                <?php foreach ($allPermission as $value) { ?>
                                {{-- <tr  --}}
                                <?php //if ($value->id == 3 || $value->id == 6 || $value->id == 7) {
                                    //echo "class='districtclass'";
                                    //} else {
                                    //echo "class='stateclass'";
                                    //} 
                                    ?>
                                    {{-- > --}}
                                    <tr <?php if  ($value->id == 3 || $value->id == 20 || $value->id == 24 || $value->id == 17 || $value->id == 18 || $value->id == 25) {
                                        echo "class='districtclass'";
                                        } else {
                                        echo "class='stateclass'";
                                        } ?>>
                                    <td><label for=""><?php echo $value->permission_name; ?></label></td>
                                    <td><input class="permissionz" type="checkbox" name="permission[]"
                                            value="<?php echo $value->id; ?>" <?php if (in_array($value->id, $userPermission)) {
                                        echo 'checked';
                                        } ?> id=""></td>
                                </tr>




                                <?php } ?>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        var rooll = $('.roleclass').val();
        if (rooll == 5) {
            $('.districtclass').show();
            $('.stateclass').show();
            $('.district').hide();
                $('.block_id').hide();
                $('.state').show();
        }
        if (rooll == '') {
            $('.districtclass').show();
            $('.stateclass').show();

        }
        if (rooll == 4 || rooll == 11) {
            $('.district').show();
                $('.block_id').show();
                $('.state').show();

                $('.districtclass').show();
                $("#district").prop('required',false);
                $("#block_id").prop('required',false);
                $('.stateclass').hide();


        }

        $(".roleclass").change(function() {



            var r = confirm(
            "Selected permissions will be reset for this user, are you sure you want to continue ?");

            if (r == true) {
                var role = $(this).val();
                if (role == 5) {
                    $('.districtclass').show();
                    $('.stateclass').show();
                    $('.district').hide();
                $('.block_id').hide();
                $('.state').show();

                }
                if (role == '') {
                    $('.districtclass').show();
                    $('.stateclass').show();

                }
                if (role == 4 || role == 11) {

                    $('.district').show();
                $('.block_id').show();
                $('.state').show();

                    $('.districtclass').show();
                    $('.stateclass').hide();


                }


                $('.permissionz').each(function() {
                    $(this).removeAttr('checked');
                });
            } else {
                return false
            }





        });
        $(".getdistrict").change(function() {
            var id = $(this).val();

            $('#district').empty();
            $('#district').append(' <option value="">--Select District--</option>');
            $.ajax({
                type: 'POST',
                url: '/api/get_city',
                data: {
                    state_id: id
                },
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $.each(data.data, function(i, obj) {
                        console.log(obj.name);
                        var div_data = "<option value=" + obj.id + ">" + obj.name + "</option>";
                        $(div_data).appendTo('#district');


                    });


                }
            });
        });

    </script>
<script>
$(document).on('change','#district',function(){
    //console.log($(this).val());
    var _token = $('meta[name="csrf-token"]').attr('content');
    var city_id = $(this).val();
    $.ajax({
        type:"POST",
        url:"{{ url('admin/collection-center/blockAjax') }}",
        data:{_token,city_id},
        success:function(response)
        {
            $('#block_id').html(response);
            //alert(response);
        }
    });  
});
</script>
@endsection
