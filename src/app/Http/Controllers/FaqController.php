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
use App\Faq;
use App\FaqQuestion;

use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class FaqController extends Controller
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

            if (!in_array('/admin/faq', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        

        $query = DB::table('faqs')
        ->select('faqs.*')
        ->orderBy('id','desc');


        if ($request->has('s')) {
            $query = DB::table('faqs')
            ->select('faqs.*')
            ->where('faqs.topic_en', 'LIKE', '%' . Input::get('s') . '%')
            ->orWhere('faqs.topic_hi', 'LIKE', '%' . Input::get('s') . '%')
            ->orderBy('id','desc');
        }

        //for export
        $faqs1 = $query->get()->toArray();
        //for view
        $faqs = $query->paginate(10);

        if ($request->has('exportlist')) {
            if ($request->exportlist == 'all') {
                $data =  $faqs1;
                return Excel::create('faqs', function ($excel) use ($data) {
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

        
        return view('faq.index', ['faq' => $faqs]);
    }

    public function create($catId = false)
    {
        return view('faq.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_en'=>'required',
            'topic_hi'=>'required',
            
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/addfaq')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();
 
            $category = Faq::create($input);
            $queryStatus = "Successful";
            return redirect('admin/faq')->with('message', $queryStatus);
        }
    }
    public function edit($id)
    {
        $faq = Faq::where(['id' => $id])->first();
        
        return view('faq.edit', ['faq' => $faq, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'topic_en'=>'required',
            'topic_hi'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/editfaq/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
           
            $categoryUpdate  = Faq::where('id', $id)->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/faq');
            }
        }
    }

    


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = Faq::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/faq');
        }
    }

/////////////-------------Faq Question ------------

    public function questionList(Request $request, $id)
    {
        # code...
        $faqQuest = FaqQuestion::with('getFaq')->where('faq_topic_id',decrypt($id))->paginate(10);
        return view('faq.question_list',['faqQuest'=>$faqQuest,'id'=>$id]);
    }
    public function createq($id)
    {
        return view('faq.add_question',['faq_topic_id'=>decrypt($id)]);
    }



    public function storeq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_en'=>'required',
            'question_hi'=>'required',
            'desc_hi'=>'required',
            'desc_en'=>'required',
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/addfaqquestion')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();
 
            $category = FaqQuestion::create($input);
            $queryStatus = "Successful";
            return redirect('admin/faqquestion/'.encrypt($input['faq_topic_id']))->with('message', $queryStatus);
        }
    }

    public function editq($id)
    {
        $faq = FaqQuestion::where(['id' => decrypt($id)])->first();
        
        return view('faq.edit_question', ['faq' => $faq, 'id' => $id]);
    }

    public function updateq(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'question_en'=>'required',
            'question_hi'=>'required',
            'desc_hi'=>'required',
            'desc_en'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/editfaqquestion/'.$id)->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
           
            $categoryUpdate  = FaqQuestion::where('id', decrypt($id))->first();
            if ($categoryUpdate) {
                
                $cats = $categoryUpdate->update($input);
               
                return redirect('admin/faqquestion/'.encrypt($categoryUpdate->faq_topic_id));
            }
        }
    }

    


    public function destroyq($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = FaqQuestion::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/faqquestion/'.encrypt($id));
        }
    }

}
