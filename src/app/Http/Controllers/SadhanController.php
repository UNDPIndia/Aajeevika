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

class SadhanController extends Controller
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

            if (!in_array('/admin/sadhan', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('sadhans')
        ->leftjoin('sadhan_categories','sadhan_categories.id','=','sadhans.category_id')
        ->select('sadhans.*','sadhan_categories.id as catid','sadhan_categories.name_en as catname')
        ->orderBy('sadhans.id','desc');


        if ($request->has('s')) {
            $query = DB::table('sadhans')
            ->select('sadhans.*')
            ->where('sadhans.title_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('sadhans.title_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $sadhans1 = $query->get()->toArray();
        //for view
        $sadhans = $query->paginate(10);

        if ($request->has('exportlist')) {
            if ($request->exportlist == 'all') {
                $data =  $sadhans1;
                return Excel::create('sadhans', function ($excel) use ($data) {
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

        
        return view('sadhans.index', ['sadhans' => $sadhans]);
    }

    public function create($catId = false)
    {
        $sadhanCat = SadhanCategory::get();
        return view('sadhans.add',['sadhanCat'=>$sadhanCat]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title_en'=>'required',
            'title_hi'=>'required',
            'youtube_url'=>'required',
            'desc_en'=>'required',
            'desc_hi'=>'required',
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/addsadhan')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();
            $category = Sadhan::create($input);
            $queryStatus = "Successful";
            return redirect('admin/sadhan')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $Sadhan = Sadhan::where(['id' => $id])->first();
        $sadhanCat = SadhanCategory::get();
        return view('sadhans.edit', ['sadhan' => $Sadhan, 'sadhanCat'=>$sadhanCat,'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title_en'=>'required',
            'title_hi'=>'required',
            'youtube_url'=>'required',
            'desc_en'=>'required',
            'desc_hi'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/addsadhan/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
           
            $categoryUpdate  = Sadhan::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/sadhan');
            }
        }
    }

    


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = Sadhan::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/sadhan');
        }
    }


   
}
