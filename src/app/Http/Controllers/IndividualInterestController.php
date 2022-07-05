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
use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class IndividualInterestController extends Controller
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

            if (!in_array('/admin/interest-type', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('individual_interest_lists')
        ->select('individual_interest_lists.*')
        ->orderBy('id','desc');


        if ($request->has('s')) {
            $query = DB::table('individual_interest_lists')
            ->select('individual_interest_lists.*')
            ->where('individual_interest_lists.name_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('individual_interest_lists.name_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $categoryData1 = $query->get()->toArray();
        //for view
        $categoryData = $query->paginate(10);

        if ($request->has('exportlist')) {
            if ($request->exportlist == 'all') {
                $data =  $categoryData1;
                return Excel::create('interest_lists', function ($excel) use ($data) {
                    $excel->sheet('mySheet', function ($sheet) use ($data) {
                        $sheet->cell('A1', function ($cell) {
                            $cell->setValue('ID');
                        });
                        $sheet->cell('B1', function ($cell) {
                            $cell->setValue('Name English');
                        });
                        $sheet->cell('C1', function ($cell) {
                            $cell->setValue('Name Hindi');
                        });

                        if (!empty($data)) {
                            foreach ($data as $key => $value) {
                                $i= $key+2;
                                $sheet->cell('A'.$i, $value->id);
                                $sheet->cell('B'.$i, $value->name_en);
                                $sheet->cell('c'.$i, $value->name_hi);
                            }
                        }
                    });
                })->download('xlsx');
            }

            
        }

        
        return view('individual_interest_type.index', ['categoryData' => $categoryData]);
    }

    public function create($catId = false)
    {
        return view('individual_interest_type.add');
    }



    public function store(Request $request)
    {

        // echo "<pre>"; print_r($request->all()); die("check");

        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,jpg,JPEG,JPG,png,svg|max:5000',
            'name_hi'=>'required',
            'name_en'=>'required'
        ]);


        if ($validator->fails()) {
            return redirect('admin/interest/addinteresttype')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();


            if ($files = $request->file('image')) {
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $aa =  $files->move(public_path("images/ind_interest_type"), $profileImage);
                $input['image'] = "images/ind_interest_type/".$profileImage;
            }

            
            $category = IndividualInterestList::create($input);
            $queryStatus = "Successful";
            return redirect('admin/interest-type')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $categoryDetail = IndividualInterestList::where(['id' => $id])->first();
        
        return view('individual_interest_type.edit', ['categoryDetail' => $categoryDetail, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
           'name_en'=>'required',
           'name_hi'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/interest/editinteresttype/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
            if ($files = $request->file('image')) {
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $aa =  $files->move(public_path("images/ind_interest_type"), $profileImage);
                $input['image'] = "images/ind_interest_type/".$profileImage;
            }
            $categoryUpdate  = IndividualInterestList::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/interest-type');
            }
        }
    }

    public function view($id)
    {
        $categoryData = IndCategory::with('subcategory')->where(['id' => $id])->first();
        // dd($categoryData);

        return view('category.view', [ 'categoryData'=>$categoryData]);
    }


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = IndividualInterestList::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/interest-type');
        }
    }


   
}
