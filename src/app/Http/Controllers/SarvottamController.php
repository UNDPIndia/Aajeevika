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

use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class SarvottamController extends Controller
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

            if (!in_array('/admin/sarvottams', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('sarvottams')
        ->select('sarvottams.*')
        ->orderBy('id','desc');


        if ($request->has('s')) {
            $query = DB::table('sarvottams')
            ->select('sarvottams.*')
            ->where('sarvottams.title_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('sarvottams.title_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $sarvottam1 = $query->get()->toArray();
        //for view
        $sarvottams = $query->paginate(10);

        if ($request->has('exportlist')) {
            if ($request->exportlist == 'all') {
                $data =  $sarvottams1;
                return Excel::create('sarvottams', function ($excel) use ($data) {
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

        
        return view('sarvottam.index', ['sarvottams' => $sarvottams]);
    }

    public function create($catId = false)
    {
        return view('sarvottam.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'download_link' => 'required|mimes:pdf|max:5000',
            'title_en'=>'required',
            'title_hi'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/addsarvottam')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();


            if ($files = $request->file('download_link')) {
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $aa =  $files->move(public_path("images/sarvottams"), $profileImage);
                $input['download_link'] = "images/sarvottams/".$profileImage;
            }

            
            $category = Sarvottam::create($input);
            $queryStatus = "Successful";
            return redirect('admin/sarvottams')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $Sarvottam = Sarvottam::where(['id' => $id])->first();
        
        return view('sarvottam.edit', ['sarvottam' => $Sarvottam, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
           'title_en'=>'required',
           'title_hi'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/editsarvottam/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
            if ($files = $request->file('download_link')) {
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $aa =  $files->move(public_path("images/sarvottams"), $profileImage);
                $input['image'] = "images/sarvottams/".$profileImage;
            }
            $categoryUpdate  = Sarvottam::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/sarvottams');
            }
        }
    }

    


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = Sarvottam::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/sarvottams');
        }
    }


   
}
