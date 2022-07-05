<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use App\User;
use App\Category;
use App\IndCategory;
use App\Material;
use App\ProductMaster;
use App\RolePermission;
use App\Permission;
use App\Role;
use App\IndividualInterestList;
use App\Sarvottam;
use App\Sadhan;
use App\SadhanCategory;

use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class CatSadhanController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            $userPermission = RolePermission::where('user_id', Auth::user()->id)->get();
            $permArr = [];
            foreach ($userPermission as $key => $perm) {
                $permArr[] = $perm->permission_id;
            }
            $permission = Permission::wherein('id', $permArr)->pluck('url')->toArray();
            $permission[] =  '/admin';

            if (!in_array('/admin/sadhan-cat', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('sadhan_categories')
        ->select('sadhan_categories.*')
        ->orderBy('sadhan_categories.id','desc');


        if ($request->has('s')) {
            $query = DB::table('sadhan_categories')
            ->select('sadhan_categories.*')
            ->where('sadhan_categories.name_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('sadhan_categories.name_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $sadhans1 = $query->get()->toArray();
        //for view
        $sadhans = $query->paginate(10);

      
        
        return view('sadhans.cat_index', ['sadhanscat' => $sadhans]);
    }

    public function create($catId = false)
    {
       // $sadhanCat = SadhanCategory::get();
        return view('sadhans.cat_add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_hi'=>'required',
            
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/addsadhancat')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();
            $category = SadhanCategory::create($input);
            $queryStatus = "Successful";
            return redirect('admin/sadhan-cat')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $sadhanCat = SadhanCategory::where(['id' => $id])->first();
        return view('sadhans.cat_edit', ['sadhanCat' => $sadhanCat]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name_en'=>'required',
            'name_hi'=>'required',
           
        ]);
        if ($validator->fails()) {
            return redirect('admin/addsadhancat/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
           
            $categoryUpdate  = SadhanCategory::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/sadhan-cat');
            }
        }
    }

    


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['cat_status'] = $status;
        $individualUpdate  = SadhanCategory::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/sadhan-cat');
        }
    }


   
}
