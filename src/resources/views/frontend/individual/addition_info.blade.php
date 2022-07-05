@extends('layouts.header')
@section('title', 'Additional Information | UNDP') 
@section('content')
<section class="edit-profile">
  <div class="container">
  	<div class="additional-info">
  		<h5 class="heaing">{{Session::get('weblangauge') == 'kn' ? 'अतिरिक्त जानकारी':'Additional Information'}}</h5>
  	</div>
    <div >
      <form method="POST" action="{{url('save-additional-info')}}">
      @csrf
      @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
      @endif
      <?php //echo "<pre>"; print_r($user_info);?>
        <div class="additional-information">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group form-group-2">
                <label class="lebul-style">{{Session::get('weblangauge') == 'kn' ? 'शैक्षिक योग्यता *':'Educational Qualification *'}}</label>
                <select class="form-control" name="education_qualification">
                  
                  @foreach ($drop_down_list as $edu)
                    @if ($edu->type == 'edu' )
                        <option value="{{$edu->id}}" <?php if($user_info && $user_info->education_qualification == $edu->id){ echo 'selected'; } ?>>{{$edu->name}}</option>
                    @endif                      
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-2">
                <label class="lebul-style">{{Session::get('weblangauge') == 'kn' ? 'जाति *':'Caste *'}}</label>
                <select class="form-control" name="caste">
                  @foreach ($drop_down_list as $caste)
                    @if ($caste->type == 'cast' )
                        <option value="{{$caste->id}}" <?php if($user_info && $user_info->caste == $caste->id){ echo 'selected'; } ?>>{{$caste->name}}</option>
                    @endif                      
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="check-box-wrap">
                <h6 class="form-title"> {{Session::get('weblangauge') == 'kn' ? 'क्या आप सामाजिक आर्थिक जाति जनगणना (एसईसीसी) के तहत सूचीबद्ध हैं?':'Are you listed under Socio economic caste census (SECC)?'}}</h6>
                <div class="row">
                  <div class="col-md-6">
                    <div class="box-wrap">
                      <input type="radio" id="redio1" name="secc" value="1" <?php if ($user_info && $user_info->secc == '1'){ echo 'checked'; } ?>>
                      <label for="redio1">{{Session::get('weblangauge') == 'kn' ? 'हां':'Yes'}}</label>
                    </div>
                  </div>
                  <div class="col-md-6">                    
                    <div class="box-wrap">
                      <input type="radio" id="redio2" name="secc" value="2" <?php if ($user_info && $user_info->secc == '2'){ echo 'checked'; } ?>>
                      <label for="redio2">{{Session::get('weblangauge') == 'kn' ? 'नहीं':'No'}}</label>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="check-box-wrap">
                <h6 class="form-title">{{Session::get('weblangauge') == 'kn' ? 'क्या आप किसी एसएचजी से संबंधित हैं)?':'Do you belong to any SHG(s)? *'}}</h6>
                <div class="row">
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio3" name="belong_to_shg" value="1" <?php if ($user_info && $user_info->belong_to_shg == '1'){ echo 'checked'; } ?> required>
                      <label for="redio3">{{Session::get('weblangauge') == 'kn' ? 'हां':'Yes'}}</label>
                    </div>
                  </div>
                  <div class="col-md-4">                    
                    <div class="box-wrap">
                      <input type="radio" id="redio4" name="belong_to_shg" value="2" <?php if ($user_info && $user_info->belong_to_shg == '2'){ echo 'checked'; } ?> required>
                      <label for="redio4">{{Session::get('weblangauge') == 'kn' ? 'नहीं':'No'}}</label>
                    </div>                    
                  </div>
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio5" name="belong_to_shg" value="3" <?php if ($user_info && $user_info->belong_to_shg == '3'){ echo 'checked'; } ?> required>
                      <label for="redio5">{{Session::get('weblangauge') == 'kn' ? 'शायद | पक्का नहीं':'Maybe | Not sure'}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="check-box-wrap">
                <h6 class="form-title">{{Session::get('weblangauge') == 'kn' ? 'आप किस प्रकार की आजीविका में हैं?':'What type of livelihood are you into? *'}}</h6>
                <div class="row">
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio6" class="livelihood" name="livelihood" value="farm" <?php if ($user_info && $user_info->livelihood == 'farm'){ echo 'checked'; } ?> required>
                      <label for="redio6">{{Session::get('weblangauge') == 'kn' ? 'खेत':'Farm'}}</label>
                    </div>
                  </div>
                  <div class="col-md-4">                    
                    <div class="box-wrap">
                      <input type="radio" id="redio7" class="livelihood" name="livelihood" value="non-farm" <?php if ($user_info && $user_info->livelihood == 'non-farm'){ echo 'checked'; } ?> required>
                      <label for="redio7">{{Session::get('weblangauge') == 'kn' ? 'खेत':'Non-farm'}}</label>
                    </div>                    
	                  </div>                  
                </div>
                <div class="ownership <?php if ($user_info && $user_info->livelihood == 'non-farm'){ echo 'd-none'; } ?>">
                	<h6 class="form-title">What is the ownership of your farming land? *</h6>
                	<div class="row">
                  <div class="col-md-6">
                    <div class="box-wrap">
                      <input type="radio" id="redio8" name="land_ownership" class="form-check-input" value="owned" <?php if ($user_info && $user_info->land_ownership == 'owned'){ echo 'checked'; } ?> >
                      <label for="redio8" class="form-check-label">Owned</label>
                    </div>
                  </div>
                  <div class="col-md-6">                    
                    <div class="box-wrap">
                      <input type="radio" id="redio9" name="land_ownership" class="form-check-input" value="leased" <?php if ($user_info && $user_info->land_ownership == 'leased'){ echo 'checked'; } ?> >
                      <label for="redio9" class="form-check-label">Leased</label>
                    </div>                    
                  </div>                  
                  <div class="col-md-12">                    
                    <div class="form-group form-group-2 mt-3 mb-0">
			                <label class="lebul-style">Total Cultivable land (in nali) *</label>
			                <input type="text" name="cultivable_land" value="<?php if ($user_info && $user_info->cultivable_land){ echo $user_info->cultivable_land; } ?>" class="form-control" >
			              </div>                  
                  </div>                  
                </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="check-box-wrap">
                <h6 class="form-title">{{Session::get('weblangauge') == 'kn' ? 'आजीविका गतिविधि से आपकी वार्षिक आय क्या है ?':'What is your annual Income from the livelihood activity?'}}</h6>
                <div class="row">
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio10" name="annual_income" value="0 - 50,000" <?php if ($user_info && $user_info->annual_income == '0 - 50,000'){ echo 'checked'; } ?> >
                      <label for="redio10">0 - 50,000</label>
                    </div>
                  </div>
                  <div class="col-md-4">                    
                    <div class="box-wrap">
                      <input type="radio" id="redio11" name="annual_income" value="50,001 - 1,00,000"<?php if ($user_info && $user_info->annual_income == "50,001 - 1,00,000"){ echo 'checked'; } ?> >
                      <label for="redio11">50,001 - 1,00,000</label>
                    </div>                    
                  </div>
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio12" name="annual_income" value="100,001 - 2,00,000" <?php if ($user_info && $user_info->annual_income == "100,001 - 2,00,000"){ echo 'checked'; } ?> >
                      <label for="redio12">1,00,001 - 2,00,000</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio13" name="annual_income" value="200,001 - 5,00,000" <?php if ($user_info && $user_info->annual_income == "200,001 - 5,00,000"){ echo 'checked'; } ?> >
                      <label for="redio13">2,00,001 - 5,00,000</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="box-wrap">
                      <input type="radio" id="redio14" name="annual_income" value="Above 5,00,000" <?php if ($user_info && $user_info->annual_income == "Above 5,00,000"){ echo 'checked'; } ?> >
                      <label for="redio14">{{Session::get('weblangauge') == 'kn' ? '5,00,000 से ऊपर':'Above 5,00,000'}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-2">
                <label class="lebul-style">{{Session::get('weblangauge') == 'kn' ? 'उम्र *':'Age *'}}</label>
                <input type="date" name="dob" class="form-control" value="<?php if ($user_info && $user_info->dob){ echo $user_info->dob; } ?>" required>
              </div>
            </div>
            <div class="col-md-12 text-center">
            	<div class="btn-wrap">
            	{{-- 	<a class="btn clickme them-btn" href="javascript:void(0)">Save Changes</a> --}}
                <button type="submit" class="btn clickme them-btn" >{{Session::get('weblangauge') == 'kn' ? 'सेव करे':'Save Changes'}}</button>
            	</div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {

  $('.livelihood').click(function(){
   
    let radio_value = $(this).val();
     console.log(radio_value);
    if(radio_value == 'non-farm'){
      $('.ownership').addClass('d-none');
    } else {
      $('.ownership').removeClass('d-none');
    }
  });

});
</script>
@endsection
