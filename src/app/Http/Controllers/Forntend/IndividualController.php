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
use App\Favorite;
use App\IndividualInterest;
use App\IndOrder;
use App\IndOrderItem;
use App\IndividualInterestList;
use App\IndCategory;
use App\IndProductMaster;
use App\IndRating;
use App\Address;
use App\Country;
use App\State;
use App\City;
use App\Faq;
use App\ChatMessage;
use App\IndAddtinaolInformation;
use App\FaqQuestion;
use App\Helpers\Helper;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;

use Session;

class IndividualController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            /* $selectInterest = false;
            if (Auth::user()->role_id == 9) {
                $checkIndividualInterest = IndividualInterest::where('user_id',$user->id)->first();
                    if ($checkIndividualInterest) {
                        $selectInterest = true;
                        //return redirect('ind-home');
                    }
                if(!$selectInterest){
                    return redirect('/add-interest');
                }
                
            } */

             return $next($request);
        });
    }

    public function index(Request $request)
    {
        $user_name = Auth::user()->name;
        $language = $request->session()->get('weblangauge');

        //$this->id = $request->user_id;
        $getMyInterest  = IndividualInterest::where('user_id',$this->id)->get();
        $interIds = [];
        $userData = [];

        foreach ($getMyInterest as $key => $value) {
            $interIds [] = $value->individual_interest_list_id;
            $getMatching = IndividualInterest::whereIn('individual_interest_list_id',$interIds)->where('user_id','!=',$this->id)->get();
            if(count($getMatching) > 0) {
                foreach($getMatching as $val){
                        $userData[] = User::select('id','name','organization_name','profileImage')->where('id',$val->user_id)->first();
                }
            }
        }

        //To get favorite list

        $favuser= Favorite::where('user_id',$this->id)->where('status',1)->get();
        $favUser =[];
        if(count($favuser) > 0){
            foreach($favuser as $fav){
                $favUser[] = User::select('id','name','organization_name','profileImage')->where('id',$fav->seller_id)->where('role_id',9)->first();
            }
        }
        $data = ['matchingUser'=>array_values(array_unique($userData)),'favUser'=> $favUser];
        //$response   = array('status' => 'true' , 'statusCode' =>200, 'message'=> $queryStatus, 'data'=>$data);
        return view('frontend.individual.ind_home', ['user_name' => $user_name, 'data'=>$data]);

    }

    public function IndOrderList(Request $request) {
        $language = $request->session()->get('weblangauge');
        $allOrder = IndOrder::with('indItems', 'getClf:id,name,email,mobile,organization_name,profileImage', 'GetIndividual:id,name,email,mobile', 'indItems.Indproduct:id,name_en')->where(['user_id'=> $this->id])->select('id','order_id_d','seller_id', 'user_id', 'message', 'id', 'otp','created_at')->latest()->get();
       return view('frontend.individual.ind_order_list', ['allOrders'=>$allOrder]);
        
    }

    public function getIndOrderDetails(Request $request, $order_id) {
        $orderId = decrypt($order_id);
        $language = $request->session()->get('weblangauge');
        $productname = 'name_en as name_en';
        if ($language == 'kn') {
            $productname = 'name_hi  as name_en';
           
        }
        $allOrder = IndOrder::with('indItems','getClf:id,name,email,mobile,organization_name,profileImage','GetIndividual:id,name,email,mobile,profileImage','indItems.Indproduct:id,'.$productname.',price_unit','clfRating','indRating')->where(['id'=> $orderId])->select('id','order_id_d','seller_id', 'user_id', 'message', 'id', 'otp','sale_date','created_at')->latest()->first();
        //echo "<pre>"; print_r($allOrder->toArray()); die;
        return view('frontend.individual.ind_order_detail', ['allOrders'=>$allOrder]);
    
    }    
    public function getInterestList(Request $request)
    {
        # code...
        try{
            $individualInterest = [];
            $language = $request->session()->get('weblangauge');
            $name = 'name_en  as name';
            if ($language == 'kn') {
                $name = 'name_hi  as name';
               
            }
            $userId = Auth::user()->id;
            $interestList =IndividualInterest::select('id','user_id','individual_interest_list_id')->where('user_id',$userId)->with('indInterest')->get();

            return view('frontend.individual.interest_list', ['interestList'=>$interestList]);
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
    }

    public function addInterestList(Request $request)
    {
        # code...
        try{
            $individualInterest = [];
            $language = $request->session()->get('weblangauge');
            $name = 'name_en  as name';
            if ($language == 'kn') {
                $name = 'name_hi  as name';
               
            }
            $userId = Auth::user()->id;
            $userInterestList =IndividualInterest::select('id','user_id','individual_interest_list_id')->where('user_id',$userId)->with('indInterest')->get();
            
            $allInterestList = IndividualInterestList::where(['status' => 0])->orderBy('id', 'desc')->select($name, 'id','image')->get();
            return view('frontend.individual.add_interest', ['userInterestList'=>$userInterestList,'allInterestList'=>$allInterestList]);
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
    }

    public function addInterest(Request $request)
    {
        # code...
        try{
            $userId = Auth::user()->id;
            $selectedListIds = $request->interest_item;
            if(empty($selectedListIds)){
                return redirect('add-interest')->with('error', "please select mini 2 and max 10");
            }
            if(count($selectedListIds) >= 2 && count($selectedListIds) <= 10){
                $count_inertest = IndividualInterest::where('user_id',$userId)->count();
                //delete old record if update
                $deleteAll = IndividualInterest::where('user_id',$userId)->delete();
                foreach($selectedListIds as $lid){
                    $orderCreate = IndividualInterest::firstOrNew([
                        'user_id' => $userId,
                        'individual_interest_list_id' => $lid,
                    ])->save();
                }
                if($count_inertest == 0){
                    return redirect('ind-home')->with('success', "Product Added sucessfully.");
                }
                return redirect('my-interest')->with('success', "Product Added sucessfully.");
            }else{
                return redirect('add-interest')->with('error', "please select mini 2 and max 10 product");
            }
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
    }
//individual add sale
public function addOrder(Request $request)
    {
        if ($request->sale == 'ind') {
            Session::forget(['indproducts', 'user_id','sess_clf_phone','sess_clf_email','ind_sess_mod']);
        }
        $language = $request->session()->get('weblangauge');
        $success_message = $language == 'kn' ? 'ऑर्डर सफलतापूर्वक अपडेट किया गया।' : 'Order Updated sucessfully.'; 
        $user_id = Auth::user()->id;// ind id
        $block = Auth::user()->block;
        try{
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'user_id'           => 'required'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
                }
                if (Session::has('indproducts') && count(json_decode(Session::get('indproducts'), true)) >= 1 ) {

                    $orderData['user_id'] = $user_id;
                $orderData['seller_id'] = $request->user_id;//CLF id
                $orderData['otp'] = '1234';
                $orderData['mode_of_delivery'] = 'self';
                $orderData['delivery_status'] = 'pending';
                $orderData['order_status'] = 'pendind';
                $orderData['sale_date'] = $request->sale_date;

                $orderCreate = IndOrder::create($orderData);
                if($orderCreate){
                    //update order id
                    $str_result = str_pad($orderCreate->id, 5, "0", STR_PAD_LEFT);
                    $orderShowId = 'INDORD'.$str_result;
                    $orderCreate->update(['order_id_d' => $orderShowId]);
                    //update product....
                    $products = json_decode(Session::get('indproducts'), true);
                    foreach ($products as $value) {
                        $productData = [
                            'order_id' => $orderCreate->id,
                            'product_id' => $value['id'],
                            'quantity'   => $value['qty_value']   
                        ];
                        $chkOrderItem = IndOrderItem::where('order_id',$orderCreate->id)->where('product_id',$value['id'])->first();
                        if(!$chkOrderItem){
                            IndOrderItem::create($productData);
                        }
                        
                    }
                    $rating_arr = [];
                        $rating_arr['review_by_user'] = $user_id;
                        $rating_arr['order_id'] = $orderCreate->id;
                        $rating_arr['type'] = 'individual';
                        $rating_arr['user_id'] = $request->user_id;
                        $rating_arr['rating'] = $request->rating;
                        $rating_arr['review_msg'] = $request->review_msg;
                        //add rating
                        IndRating::create($rating_arr);
                        Session::forget(['indproducts', 'sess_clf_phone','sess_clf_email','user_id','sess_mod']);
                        return redirect('ind-order-list')->with('success', $success_message);

                   

                

                }
               
            }
            Session::forget(['indproducts']);
            return redirect()->back()->withErrors('Please select one or more products .');
        }
            $clfUser = User::select('id','name','email','mobile','organization_name')->where('role_id',2)->where('block',$block)->where('isActive',1)->get();    

            return view('frontend.individual.add_order',['clfUser' => $clfUser, 'seller_id'=> $user_id]);
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
        
    }

    public function indProducts(Request $request)
    {
       
        $user_id = Auth::user()->id;
        $language = $request->session()->get('weblangauge');
        $catname = 'name_en  as name';
        $productname = 'name_en as name';
        if ($language == 'kn') {
            $catname = 'name_hi  as name';
            $productname = 'name_hi  as name';
        }
        $allproduct = IndCategory::select($catname,'id')->with('indProducts:id,status,price_unit,image,cat_id,'.$productname)->get();
        return view('frontend.individual.ind_product',['catproducts' => $allproduct,'seller_id' => $user_id]);

    }

    public function addIndProductSess(Request $request)
    {
        if (Session::has('indproducts')){
            Session::forget('indproducts');
        }
      // print_r($request->product);die;
        if ($request->product) {
            $products = $request->product;
            foreach ($products as $key => $product){
                if ($product['qty_value'] == 0) {
                    unset($products[$key]);
                }
            }
            if (count($products) >= 1) {
                Session::put('indproducts', json_encode($products));
            } else {
                Session::forget('indproducts');
            }            
            return redirect('/ind-add-sale');
        }
    }

    public function deleteSessionProduct(Request $request)
    {
        $key_value = $request->product_id;
        if (Session::has('indproducts')) {
            $products = json_decode(Session::get('indproducts'), true);
            foreach ($products as $key => $product){
                if ($product['id'] == $key_value) {
                    unset($products[$key]);
                }
            }
            if (count($products) >= 1) {
                Session::put('indproducts', json_encode($products));
            } else {
                Session::forget('indproducts');
            }
            $response['status'] = true;
            $response['statusCode'] = 200;
            return response()->json($response, 201);
        }
    }

        public function getClf(Request $request)
        {
            # code...
            $clf_id = $request->clf_id;
            $clfData  = User::where('id',$clf_id)->first();
            if ($clfData) {
                $clgfMobile = trim($clfData->mobile);
                $clgfEmail = trim($clfData->email);
                Session::put('sess_clf_phone', $clgfMobile);
                Session::put('sess_clf_email', $clgfEmail);
                Session::put('user_id', $clf_id);
                $response['status'] = true;
                $response['sess_clf_phone'] = $clgfMobile;
                $response['sess_clf_email'] = $clgfEmail;
                return response()->json($response, 201);
            }
        }
        public function getIndProfile(Request $request,$id)
        {
            # code...
            try{
                $id = decrypt($id);
                $loginId = Auth::user()->id;
                $address = '';
                $userdata = User::where('id', $id)->select('id', 'name', 'title', 'profileImage', 'email', 'mobile','role_id')->first();
                $address = Address::where(['user_id' => $id, 'address_type' => 'registered'])->first();
                $country = Country::where('id', $address->country)->first();

                $state = State::where('id', $address->state)->first();
                $district = City::where('id', $address->district)->first();

                $address['countryname'] = $country->name;
                $address['statename'] = $state->name;
                $address['districtname'] = $district->name;

                $ratingCount = IndRating::where('user_id', $id)->count();
                $ratingStarAvg = DB::table('ind_ratings')->where('user_id', $id)->avg('rating');
                $rating_avg = number_format((float)$ratingStarAvg, 2, '.', '');
                $individualInterest =IndividualInterest::select('id','user_id','individual_interest_list_id')->where('user_id',$id)->with('indInterest')->get();
                $favStatus = 0;
                $favuser= Favorite::select('status')->where('user_id',$loginId)->where('seller_id',$id)->first();
                if($favuser){
                    $favStatus = $favuser->status;
                }
                $data = ['user' => $userdata, 'favStatus' => $favStatus, 'address' => $address,'reviewCount' => $ratingCount,'ratingAvgStar' => $rating_avg, 'individualInterest'=>$individualInterest];
               
                return view('frontend.individual.ind_profile',['alldetail' => $data]);
            }catch(\EXCEPTION $e){
                return $e->getMessage();
            }
        }

        public function viewRating(Request $request,$id)
    {
        # code...
        $id = decrypt($id);
        $ratings = IndRating::where('user_id', $id)->with('getreviews')->get();
        return view('frontend.individual.view_rating', ['ratings'=> $ratings]);
    }
    public function faq(Request $request)
    {
        # code...
        $language = $request->session()->get('weblangauge');
        $title = 'topic_en  as title';
        $question = 'question_en  as question';
        $desc = 'desc_en  as desc';
        if ($language == 'kn') {
            $title = 'topic_hi  as title';
            $question = 'question_hi  as question';
            $desc = 'desc_hi  as desc';
           
        }
        $List = Faq::with('getQuestion:id,faq_topic_id,'.$question.','.$desc)->select('id',$title)->where('status',0)->get();
        return view('frontend.individual.faq_list', ['faq'=> $List]);
    }
    public function faqQuestion(Request $request,$id)
    {
        # code...
        $language = $request->session()->get('weblangauge');
        $title = 'topic_en  as title';
        $question = 'question_en  as question';
        $desc = 'desc_en  as desc';
        if ($language == 'kn') {
            $title = 'topic_hi  as title';
            $question = 'question_hi  as question';
            $desc = 'desc_hi  as desc';
           
        }
        $List = Faq::with('getQuestion:id,faq_topic_id,'.$question.','.$desc)->select('id',$title)->where('id',decrypt($id))->first();
       
        return view('frontend.individual.faq_question', ['faq'=> $List]);
    }
    public function faqDesc(Request $request,$id)
    {
        # code...
        $language = $request->session()->get('weblangauge');
        $title = 'topic_en  as title';
        $question = 'question_en  as question';
        $desc = 'desc_en  as desc';
        if ($language == 'kn') {
            $title = 'topic_hi  as title';
            $question = 'question_hi  as question';
            $desc = 'desc_hi  as desc';
           
        }
        $List = FaqQuestion::select('id','faq_topic_id',$question,$desc)->where('id',decrypt($id))->first();
       
        return view('frontend.individual.faq_desc', ['faq'=> $List]);
    }

    public function indChat(Request $request)
    {
        # code...
        Session::forget(['session_from_user_id']);
        
        
        $fromname='';
        $userId = Auth::user()->id;
        $mobile = Auth::user()->mobile;
        $chatTag = ChatMessage::where('status',1)->get();
        if($request->id){
            $id = decrypt($request->id);
            Session::put('session_from_user_id', $id);
            Helper::startChatConversation(0,$userId,$id,1,1,1,1);
            $formUserData = User::where('id',$id)->first();
            $fromname = $formUserData->name;
        }
        
        return view('frontend.individual.ind_chat', ['chatTag'=>$chatTag,'selectedUserName'=>$fromname,'mobile'=>$mobile]);
    }
    

    public function additionalInfo(Request $request)
    {
        $user_id = Auth::user()->id;
        $language = $request->session()->get('weblangauge');
        $user_info = IndAddtinaolInformation::where('user_id',$user_id)->first();
        $name = 'eng as name';
        if ($language == 'kn') {
            $name = 'hin as name';            
        }
        $drop_down_list = DB::table('edu_caste_dropdowns')->select('id','type',$name)->get();
        return view('frontend.individual.addition_info', ['user_info'=> $user_info, 'drop_down_list' => $drop_down_list]);
    }

    public function saveAdditionalInfo(Request $request)
    {
        $language = $request->session()->get('weblangauge');
        $user_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            //return $request;
            $validator = Validator::make($request->all(), [
                'education_qualification' => 'required',
                'caste' => 'required',
                'belong_to_shg' => 'required',
                'livelihood' => 'required',
                'land_ownership' => 'required_if:livelihood,==,farm',
                'cultivable_land' => 'required_if:livelihood,==,farm',
                'dob' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                ->withInput()
                ->withErrors($validator);
            }

            $user = IndAddtinaolInformation::firstOrNew(array('user_id' => $user_id));
            $user->education_qualification = $request->education_qualification;
            $user->caste = $request->caste;
            $user->belong_to_shg = $request->belong_to_shg;
            $user->livelihood = $request->livelihood;
            $user->land_ownership = $request->land_ownership;
            $user->cultivable_land = $request->cultivable_land;
            $user->dob = $request->dob;
            $user->secc = $request->secc;
            $user->annual_income = $request->annual_income;
            $user->save();

            return redirect('additional-info')->with('success', 'Information added successfully');

        }
        
    }

}