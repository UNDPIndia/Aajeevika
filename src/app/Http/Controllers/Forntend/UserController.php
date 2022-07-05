<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Otphistory;
use App\Role;
use App\Address;
use App\Location;
use App\Rating;
use App\IndRating;
use URL;
use File;
use App\Reason;
use App\Pincode;
use DB;

use App\Country;
use App\State;
use App\City;
use App\Documents;
use App\ProductMaster;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Category;
use App\ProductTemplate;
use App\Material;
use App\Rules\MatchOldPassword;
// use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    private $headers;
    public function __construct()
    {
        $this->headers = [
            'Content-Type' => 'application/json',
            'app-key' => 'laravelUNDP',

        ];

        $this->middleware('auth');
    }

    public function index()
    {
    }

    public function viewProfile()
    {
        $user = Auth::user();
        // dd('sdf');
        Auth::user()->role_id;
        Auth::user()->country;
        Auth::user()->state;
        Auth::user()->city;
        Auth::user()->district;
        Auth::user()->address_registerd;
        Auth::user()->address_personal;
        Auth::user()->document;
        Auth::user()->address;


        // Get User Address
        $personal   = null;
        $office     = null;
        $registered = null;

        if ($user->role_id == 1) {
            $personal = Address::where(['user_id' => $user->id, 'address_type' => 'personal'])->first();

            if ($personal) {
                $countryName = Country::where('id', $personal->country)->select('id', 'name')->first();
                $stateName   = State::where('id', $personal->state)->select('id', 'name')->first();
                $district    = City::where('id', $personal->district)->select('id', 'name')->first();
                $personal = [
                    'id'               => $personal->id,
                    'address_line_one' => $personal->address_line_one,
                    'address_line_two' => $personal->address_line_two,
                    'pincode'          => $personal->pincode,
                    'countryId'        => $countryName->id,
                    'stateId'          => $stateName->id,
                    'districtId'       => $district->id,
                    'country'          => $countryName->name,
                    'state'            => $stateName->name,
                    'district'         => $district->name
                ];
            }
        } else {
            $registered = Address::where(['user_id' => $user->id, 'address_type' => 'registered'])->first();

            if ($user->is_document_added == 1) {
                $documentstatus = Documents::where('user_id', $user->id)->select('is_adhar_verify', 'is_pan_verify', 'is_brn_verify')->first();

                $user['is_adhar_verify'] = $documentstatus->is_adhar_verify;
                // $user['is_pan_verify']   = $documentstatus->is_pan_verify;
                // $user['is_brn_verify']   = $documentstatus->is_brn_verify;
            }

            if ($registered) {
                $countryName = Country::where('id', $registered->country)->select('id', 'name')->first();
                $stateName   = State::where('id', $registered->state)->select('id', 'name')->first();
                $district    = City::where('id', $registered->district)->select('id', 'name')->first();
                $registered = [
                    'id'               => $registered->id,
                    'address_line_one' => $registered->address_line_one,
                    'address_line_two' => $registered->address_line_two,
                    'pincode'          => $registered->pincode,
                    'countryId'        => $countryName->id,
                    'stateId'          => $stateName->id,
                    'districtId'       => $district->id,
                    'country'          => $countryName->name,
                    'state'            => $stateName->name,
                    'district'         => $district->name
                ];
            }

            //  Add Personal address in profile while shgartisan login on user app

            $personal = Address::where(['user_id' => $user->id, 'address_type' => 'personal'])->first();

            if ($personal) {
                $countryName = Country::where('id', $personal->country)->select('id', 'name')->first();
                $stateName   = State::where('id', $personal->state)->select('id', 'name')->first();
                $district    = City::where('id', $personal->district)->select('id', 'name')->first();
                $personal = [
                    'id'               => $personal->id,
                    'address_line_one' => $personal->address_line_one,
                    'address_line_two' => $personal->address_line_two,
                    'pincode'          => $personal->pincode,
                    'countryId'        => $countryName->id,
                    'stateId'          => $stateName->id,
                    'districtId'       => $district->id,
                    'country'          => $countryName->name,
                    'state'            => $stateName->name,
                    'district'         => $district->name
                ];
            }
        }
        if($user->role_id == 9){
            $ratingCount = IndRating::where('user_id', $user->id)->count();
            $ratingStarAvg = DB::table('ind_ratings')->where('user_id', $user->id)->avg('rating');
            $rating_avg = number_format((float)$ratingStarAvg, 1, '.', '');
        }else{
            $ratingCount = Rating::where('user_id', $user->id)->count();
            $ratingStarAvg = DB::table('ratings')->where('user_id', $user->id)->avg('rating');
            $rating_avg = number_format((float)$ratingStarAvg, 1, '.', '');
        }
        

        $address = [
            'personal'   => $personal,
            'office'     => $office,
            'registered' => $registered
        ];

        return view('frontend.user.profile', ['address'=>$address,'reviewCount' => $ratingCount,'ratingAvgStar' => $rating_avg]);
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $query = ['name'=> $request->name, 'email' => $request->email];
        if ($user->role_id == 1 && !empty($request->email) ) {
             $rules['email'] = 'required|unique:users,email,' . $user->id;
             $validator = Validator::make($request->all(), $rules);
             if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
             }
         }

        if (($user->role_id != 1) ) {
           // $rules['title'] = 'required';
            $rules['email'] = 'required|unique:users,email,' . $user->id;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //$query['title'] = $request->title;
        }

        $updateuser = User::where('id', $user->id)->update($query);
        return redirect()->back()->with('message', 'Profile Successfully Updated.')->withInput();
    }

    public function deleteprofile(Request $request)
    {
        $user = Auth::user();

        // $rules = [
        //     'reason' => 'required'
        // ];

        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     $response = array('status' => false , 'statusCode' =>400);
        //     $response['message'] = $validator->messages()->first();
        //     return response()->json($response);
        // }

        $deleteUser = User::where(['id' => $user->id, 'isActive' => 1])->update([ 'isActive' => 0 ]);

        $addreason = Reason::create(['user_id' => $user->id, 'reason' => $request->reason]);

        $product = ProductMaster::where(['user_id' => $user->id, 'is_active' => 1, 'is_draft' => 0])->get();

        if (count($product) > 0) {
            $deleteProduct = ProductMaster::where(['user_id' => $user->id, 'is_active' => 1, 'is_draft' => 0])->update(['is_active' => 0]);
        }

        Auth::logout();

        return redirect('/');
    }

  


    public function changemobileno(Request $request)
    {
        return view('frontend.user.change_mobile');
    }


    public function changepassword(Request $request)
    {
        return view('frontend.user.change_pass');
    }


    public function updatechnagepassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required|confirmed|min:8',
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ]);
    
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

        //return redirect('profile/home');
        return redirect()->back()->with('success', "Password Updated sucessfully.");
    }
    



     

    public function updatemobileno(Request $request)
    {
        $rules = [
            'mobile'=>'required|min:10|max:10|unique:users'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $otp = rand(1111, 9999);
        $otp = 1234;
        $this->sendotp($request->mobile, $otp);
        $otpUpdateStatus = Otphistory::where(['mobile_no'=> $request->mobile ])->update(['status' => 0]);
        $otpStatus = Otphistory::create(['mobile_no' => $request->mobile, 'otp' => $otp ]);
        $encrypted = Crypt::encryptString($request->mobile);

        return redirect('/verifyotp/'.$encrypted.'?type=change');
    }


    /**
         * Send OTP
         */

    public function sendotp($mobile, $otp)
    {
        $username="Mobile_1-KSLKAR";
        $password="kslkar@1234";
        $senderid="KSLKAR";
        $message="Please verify your mobile using this OTP " .$otp;
        // $messageUnicode="à¤®à¥‹à¤¬à¤¾à¤‡à¤²à¤¸à¥‡à¤µà¤¾à¤®à¥‡à¤‚à¤†à¤ªà¤•à¤¾à¤¸à¥à¤µà¤¾à¤—à¤¤à¤¹à¥ˆ "; //message content in unicode
        $mobileno = $mobile; //if single sms need to be send use mobileno keyword
        // $mobileNos= "9587777762,8766068415"; //if bulk sms need to send use mobileNos as keyword and mobile number seperated by commas as value
        $deptSecureKey= "b36befee-c007-4749-b6da-d8a0d6ca5e41"; //departsecure key for encryption of message...
        $encryp_password=sha1(trim($password));


        $key=hash('sha512', trim($username).trim($senderid).trim($message).trim($deptSecureKey));

        $url = "https://msdgweb.mgov.gov.in/esms/sendsmsrequest";

        $data = array(
            "username"        => trim($username),
            "password"        => trim($encryp_password),
            "senderid"        => trim($senderid),
            "content"         => trim($message),
            "smsservicetype"  =>"otpmsg",
            "mobileno"        =>trim($mobileno),
            "key"             => trim($key)
         );

        $fields = '';

        foreach ($data as $key => $value) {
            $fields .= $key . '=' . urlencode($value) . '&';
        }
        rtrim($fields, '&');
        $post = curl_init();
        //curl_setopt($post, CURLOPT_SSLVERSION, 5); // uncomment for systems supporting TLSv1.1 only
         curl_setopt($post, CURLOPT_SSLVERSION, 6); // use for systems supporting TLSv1.2 or comment the line
         curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post); //result from mobile seva server
        //  echo $result; //output from server displayed
        curl_close($post);
    }

    public function add_document()
    {
        $user = Auth::user();
        $useraddress = DB::table('addresses')
                            ->where('addresses.user_id', $user->id)
                            ->join('countries', 'countries.id', '=', 'addresses.country')
                            ->join('states', 'states.id', '=', 'addresses.state')
                            ->join('cities', 'cities.id', '=', 'addresses.district')
                            ->select('addresses.*', 'countries.name as country', 'states.name as state', 'cities.name as district')
                            ->first();
        //echo "<pre>"; print_r($useraddress); die;
        return view('frontend.user.add_document',['useraddress'=> $useraddress]);
    }
    public function add_document_update(Request $request)
    {
        //return $request;
        $user = Auth::user();
        $roleId = $user->role_id;
        if ($roleId == 2 || $roleId == 3 || $roleId == 7 || $roleId == 8) {
            $validator = Validator::make($request->all(), [
                'adhar_card_no'         => 'nullable|digits:12',
                'adhar_card_front_file' => 'nullable|mimes:JFIF,jfif,JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'adhar_card_back_file'  => 'nullable|mimes:JFIF,jfif,JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'pancard_no'         => 'nullable|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
                'pancard_file'       => 'nullable|mimes:JFIF,jfif,JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'brn_no'             => 'nullable|digits:14',
                'brn_file'           => 'nullable|mimes:JFIF,jfif,JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',

                'address_line_one_registered' => 'required',
                'pincode_registered'          => 'required',
                'country_registered'          => 'required',
                'state_registered'            => 'required',
                'district_registered'         => 'required',
                'block'                       => 'required',
            ]);

            if ($validator->fails()) {
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator->messages()->first());
                }
            }
        }

        $adhar_card_user_image = "";
        $adhar_card_user_back_image = "";
        $pan_card_user_image = "";
        $brn_card_user_image = "";
        // Create Folder for Document Adhar Card
        if($request->hasFile('adhar_card_front_file')) {
            $adhar_card_file = $request->file('adhar_card_front_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $adhar_card_image = date('YmdHis') . "adhar." . $adhar_card_file->getClientOriginalExtension();
            $aa = $adhar_card_file->move($folder, $adhar_card_image);

            $adhar_card_image_name = $adhar_card_image;
            $adhar_card_user_image = 'images/document/'.$user->id.'/'.$adhar_card_image_name;
        }

        // Create Folder for Document Back Side Adhar Card
        if($request->hasFile('adhar_card_back_file')) {
            $adhar_card_back_file = $request->file('adhar_card_back_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $adhar_card_back_image = date('YmdHis') . "adharbackside." . $adhar_card_file->getClientOriginalExtension();
            $aa = $adhar_card_back_file->move($folder, $adhar_card_back_image);

            $adhar_card_back_image_name = $adhar_card_back_image;
            $adhar_card_user_back_image = 'images/document/'.$user->id.'/'.$adhar_card_back_image_name;
        }

        // Create Folder for Document Pan Card
        if ($roleId == 2 || $roleId == 3 || $roleId == 7 || $roleId == 8) {

            if($request->hasFile('pancard_file')) {
                $pancard_file = $request->file('pancard_file');
                $folder = public_path('images/document/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $pan_card_image = date('YmdHis') . "pancard." . $pancard_file->getClientOriginalExtension();
                $ab = $pancard_file->move($folder, $pan_card_image);

                $pan_card_image_name = $pan_card_image;
                $pan_card_user_image = 'images/document/'.$user->id.'/'.$pan_card_image_name;
            }

            // Create Folder for Document BRN Card
            if($request->hasFile('brn_file')) {
                $brn_file = $request->file('brn_file');
                $folder = public_path('images/document/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $brn_image = date('YmdHis') . "brn." . $brn_file->getClientOriginalExtension();
                $ac = $brn_file->move($folder, $brn_image);

                $brn_card_image_name = $brn_image;
                $brn_card_user_image = 'images/document/'.$user->id.'/'.$brn_card_image_name;
            }
        }

        $latlogs = Pincode::select('lat', 'log')->where(['pin_code'=> $request->pincode_registered ])->first();
        $updateDocument = [
            'user_id'            => $user->id,
            'adhar_card_no'      => $request->adhar_card_no,
            'adhar_name'         => $request->adhar_name,
            'adhar_card_front_file'    => $adhar_card_user_image,
            'adhar_card_back_file'     => $adhar_card_user_back_image,
            'adhar_dob'          => $request->adhar_dob,

        ];
        // Document Array for SHG

        if ($roleId == 2 || $roleId == 3 || $roleId == 7 || $roleId == 8) {
            $updateDocument = [
                'user_id'            => $user->id,
                'adhar_card_no'      => $request->adhar_card_no,
                'adhar_name'         => $request->adhar_name,
                'adhar_card_front_file'    => $adhar_card_user_image,
                'adhar_card_back_file'     => $adhar_card_user_back_image,
                'adhar_dob'          => $request->adhar_dob,
                'pancard_name'       => $request->pancard_name,
                'pancard_no'         => $request->pancard_no,
                'pancard_file'       => $pan_card_user_image,
                'pancard_dob'        => $request->pancard_dob,
                'brn_no'             => $request->brn_no,
                'brn_name'           => $request->brn_name,
                'brn_file'           => $brn_card_user_image,

            ];
        }




        $addDocument = Documents::create($updateDocument);

        // Office Address Array for SHG

        if ($roleId == 3) {
            $shgofficeaddress = [
                'user_id'          => $user->id,
                'user_role_id'     => $roleId,
                'address_line_one' => $request->address_line_one_office,
                'address_line_two' => $request->address_line_two_office,
                'pincode'          => $request->pincode_office,
                'country'          => $request->country_office,
                'state'            => $request->state_office,
                'district'         => $request->district_office,
                'address_type'     => 'office',
                'block'            => $request->block,
            ];
            //$addshgofficeaddress = Address::create($shgofficeaddress);
        }
        $addr_type = "registered";
        if ($roleId == 1) {
            $addr_type = "personal";
        }

        // Registered Address Array for SHG
        $shgregsiteraddress = [
            'user_id'          => $user->id,
            'user_role_id'     => $roleId,
            'address_line_one' => $request->address_line_one_registered,
            'address_line_two' => $request->address_line_two_registered,
            'pincode'          => $request->pincode_registered,
            'country'          => $request->country_registered,
            'state'            => $request->state_registered,
            'district'         => $request->district_registered,
            'address_type'     => $addr_type,
            'block'            => $request->block,
        ];
        $addshgregsiteraddress = Address::where('user_id',$user->id)->update($shgregsiteraddress);

        $checkCondition = $addshgregsiteraddress && $addDocument;
        if ($roleId == 2 || $roleId == 3 || $roleId == 7 || $roleId == 8) {
            $checkCondition = ($addshgregsiteraddress && $addDocument);
        }
        if ($checkCondition) {
            $addLocation = Location::create([
                'user_id' => $user->id,
                'lat' => $latlogs ? $latlogs->lat : '0',
                'log' => $latlogs ? $latlogs->log : '0',
            ]);
            
            $userDocumentUpdate = User::where(['id' => $user->id])->update(['is_document_added' => 1, 'is_document_verified' => 1,'is_address_added' => 1,'district'=>$request->district_registered,'city_id'=>$request->district_registered,'block'=>$request->block]);
            //$useraddressUpdate = User::where(['id' => $user->id])->update(['is_address_added' => 1]);
            
            // Update role id
            //$updaterole     = User::where('id', $user->id)->update(['role_id' => $user->role_id]);
            $queryStatus    = "Successfuly document uploaded and adress added.";
            $statusCode     = 200;
            $status         = true;
            $response       = array('status' => $status , 'statusCode' =>$statusCode, 'message'=> $queryStatus );
            $followuplink = session()->get('url.intended');
            if ($followuplink == "") {
                return redirect('/');
            } else {
                return redirect($followuplink);
            }


            //return redirect('/');
        }
    }


    public function updatedoc($type)
    {
        return view('frontend.user.udpatedoc', ['type'=>$type]);
    }
    public function updatedoc_update(Request $request, $type)
    {
        //echo $type;
        $user = Auth::user();
        if ($type == 'aadhar') {
            $rules = [
                'adhar_card_no'      => 'required',
                'adhar_name'         => 'required',
                'adhar_card_front_file'    => 'required|mimes:JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'adhar_card_back_file'    => 'required|mimes:JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'adhar_dob'          => 'required',
            ];
        }
        if ($type == 'pan') {
            $rules = [
                'pancard_name'       => 'required',
                'pancard_no'         => 'required',
                'pancard_file'       => 'required|mimes:JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
                'pancard_dob'        => 'required',
            ];
        }
        if ($type == 'brn') {
            $rules = [
                'brn_no'             => 'required',
                'brn_name'           => 'required',
                'brn_file'           => 'required|mimes:JPEG,JPG,jpeg,jpg,png,gif|required|max:10000',
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput()
            ->withErrors($validator->messages()->first());
        }

        if ($type == 'aadhar') {
            // Create Folder for Document Adhar Card

            $adhar_card_file = $request->file('adhar_card_front_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $adhar_card_image = date('YmdHis') . "adhar." . $adhar_card_file->getClientOriginalExtension();
            $aa = $adhar_card_file->move($folder, $adhar_card_image);

            $adhar_card_image_name = $adhar_card_image;
            $adhar_card_user_image = 'images/document/'.$user->id.'/'.$adhar_card_image_name;

            // Create Folder for Document Back Side Adhar Card

            $adhar_card_back_file = $request->file('adhar_card_back_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $adhar_card_back_image = date('YmdHis') . "adharbackside." . $adhar_card_file->getClientOriginalExtension();
            $aa = $adhar_card_back_file->move($folder, $adhar_card_back_image);

            $adhar_card_back_image_name = $adhar_card_back_image;
            $adhar_card_user_back_image = 'images/document/'.$user->id.'/'.$adhar_card_back_image_name;

            $updateDocument = [
                'adhar_card_no'      => $request->adhar_card_no,
                'adhar_name'         => $request->adhar_name,
                'adhar_card_front_file'    => $adhar_card_user_image,
                'adhar_card_back_file'     => $adhar_card_user_back_image,
                'adhar_dob'          => $request->adhar_dob,
                'is_adhar_verify'          => 0,
            ];

            $updateDocument = Documents::where('user_id', $user->id)->update($updateDocument);

            if ($updateDocument) {
                return redirect('/profile')->with('message', 'Aadhar Card Updated ');
            }
        }

        if ($type == 'pan') {
            $pancard_file = $request->file('pancard_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $pan_card_image = date('YmdHis') . "pancard." . $pancard_file->getClientOriginalExtension();
            $ab = $pancard_file->move($folder, $pan_card_image);

            $pan_card_image_name = $pan_card_image;
            $pan_card_user_image = 'images/document/'.$user->id.'/'.$pan_card_image_name;

            $pandata = [
                'pancard_name'       => $request->pancard_name,
                'pancard_no'         => $request->pancard_no,
                'pancard_file'       => $pan_card_user_image,
                'pancard_dob'        => $request->pancard_dob,
            ];

            $updateDocument = Documents::where('user_id', $user->id)->update($pandata);

            if ($updateDocument) {
                return redirect('/profile')->with('message', 'PAN Card Updated ');
            }
        }
        if ($type == 'brn') {
            $brn_file = $request->file('brn_file');
            $folder = public_path('images/document/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $brn_image = date('YmdHis') . "brn." . $brn_file->getClientOriginalExtension();
            $ac = $brn_file->move($folder, $brn_image);

            $brn_card_image_name = $brn_image;
            $brn_card_user_image = 'images/document/'.$user->id.'/'.$brn_card_image_name;

            $updatebrn = [
                'brn_no'             => $request->brn_no,
                'brn_name'           => $request->brn_name,
                'brn_file'           => $brn_card_user_image,
            ];

            $updateDocument = Documents::where('user_id', $user->id)->update($updatebrn);

            if ($updateDocument) {
                return redirect('/profile')->with('message', 'BRN Updated ');
            }
        }
    }



    public function getshgartisanhome(Request $request)
    {
        $user = Auth::user();
        $language       = $request->session()->get('weblangauge');
        $catname = 'name_en  as name';
        $productname = 'localname_en as name';
        $templatename = 'name_en as name';

        if ($language == 'kn') {
            $catname = 'name_kn  as name';
            $productname = 'localname_kn  as name';
            $templatename = 'name_kn as name';
        }

        $userdata = User::where('id', $user->id)->select('id', 'name', 'title', 'profileImage', 'email', 'mobile')->first();


        $categoryIds = ProductMaster::where(['user_id' => $user->id, 'is_active' => 1, 'is_draft' => 0])->distinct('categoryId')->select('categoryId')->get();
        // $categoryIds = ProductMaster::where(['user_id' => $request->artisanshgid, 'is_active' => 1, 'is_draft' => 0])->groupBy('categoryId')->select('categoryId')->get();

        $catArr = [];

        foreach ($categoryIds as $cat) {
            $catArr[] = $cat->categoryId;
        }

        $categoryDetail = Category::wherein('id', $catArr)->select('id', $catname, 'slug')->get();

        $allProduct = [];

        foreach ($categoryDetail as $key=> $cat) {
            $subcategoryId = Category::where('parent_id', $cat->id)->select('id', $catname, 'slug')->get();
            $sub = [];
            foreach ($subcategoryId as $subcat) {
                $products = ProductMaster::where('subcategoryId', $subcat->id)->where('is_active', 1)->where('is_draft', 0)->where('user_id', $user->id)->with('template:id,'.$templatename,'user:id,organization_name')->select($productname, 'price', 'id', 'image_1', 'template_id','user_id')->take(4)->get();

                if (count($products) > 0) {
                    $sub[] = [
                        'subCategoryId'     => $subcat->id,
                        'subCategoryName'   => $subcat->name,
                        'subCategoryslug' => $subcat->slug,
                        'products'          => $products
                    ];
                }
            }


            $allProduct[$key]['subCategories'] = $sub;

            $allProduct[$key]['categoryId'] = $cat->id;
            $allProduct[$key]['categoryName'] = $cat->name;
            $allProduct[$key]['categoryName'] = $cat->name;

            $allProduct[$key]['categoryslug'] = $cat->slug;
            //$allProduct[$key]['subCategoryslug'] = $subcategoryId->slug;


            //$allProduct[$key]['subCategoryId'] = $subcategoryId->id;
            //           $allProduct[$key]['subCategoryName'] = $subcategoryId->name;

            $allProduct[$key]['products'] = $products;
        }

        $data = ['user' => $userdata,'allProduct'=>$allProduct];
        return view('frontend.user.home', ['alldetail'=>$data]);
    }

    public function draft(Request $request)
    {
        $user = Auth::user();
        $language = $request->session()->get('weblangauge');

        $descriptionname = 'des_en  as description';
        $productname = 'localname_en as name';

        if ($language == 'kn') {
            $descriptionname = 'des_kn  as description';
            $productname = 'localname_kn  as name';
        }

        $draftproduct = ProductMaster::with('template')->where(['user_id' => $user->id, 'is_draft' => 1])->first();


        return view('frontend.user.draft', ['draftproduct'=>$draftproduct]);
    }

    public function changeprofileimage()
    {
        return view('frontend.user.changeimage');
    }

    public function updateprofileimage(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'profileimage' => 'required|max:30000|mimes:JPEG,JPG,jpg,jpeg,png,svg'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = array('status' => false , 'statusCode' => 400 );
            $response['message'] = $validator->messages()->first();
            return redirect()->back()->withErrors($validator);
        }

        /** Upload Images */

        $image_file_1 = $request->file('profileimage');
        $folder = public_path('images/users/' . $user->id . '/');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder, 0775, true, true);
        }

        $image_file_1_image = date('YmdHis') . rand(111, 9999). "userimage." . $image_file_1->getClientOriginalExtension();
        $aa = $image_file_1->move($folder, $image_file_1_image);

        $image_file_1_image_name = $image_file_1_image;
        $image_file_1_image = 'images/users/'.$user->id.'/'.$image_file_1_image_name;


        $updateuser = User::where('id', $user->id)->update(['profileImage'=> $image_file_1_image]);


        return redirect('profile')->with('message', 'Profile Image Updated.');
    }


    public function changeaddress(Request $request)
    {
        $user = Auth::user();
        $address_registerd = Auth::user()->address_registerd;
        $address_personal = Auth::user()->address_personal;
        $useraddress = DB::table('addresses')
                            ->where('addresses.user_id', $user->id)
                            ->join('countries', 'countries.id', '=', 'addresses.country')
                            ->join('states', 'states.id', '=', 'addresses.state')
                            ->join('cities', 'cities.id', '=', 'addresses.district')
                            ->select('addresses.*', 'countries.name as country', 'states.name as state', 'cities.name as district')
                            ->first();
        //echo "<pre>"; print_r($useraddress);die;
        return view('frontend.user.changeaddress',['useraddress' => $useraddress]);
    }

    public function updateaddress(Request $request)
    {
        $user = Auth::user();
        $messages = [
            'required' => 'The :attribute field is required.',
            'address_line_one.required' => 'Address is required.'
        ];

        $validator = Validator::make($request->all(), [
                'address_line_one'      => 'required',
                //'address_line_two'      => 'required_without:address_line_one',
                'pincode'               => 'required',
                'country'               => 'required',
                'state'                 => 'required',
                'district'              => 'required',
                //'village'               => 'required',
                //'block'                 => 'required'
            //'address_type'          => 'required|in:personal,registered,office'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $requestData = $request->all();

        $requestData['user_id'] = Auth::user()->id;
        $requestData['user_role_id'] = Auth::user()->role_id;
        $requestData['address_type'] = 'registered';
        if(Auth::user()->role_id == 1){
            $requestData['address_type'] = 'personal';
        }
        
        $updateusertable = User::where('id', Auth::user()->id)->update(['country_id' => $request->country, 'state_id' => $request->state, 'district'=>$request->district, 'city_id' => $request->district,'block' => $request->block]);

        if (Auth::user()->role_id != 1) {
            $latlogs = Pincode::select('lat', 'log')->where(['pin_code'=> $request->pincode ])->first();
            $addLocation = Location::create([
            'user_id' => Auth::user()->id,
           /*  'lat' => $latlogs->lat,
            'log' => $latlogs->log, */
            'lat' => 0,
            'log' => 0,
            ]);
        }

        $is_address_added = 1;
        unset($requestData['_token']);
        unset($requestData['shgartisanId']);

        /* $useraddress = DB::table('addresses')
                            ->where('addresses.user_id', $user->id)
                            ->join('countries', 'countries.id', '=', 'addresses.country')
                            ->join('states', 'states.id', '=', 'addresses.state')
                            ->join('cities', 'cities.id', '=', 'addresses.district')
                            ->select('addresses.*', 'countries.name as country', 'states.name as state', 'cities.name as district')
                            ->first(); */
        //if(!empty($useraddress)){
            $useraddressupdate = Address::where('id', $request->id)->where('user_id', $user->id)->update($requestData);
        /* } else {
            $addaddress = Address::create($requestData);
        } */
        
        $userUPdate = User::where(['id' => Auth::user()->id])->update(['is_address_added' => $is_address_added]);
        return redirect('profile');
    }
    
}
