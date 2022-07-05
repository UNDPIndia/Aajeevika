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
use App\Suvidha;

use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class SuvidhaController extends Controller
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

            if (!in_array('/admin/suvidha', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('suvidhas')
        ->select('suvidhas.*')
        ->orderBy('id','desc');


        if ($request->has('s')) {
            $query = DB::table('suvidhas')
            ->select('suvidhas.*')
            ->where('suvidhas.title_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('suvidhas.title_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $suvidhas1 = $query->get()->toArray();
        //for view
        $suvidhas = $query->paginate(10);

        if ($request->has('exportlist')) {
            if ($request->exportlist == 'all') {
                $data =  $suvidhas1;
                return Excel::create('suvidhas', function ($excel) use ($data) {
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

        
        return view('suvidha.index', ['suvidhas' => $suvidhas]);
    }

    public function create($catId = false)
    {
        return view('suvidha.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image1' => 'required|mimes:jpeg,jpg,JPEG,JPG,png,svg|max:5000',
            'title_en'=>'required',
            'title_hi'=>'required',
            'desc_en'=>'required',
            'desc_hi'=>'required',
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/addsuvidha')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();


            if ($files1 = $request->file('image1')) {
                $profileImage1 = date('YmdHis') .$files1->getClientOriginalName(). "." . $files1->getClientOriginalExtension();
                $aa =  $files1->move(public_path("images/suvidha"), $profileImage1);
                $input['image1'] = "images/suvidha/".$profileImage1;
            }
            if ($files2 = $request->file('image2')) {
                $profileImage2 = date('YmdHis') . $files2->getClientOriginalName()."." . $files2->getClientOriginalExtension();
                $aa =  $files2->move(public_path("images/suvidha"), $profileImage2);
                $input['image2'] = "images/suvidha/".$profileImage2;
            }
            if ($files3 = $request->file('image3')) {
                $profileImage3 = date('YmdHis') . $files3->getClientOriginalName()."." . $files3->getClientOriginalExtension();
                $aa =  $files3->move(public_path("images/suvidha"), $profileImage3);
                $input['image3'] = "images/suvidha/".$profileImage3;
            }
            if ($files4 = $request->file('image4')) {
                $profileImage4 = date('YmdHis') . $files4->getClientOriginalName()."." . $files4->getClientOriginalExtension();
                $aa =  $files4->move(public_path("images/suvidha"), $profileImage4);
                $input['image4'] = "images/suvidha/".$profileImage4;
            }
            
            $category = Suvidha::create($input);
            $queryStatus = "Successful";
            return redirect('admin/suvidha')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $Suvidha = Suvidha::where(['id' => $id])->first();
        
        return view('suvidha.edit', ['suvidha' => $Suvidha, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
           'title_en'=>'required',
           'title_hi'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/editsuvidha/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
            if ($files1 = $request->file('image1')) {
                $profileImage1 = date('YmdHis') .$files1->getClientOriginalName(). "." . $files1->getClientOriginalExtension();
                $aa =  $files1->move(public_path("images/suvidha"), $profileImage1);
                $input['image1'] = "images/suvidha/".$profileImage1;
            }
            if ($files2 = $request->file('image2')) {
                $profileImage2 = date('YmdHis') . $files2->getClientOriginalName()."." . $files2->getClientOriginalExtension();
                $aa =  $files2->move(public_path("images/suvidha"), $profileImage2);
                $input['image2'] = "images/suvidha/".$profileImage2;
            }
            if ($files3 = $request->file('image3')) {
                $profileImage3 = date('YmdHis') . $files3->getClientOriginalName()."." . $files3->getClientOriginalExtension();
                $aa =  $files3->move(public_path("images/suvidha"), $profileImage3);
                $input['image3'] = "images/suvidha/".$profileImage3;
            }
            if ($files4 = $request->file('image4')) {
                $profileImage4 = date('YmdHis') . $files4->getClientOriginalName()."." . $files4->getClientOriginalExtension();
                $aa =  $files4->move(public_path("images/suvidha"), $profileImage4);
                $input['image4'] = "images/suvidha/".$profileImage4;
            }
            $categoryUpdate  = Suvidha::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/suvidha');
            }
        }
    }

    


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = Suvidha::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/suvidha');
        }
    }


   
}
