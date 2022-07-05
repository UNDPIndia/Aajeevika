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
use App\Expressinterestitem;
use App\Expressinterest;
use App\Order;
use App\OrderItem;
use App\Rating;
use App\ProductMaster;
use App\CollectionCenter;
use App\IndOrder;
use App\IndRating;

use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;
use Session;

class ClfBuyController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            if(Auth::user()->role_id == 2 ){
                return $next($request);
            }else{
                abort(404);
            }
             
        });

    }

    public function index(Request $request)
    {
        $allOrder = IndOrder::with('GetIndividual:id,name,email,mobile')->where(['seller_id'=> $this->id])->select('id','order_id_d','seller_id', 'user_id', 'message', 'id', 'otp','sale_date','created_at')->latest()->get();
        return view('frontend.user.buy_listing', ['allOrders' => $allOrder]);
    }

   

    public function getOrderDetail(Request $request, $id)
    {
        $orderId = decrypt($id);
        $language = $request->session()->get('weblangauge');
        $productname = 'name_en as name_en';

    if ($language == 'kn') {
        $productname = 'name_hi  as name_en';
       
    }
        $allOrder = IndOrder::with('indItems','GetIndividual:id,name,email,mobile,profileImage','getClf:id,name,email,mobile,profileImage','indItems.Indproduct:id,'.$productname.',price_unit','clfRating','indRating')->where(['id'=> $orderId])->select('id','order_id_d','seller_id', 'user_id', 'message', 'id', 'otp','sale_date','created_at')->first();

        return view('frontend.user.buy_order_detail', ['allOrders' => $allOrder]);
    }
    
    public function addRatingByClf(Request $request, $id)
    {
        # code...
        $ind_id = decrypt($id);
        $user_id = Auth::user()->id;
        $rating_arr = [];
        $rating_arr['review_by_user'] = $user_id; // clf
        $rating_arr['order_id'] = $request->order_id;
        $rating_arr['type'] = 'clf';
        $rating_arr['user_id'] = $ind_id; //ind id
        $rating_arr['rating'] = $request->rating;
        $rating_arr['review_msg'] = $request->review_msg;
       
        IndRating::create($rating_arr);
        return redirect()->back()->with('success', "Review & Rating added sucessfully.");
    }
  
    //SHG Individuals listings
    public function shgIndList(Request $request)
    {
        $language = $request->header('language');
        $userBlock = Auth::user()->block;
        
        $userData = [];
        $indUser  = User::where('isActive',1)->where('role_id',9)->where('block',$userBlock)->with('address_registerd')->get();
        //echo "<pre>"; print_r($indUser); die;
        if(count($indUser) > 0){
            foreach($indUser as $indu){
                $ratingStarAvg = DB::table('ind_ratings')->where('user_id', $indu->id)->avg('rating');
                
                $userData[] = ['id'=>$indu->id,'name'=>$indu->name,'organization_name'=>$indu->organization_name,'mobile'=>$indu->mobile,'email'=>$indu->email,'ratingAvgStar' => $ratingStarAvg,'address_line_one'=>$indu->address_registerd['address_line_one'],'address_line_two'=>$indu->address_registerd['address_line_two'],'block'=>$indu->address_registerd['getBlock']['name'],'district'=>$indu->address_registerd['getDistrict']['name'],'state'=>$indu->address_registerd['getState']['name'],'pincode'=>$indu->address_registerd['pincode']];
            }
        }
        return view('frontend.user.shg_individuals', ['userData' => $userData]);
    }

   
    
}
