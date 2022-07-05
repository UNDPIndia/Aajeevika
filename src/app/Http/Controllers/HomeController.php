<?php

namespace App\Http\Controllers;
use App\ProductMaster;
use App\ProductTemplate;
use App\Category;
use App\User;
use App\Order;
use App\Material;
use App\PopularProduct;
use App\Address;
use App\Country;
use App\State;
use App\City;
use App\PopupManager;
use App\Notification;
use App\Banner;
use App\Location;
use App\Expressinterest;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user = auth()->user();
        //print_r($user);
        //die('sdsd');
        $data['role'] = $user->role_id;

        $data['totalCategory'] = Category::where(['is_active' => 1, 'parent_id' => 0])->count();

        $data['subCategory'] = Category::where(['is_active' => 1])->where('parent_id', '!=', 0)->count();

        $data['material'] = Material::where('is_active', 1)->count();

        $data['ProductTemplate'] = ProductTemplate::where('status', 1)->count();
       
        

        if($user->role_id == 5) {
    
           
      
            $data['totalProduct'] = ProductMaster::where(['is_active' =>1 ,'is_draft' => 0])->count();
    
            $data['totalDraftProduct'] = ProductMaster::where(['is_draft' => 1])->count();
    
            $data['totalOrder'] = Order::count();
            $data['totalInterest'] = Expressinterest::count();
            $data['totalUser'] = User::where(['role_id' => 1])->count();
            $data['totalSHGInd'] = User::where(['role_id' => 9])->where('district','!=',null)->count();
            $data['totalArtisan'] = User::where(['role_id' => 2])->where('district','!=',null)->count();
            $data['totalSHGSeller'] = User::where(['role_id' => 3])->where('district','!=',null)->count();
            $data['totalGrothCenter'] = User::where(['role_id' => 7])->where('district','!=',null)->count();
            $data['totalSarasCenter'] = User::where(['role_id' => 8])->where('district','!=',null)->count();
            $data['totalSeller'] = User::whereIn('role_id',[2,3,7,8])->where('district','!=',null)->count();
            $data['totalShg'] = User::where(['role_id' => 3])->where('district','!=',null)->count();
    
            // echo "<pre>"; print_r($data); die("check");

            if($request->district) {
                $district = $request->district;
                
                $shgArtisan = User::where(['district' => $district, 'isActive' => 1])->pluck('id');
                
                $data['totalProduct'] = ProductMaster::where(['is_active' =>1 ,'is_draft' => 0])->whereIn('user_id', [$shgArtisan])->count();

                $data['totalUser'] = User::where(['isActive'=> 1, 'role_id' => 1, 'district' => $district])->count();
                $data['totalArtisan'] = User::where(['isActive'=> 1, 'role_id' => 2, 'district' => $district])->count();
                $data['totalShg'] = User::where(['isActive'=> 1, 'role_id' => 3 , 'district' => $district])->count();
            }


            $data['PopularProduct'] = PopularProduct::count();
            $data['district'] = City::where('state_id', 39)->where('is_district',1)->get();
        }else{

            
                $district = $user->district;
           
            $data['totalUser'] = User::where(['isActive'=> 1, 'role_id' => 1, 'district' => $district])->count();
            $data['totalArtisan'] = User::where(['isActive'=> 1, 'role_id' => 2, 'district' => $district])->count();
            $data['totalShg'] = User::where(['isActive'=> 1, 'role_id' => 3 , 'district' => $district])->count();
            // echo "District : ".$district;
            $data['district'] = [];
        }



        // $data = [
        //     'totalCategory' => $totalCategory,
        //     'subCategory'   => $subCategory,
        //     'totalProduct'  => $totalProduct,
        //     'totalDraftProduct' => $totalDraftProduct,
        //     'totalUser'     => $totalUser,
        //     'totalArtisan'  => $totalArtisan,
        //     'totalShg'      => $totalShg,
        //     'material'      => $material,
        //     'ProductTemplate'=> $ProductTemplate,
        //     'PopularProduct' => $PopularProduct   
        // ];

        // echo "<pre>"; print_r($data); die("check");

        return view('home', ['dataCount' => $data]);
    }
}
