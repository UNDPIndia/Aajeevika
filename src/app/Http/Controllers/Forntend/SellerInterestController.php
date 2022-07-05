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

class SellerInterestController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            if(Auth::user()->role_id == 1 || Auth::user()->role_id == 9){
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
        if (auth()->check() && Auth::user()->role_id == 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $interest =[];
        $interest = Expressinterest::with('buyer')
                        ->where(['seller_id'=> $user_id])
                        ->select('seller_id', 'user_id', 'message', 'id', 'interest_Id', 'otp', 'order_id', 'created_at')
                        ->orderBy('id', 'desc')->get();
        return view('frontend.user.seller_interest_list', ['interests' => $interest]);
    }

    public function getExpressInterestDetail(Request $request, $id)
    {
        if (auth()->check() && Auth::user()->role_id == 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $intrest_id = decrypt($id);
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $interestDetails = Expressinterest::with('items', 'items.product:id,price,price_unit,qty,'.$productname, 'buyer')
                    ->where(['id' => $intrest_id])
                    ->select('seller_id','user_id', 'user_id', 'message', 'id', 'interest_Id', 'created_at', 'order_Id')
                    ->orderBy('id', 'desc')
                    ->first();      
        return view('frontend.user.seller_interest_detail', ['interestDetails' => $interestDetails]);
    }

 
   
  



        



  
    
}
