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
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;

class BuyerOrderController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            if(Auth::user()->role_id != 1 ){
                // Auth::logout();
               //return redirect('/');
               abort(404);
            }
             return $next($request);
        });
    }

    public function index()
    {

    }

    public function getOrderList()
    {
        if (auth()->check() && Auth::user()->role_id != 1){
            abort(404);
        }
        $whereIn = ['pending'];
        $user_id = Auth::user()->id;
        $allOrder = Order::with('items', 'seller:id,name,email,mobile,organization_name,profileImage', 'items.product:id,price,price_unit,qty,localname_en')
                    ->where(['user_id'=> $user_id])
                    //->whereIn('order_status',$whereIn)
                    ->select('id','order_status','mode_of_delivery','order_id_d','seller_id', 'user_id', 'message', 'id', 'interest_id', 'otp','created_at')
                    ->latest()
                    ->get();
        return view('frontend.user.buyer_orders', ['allOrders' => $allOrder]);
    }

    public function getOrderDetail(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $order_id = decrypt($id);
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $allOrders = Order::with('items', 'interest:id,interest_Id','items.product:id,price,price_unit,qty,'.$productname, 'seller:id,name,email,mobile,organization_name,profileImage','sellerRating','buyerRating')
                    ->where(['id' => $order_id])
                    ->select('id','order_id_d','order_status','seller_id', 'user_id', 'message', 'otp', 'mode_of_delivery','interest_id','updated_at', 'created_at')
                    ->latest()
                    ->first();

        $rating_valid_invalid = 'invalid';
        $rating_query = \App\Rating::where(['order_id' => $order_id, 'type' => 'buyer', 'review_by_user'=> $user_id]);
        if ($rating_query->doesntExist()) {
            $rating_valid_invalid = 'valid';
        }
        return view('frontend.user.buyer_order_detail', ['allOrders' => $allOrders,'rating_valid_invalid' => $rating_valid_invalid]);
    }

    /** 
     * Rating By Buyer to Seller 
     * 
    */

    public function ratingToSeller(Request $request, $seller_id)
    {
        $seller_id = decrypt($seller_id);
        $user_id = Auth::user()->id;
        $rating_arr = [];
        $rating_arr['review_by_user'] = $user_id; // buyer
        $rating_arr['order_id'] = $request->order_id;
        $rating_arr['type'] = 'buyer';
        $rating_arr['user_id'] = $seller_id;
        $rating_arr['rating'] = $request->rating;
        $rating_arr['review_msg'] = $request->review_msg;
        //add rating
        \App\Rating::create($rating_arr);
        return redirect()->back()->with('success', "Review & Rating added sucessfully.");

    }









        



  
    
}
