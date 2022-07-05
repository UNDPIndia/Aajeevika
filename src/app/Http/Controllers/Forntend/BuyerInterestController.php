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
use App\ProductMaster;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;
use Session;

class BuyerInterestController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            if(Auth::user()->role_id != 1 ){
                 Auth::logout();
               return redirect('/');
            }
             return $next($request);
        });
    }

    public function index()
    {

    }

    public function getExpressInterestList()
    {
        if (auth()->check() && Auth::user()->role_id != 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $buyerInterest = Expressinterest::with('seller')
                        ->where(['user_id'=> $user_id, 'order_status'=> 'interest'])
                        ->select('seller_id', 'user_id', 'message', 'id', 'interest_Id', 'otp', 'order_id', 'created_at')
                        ->orderBy('id', 'desc')->get();
        return view('frontend.user.buyer_interest', ['buyerInterests' => $buyerInterest]);
    }

    public function getExpressInterestDetail(Request $request, $id)
    {
        if (auth()->check() && Auth::user()->role_id != 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $intrest_id = decrypt($id);
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $buyerInterestDetails = Expressinterest::with('items', 'items.product:id,price,price_unit,qty,'.$productname, 'seller')
                    ->where(['id' => $intrest_id, 'order_status'=> 'interest'])
                    ->select('seller_id', 'user_id', 'message', 'id', 'interest_Id', 'created_at', 'order_Id')
                    ->orderBy('id', 'desc')
                    ->first();      
        return view('frontend.user.buyer_interest_detail', ['buyerInterestDetails' => $buyerInterestDetails]);
    }

    /**
     * Added Product List Form to Express Interest
     * @param $seller_id
     */
    public function expressInterest(Request $request, $seller_id)
    {
        
        if (auth()->check() && Auth::user()->role_id != 1){
            abort(404);
        }
        if ( Session::has('products') && Session::has('products_seller_id') ){
            if ( decrypt(Session::get('products_seller_id')) != decrypt($seller_id)) {
                Session::forget(['products', 'products_seller_id']);
                return redirect('/express-interest/'.$seller_id);
            }
        }
        $seller_id = decrypt($seller_id);
        $user_id = Auth::user()->id;
        $seller_detail = User::where('id', $seller_id)->first(['id','name', 'email', 'mobile']);

        return view('frontend.user.express_interest',['seller_detail' => $seller_detail]);

    }

    /**
     * Add Product Form
     * @param $seller_id
     */
    public function expressProducts(Request $request, $seller_id)
    {
        $seller_id = decrypt($seller_id);
        if (auth()->check() && Auth::user()->role_id != 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $products = ProductMaster::where('user_id', $seller_id)->get(['id','price', 'price_unit', 'qty as qty_avail', $productname ,'image_1']);
        return view('frontend.user.express_products',['products' => $products,'seller_id' => $seller_id]);

    }

    /**
     * Store Express Interest in Session
     * @param $seller_id
     */
    public function addProductSession(Request $request, $seller_id)
    {
        if ( Session::has('products') && Session::has('products_seller_id') ){
            if ( decrypt(Session::get('products_seller_id')) != decrypt($seller_id)) {
                Session::forget(['products', 'products_seller_id']);
                return redirect('/express-interest/'.$seller_id);
            }
        }
        
        if ($request->product) {
            $products = $request->product;
            foreach ($products as $key => $product){
                if ($product['qty_value'] == 0) {
                    unset($products[$key]);
                }
            }
            if (count($products) >= 1) {
                Session::put('products', json_encode($products));
                Session::put('products_seller_id', $seller_id);
            } else {
                Session::forget(['products', 'products_seller_id']);
            }
            
            return redirect('/express-interest/'.$seller_id);
        }
    }

    /**
     * Save Express Intrest in DB
     * @param $seller_id
     */
    public function storeExpressIntrest(Request $request, $seller_id)
    {
        if (Session::has('products') && count(json_decode(Session::get('products'), true)) >= 1 ) {
            $seller_id = decrypt($seller_id);
            $user_id = Auth::user()->id;
            $language = $request->session()->get('weblangauge');
            $addinterest = Expressinterest::create([
                'seller_id' => $seller_id,
                'user_id'   => $user_id,
                'message'   => $request->message,
                'otp'       => rand(1111, 9999),
            ]);
            //update interest id
            $str_result = str_pad($addinterest->id, 5, "0", STR_PAD_LEFT);
            $interShowId = 'INT'.$str_result;
            $addinterest->update(['interest_Id' => $interShowId]);
            $products = json_decode(Session::get('products'), true);
            foreach ($products as $value) {
                $data = [
                    'express_id' => $addinterest->id,
                    'product_id' => $value['id'],
                    'quantity'   => $value['qty_value'] 
                ];
    
                Expressinterestitem::create($data);
            }
            Session::forget(['products', 'products_seller_id']);
            return redirect('buyer-interest-list')->with('success', "Expresses Interested sucessfully.");
        }
        Session::forget(['products', 'products_seller_id']);
        return redirect()->back()->withErrors('Please select one or more products .');

    }



        



  
    
}
