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
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;
use Session;

class SellerOrderController extends Controller
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

    public function getOrderList()
    {
        if (auth()->check() && Auth::user()->role_id == 1){
            abort(404);
        }
        $whereIn = ['pending'];
        $user_id = Auth::user()->id;
        $allOrder = Order::with('items', 'buyer:id,name,email,mobile,organization_name,profileImage', 'items.product:id,price,price_unit,qty,localname_en')
                    ->where(['seller_id'=> $user_id])
                   // ->whereIn('order_status',$whereIn)
                    ->select('id','order_status','mode_of_delivery','order_id_d','seller_id', 'user_id', 'message', 'id', 'interest_id', 'otp','created_at','sale_date')
                    ->latest()
                    ->get();
        

        return view('frontend.user.seller_order_list', ['allOrders' => $allOrder]);
    }

    public function getOrderDetail(Request $request, $id)
    {
        $order_id = decrypt($id);
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $allOrders = Order::with('items', 'interest:id,interest_Id','items.product:id,price,price_unit,qty,'.$productname, 'buyer:id,name,email,mobile,organization_name,profileImage','sellerRating','buyerRating')
                    ->where(['id' => $order_id])
                    ->select('id','order_id_d','order_status','seller_id', 'user_id', 'message', 'otp', 'mode_of_delivery','interest_id','updated_at', 'created_at','sale_date')
                    ->latest()
                    ->first();
        return view('frontend.user.seller_order_detail', ['allOrders' => $allOrders]);
    }
    public function addOrder(Request $request)
    {
        
        if ($request->sale == 'first') {
            Session::forget(['products', 'interest_id','sess_buyer_name','sess_mod']);
        }
        $language = $request->session()->get('weblangauge');
        $user_id = $seller_id= Auth::user()->id;// seller id
        $block = Auth::user()->block;
        try{
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'interest_id' => 'required',
                    'review_msg' => 'required',
                    'collection_center_id' => 'required_if:mode_of_delivery,1',          
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
                }
                if (Session::has('products') && count(json_decode(Session::get('products'), true)) >= 1 ) {
                //add code here...
                    $buyer_id = 0;
                    if(Session::has('interest_id')){
                        $interest_id = Session::get('interest_id');
                    } else {
                        $interest_id = $request->interest_id;
                    }
                    $buyer = Expressinterest::where(['id' => $interest_id,'seller_id'=> $user_id])->select('user_id')->first();
                    if (!empty($buyer)) {
                        $buyer_id = $buyer->user_id; //buyer id
                    }
                    $orderData['user_id'] = $buyer_id; //buyer id
                    $orderData['interest_id'] = $interest_id;
                    $orderData['seller_id'] = $seller_id;
                    $orderData['otp'] = '1234';
                    $orderData['mode_of_delivery'] = $request->mode_of_delivery;
                    
                    $orderData['sale_date'] = $request->sale_date;
                    if($request->mode_of_delivery == 0){
                        $orderData['delivery_status'] = 'delivered';
                        $orderData['order_status'] = 'delivered';
                    }
                    if($request->mode_of_delivery == 1){
                        $orderData['delivery_status'] = 'pending';
                        $orderData['order_status'] = 'pending';
                        $orderData['collection_center_id'] = $request->collection_center_id;
                    
                    }
                    
                    $orderCreate = Order::create($orderData);
                    if($orderCreate){
                        //update order id
                        $str_result = str_pad($orderCreate->id, 5, "0", STR_PAD_LEFT);
                        $orderShowId = 'ORD'.$str_result;
                        $orderCreate->update(['order_id_d' => $orderShowId]);
                        //update product....
                        $products = json_decode(Session::get('products'), true);
                        foreach ($products as $value) {
                            $productData = [
                                'order_id' => $orderCreate->id,
                                'product_id' => $value['id'],
                                'quantity'   => $value['qty_value'], 
                                'product_price'   => $value['price']   
                            ];
                            $chkOrderItem = OrderItem::where('order_id',$orderCreate->id)->where('product_id',$value['id'])->first();
                            if(!$chkOrderItem){
                                OrderItem::create($productData);
                            }
                            
                        }


                        $rating_arr = [];
                        $rating_arr['review_by_user'] = $seller_id;
                        $rating_arr['order_id'] = $orderCreate->id;
                        $rating_arr['type'] = 'seller';
                        $rating_arr['user_id'] = $buyer_id;
                        $rating_arr['rating'] = $request->rating;
                        $rating_arr['review_msg'] = $request->review_msg;
                        //add rating
                        Rating::create($rating_arr);
                        Session::forget(['products', 'interest_id','sess_buyer_name','sess_mod']);
                        return redirect('seller-order-list')->with('success', "Order Updated sucessfully.");
                    }

                }
                Session::forget(['products']);
                return redirect()->back()->withErrors('Please select one or more products .');
            }
            $interest = Expressinterest::with('buyer')
                        ->where(['seller_id'=> $user_id])
                        //->select('user_id as buyer_id', 'id as interest_id','interest_Id as prefix_interest_Id')
                        ->select('user_id', 'id as interest_id','interest_Id as prefix_interest_Id')
                        ->orderBy('id', 'desc')->get();

            $name = 'name_en  as name';
            if ($language == 'kn') {
                $name = 'name_hi  as name';
            
            }
            $collection_centers = CollectionCenter::where(['status' => 0,'block_id'=>$block])->select($name, 'id')->get();
            return view('frontend.user.seller_add_order',['interest' => $interest, 'seller_id'=> $user_id, 'collection_centers' => $collection_centers]);
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
        
    }

    public function getProducts(Request $request)
    {
        //Session::forget('sess_buyer_name');
        if (Session::has('products')){
            Session::forget(['products', 'interest_id', 'sess_buyer_name']);
        }
        $interest_id = $request->interest_id;
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $product_session = [];
        $buyerInterestProduct = Expressinterestitem::with('product:id,price,price_unit,qty,'.$productname)
                    ->where(['express_id' => $interest_id])
                    ->get();
        foreach($buyerInterestProduct as $index_key => $product) {
            $product_session[$index_key]['qty_value'] = $product->quantity;
            $product_session[$index_key]['id'] = $product->product->id;
            $product_session[$index_key]['name'] = $product->product->name;
            $product_session[$index_key]['price'] = $product->product->price;
            $product_session[$index_key]['price_unit'] = $product->product->price_unit;
        }
       
        $response['status'] = true;
        $response['redirect_url'] = url('/add-sale');
        if(!empty($product_session) && !$buyerInterestProduct->isEmpty()) {
            Session::put('products', json_encode($product_session));
            Session::put('interest_id', $interest_id);
            $buyerData = Expressinterest::with('buyer:name,id')
            ->where(['id'=> $interest_id])
            ->first();
            if ($buyerData) {
                $buyer_name = trim($buyerData->buyer->name);
                Session::put('sess_buyer_name', $buyer_name);
            }
        }
        return response()->json($response, 201);
    }

    /**
     * Add Product Form
     * @param $seller_id
     */
    public function sellerProducts(Request $request, $seller_id)
    {
        $seller_id = decrypt($seller_id);
        if (auth()->check() && Auth::user()->role_id == 1){
            abort(404);
        }
        $user_id = Auth::user()->id;
        $language = $request->session()->get('weblangauge');
        $productname = 'localname_en as name';
        if ($language == 'kn') {
            $productname = 'localname_kn  as name';
        }
        $products = ProductMaster::where('user_id', $seller_id)->get(['id','price', 'price_unit', 'qty as qty_avail', $productname ,'image_1']);
        return view('frontend.user.seller_products',['products' => $products,'seller_id' => $seller_id]);

    }

    /**
     * Store Seller Product in Session
     * @param $seller_id
     */
    public function addProductSession(Request $request, $seller_id)
    {
        if (Session::has('products')){
            Session::forget('products');
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
            } else {
                Session::forget('products');
            }            
            return redirect('/add-sale');
        }
    }

    // delete product from seeesion by array key

    public function deleteSessionProduct(Request $request)
    {
        $key_value = $request->product_id;
        if (Session::has('products')) {
            $products = json_decode(Session::get('products'), true);
            foreach ($products as $key => $product){
                if ($product['id'] == $key_value) {
                    unset($products[$key]);
                }
            }
            if (count($products) >= 1) {
                Session::put('products', json_encode($products));
            } else {
                Session::forget('products');
            }
            $response['status'] = true;
            $response['statusCode'] = 200;
            return response()->json($response, 201);
        }
    }

    // Add Mode Of Delivery 

    public function addModSession(Request $request)
    {
        $key_value = $request->input_value;
        Session::put('sess_mod', $key_value);
        $response['status'] = true;
        $response['statusCode'] = 200;
        return response()->json($response, 201);
    }





        



  
    
}
