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
use App\Address;
use App\Location;
use App\CertificateType;

use App\Reason;
use App\Pincode;
use DB;
use App\Country;
use App\State;
use App\City;
use App\Documents;
use App\ProductMaster;
use Illuminate\Support\Facades\Storage;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Category;
use App\ProductTemplate;
use App\Material;
use App\Rules\MatchOldPassword;
// use Illuminate\Support\Facades\Hash;
use App\ProductCertification;

class ProductController extends Controller
{
    private $headers;
    public function __construct()
    {
        $this->headers = [
            'Content-Type' => 'application/json',
            'app-key' => 'laravelUNDP',

        ];

        $this->middleware('auth');
    }


    public function deleteproduct(Request $request, $id)
    {
        $id = decrypt($id);
        $productData  = ProductMaster::where(['id'=>$id, 'user_id' => Auth::user()->id])->first();

        if ($productData) {

            $lastURL = url()->previous();
            $urlArr =  explode("/", $lastURL);
            $getURL = $urlArr['3'];

            //$deleteProduct = ProductMaster::where(['id' => $id])->update(['is_active' => 0,'is_draft'=>0]);
            $deleteProduct = ProductMaster::where(['id' => $id])->delete();
            
            if ($getURL == "draft") {
                return redirect()->back()->with('message', "Product Deleted Succesfully");
            } else {
                return redirect('profile/home');
            }

        } else {

            abort(404);
        }
    }


    public function get_template(Request $request)
    {
        $language = $request->session()->get('weblangauge');
        $templatename = 'name_en  as name';
        if ($language == 'kn') {
            $templatename = 'name_kn  as name';
        }
        $template = ProductTemplate::where(['category_id' => $request->categoryId, 'subcategory_id' => $request->subcategoryId, 'material_id' => $request->materialId ])
        ->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->get();

        $queryStatus    = "No template found!";
        $statusCode     = 400;
        $status         = false;

        $response   = array( 'status' => $status , 'statusCode' =>$statusCode, 'message'=> $queryStatus );

        if (count($template) > 0) {
            $queryStatus    = "All Template!";
            $statusCode     = 200;
            $status         = true;

            $response   = array( 'status' => $status , 'statusCode' =>$statusCode, 'message'=> $queryStatus, 'data' => ['template' => $template] );
        }


        return response()->json($response, 201);
    }

    public function addproduct(Request $request)
    {
        $language = $request->session()->get('weblangauge');
        $catname = 'name_en  as name';

        if ($language == 'kn') {
            $catname = 'name_kn  as name';
        }
        $categoryData = Category::select('id', $catname)->where(['parent_id'=> 0, 'is_active'=>1])->get();
        return view('frontend.user.addproduct', ['categoryData'=>$categoryData]);
    }


    public function addproduct_step_2(Request $request)
    {

        //Set Validation on Product with steps
        //dd($request->all());


        $validator = Validator::make($request->all(), [
            'categoryId'    => 'required',
            'subcategoryId' => 'required',
            'material_id'   => 'required',
            'tempalte_id'   =>'required',
            'price' => 'required',
            'qty' => 'required',
            'localname_en' => 'required',
            'localname_kn' => 'required'



        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $dataset_1 = $request->all();
        //print_r($dataset_1);
        session()->put('dataset_1', $dataset_1);
        $language = $request->session()->get('weblangauge');
        $templatename = 'name_en  as name';
        if ($language == 'kn') {
            $templatename = 'name_kn  as name';
        }
        $template = ProductTemplate::where(['id'=>$request->tempalte_id])
        ->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->first();
        //to get certificate type
        
        $cname = 'name_en  as name';
        if ($language == 'kn') {
            $cname = 'name_hi  as name';
           
        }
            $typeList = CertificateType::select('id',$cname)->get();


        return view('frontend.user.addproduct_2', ['dataset_1'=>$dataset_1,'template' => $template, 'typeList'=>$typeList]);
    }

    public function addprpduct_final(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'certificate_image_1' => 'required_with:certificate_type_1',
        ]);



        /* if ($validator->fails()) {
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect('addproduct_step_2')->withErrors($validator)->withInput();
         } */

        /** Upload Images */
        $user = Auth::user();

        $image_file_1 = $request->file('image_1');
        $folder = public_path('images/product/' . $user->id . '/');

        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder, 0775, true, true);
        }

        $image_file_1_image = date('YmdHis') . rand(111, 9999). "productimage1." . $image_file_1->getClientOriginalExtension();
        $aa = $image_file_1->move($folder, $image_file_1_image);

        $image_file_1_image_name = $image_file_1_image;
        $image_file_1_image = 'images/product/'.$user->id.'/'.$image_file_1_image_name;

        $dataset_2['image_1'] = $image_file_1_image;

        /** Upload Image 2 */

        if ($request->file('image_2')) {
            $image_file_2 = $request->file('image_2');
            $folder = public_path('images/product/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_2_image = date('YmdHis') . rand(111, 9999). "productimage2." . $image_file_2->getClientOriginalExtension();
            $aa = $image_file_2->move($folder, $image_file_2_image);

            $image_file_2_image_name = $image_file_2_image;
            $image_file_2_image = 'images/product/'.$user->id.'/'.$image_file_2_image_name;

            $dataset_2['image_2'] = $image_file_2_image;
        }


        /** Upload Image 3 */

        if ($request->file('image_3')) {
            $image_file_3 = $request->file('image_3');
            $folder = public_path('images/product/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_3_image = date('YmdHis') . rand(111, 9999). "productimage3." . $image_file_3->getClientOriginalExtension();
            $aa = $image_file_3->move($folder, $image_file_3_image);

            $image_file_3_image_name = $image_file_3_image;
            $image_file_3_image = 'images/product/'.$user->id.'/'.$image_file_3_image_name;

            $dataset_2['image_3'] = $image_file_3_image;
        }


        /** Upload Image 4 */

        if ($request->file('image_4')) {
            $image_file_4 = $request->file('image_4');
            $folder = public_path('images/product/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_4_image = date('YmdHis') . rand(111, 9999). "productimage4." . $image_file_4->getClientOriginalExtension();
            $aa = $image_file_4->move($folder, $image_file_4_image);

            $image_file_4_image_name = $image_file_4_image;
            $image_file_4_image = 'images/product/'.$user->id.'/'.$image_file_4_image_name;

            $dataset_2['image_4'] = $image_file_4_image;
        }

        /** Upload Image 5 */

        if ($request->file('image_5')) {
            $image_file_5 = $request->file('image_5');
            $folder = public_path('images/product/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_5_image = date('YmdHis') . rand(111, 9999)."productimage5." . $image_file_5->getClientOriginalExtension();
            $aa = $image_file_5->move($folder, $image_file_5_image);

            $image_file_5_image_name = $image_file_5_image;
            $image_file_5_image = 'images/product/'.$user->id.'/'.$image_file_5_image_name;

            $dataset_2['image_5'] = $image_file_5_image;
        }
        $certificateData = [];
            //add certificate
            if ($request->file('certificate_image_1')) {
                $image_file_1 = $request->file('certificate_image_1');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_1_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_1->getClientOriginalExtension();
                $aa = $image_file_1->move($folder, $image_file_1_cerf);

                $image_file_1_image_name = $image_file_1_cerf;
                $image_file_1_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_1_image_name;

                $certificateData['certificate_image_1'] = $image_file_1_cerf;
                $certificateData['certificate_type_1'] = $request->certificate_type_1;
            }

            if ($request->file('certificate_image_2')) {
                $image_file_2 = $request->file('certificate_image_2');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_2_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_2->getClientOriginalExtension();
                $aa = $image_file_2->move($folder, $image_file_2_cerf);

                $image_file_2_image_name = $image_file_2_cerf;
                $image_file_2_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_2_image_name;

                $certificateData['certificate_image_2'] = $image_file_2_cerf;
                $certificateData['certificate_type_2'] = $request->certificate_type_2;
            }
            if ($request->file('certificate_image_3')) {
                $image_file_3 = $request->file('certificate_image_3');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_3_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_3->getClientOriginalExtension();
                $aa = $image_file_3->move($folder, $image_file_3_cerf);

                $image_file_3_image_name = $image_file_3_cerf;
                $image_file_3_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_3_image_name;

                $certificateData['certificate_image_3'] = $image_file_3_cerf;
                $certificateData['certificate_type_3'] = $request->certificate_type_3;
            }
            if ($request->file('certificate_image_4')) {
                $image_file_4 = $request->file('certificate_image_4');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_4_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_4->getClientOriginalExtension();
                $aa = $image_file_4->move($folder, $image_file_4_cerf);

                $image_file_4_image_name = $image_file_4_cerf;
                $image_file_4_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_4_image_name;

                $certificateData['certificate_image_4'] = $image_file_4_cerf;
                $certificateData['certificate_type_4'] = $request->certificate_type_4;
            }
            if ($request->file('certificate_image_5')) {
                $image_file_5 = $request->file('certificate_image_5');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_5_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_5->getClientOriginalExtension();
                $aa = $image_file_5->move($folder, $image_file_5_cerf);

                $image_file_5_image_name = $image_file_5_cerf;
                $image_file_5_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_5_image_name;

                $certificateData['certificate_image_5'] = $image_file_5_cerf;
                $certificateData['certificate_type_5'] = $request->certificate_type_5;
            }
            // certificate 6
            if ($request->file('certificate_image_6')) {
                $image_file_6 = $request->file('certificate_image_6');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_6_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_6->getClientOriginalExtension();
                $aa = $image_file_6->move($folder, $image_file_6_cerf);

                $image_file_6_image_name = $image_file_6_cerf;
                $image_file_6_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_6_image_name;

                $certificateData['certificate_image_6'] = $image_file_6_cerf;
                $certificateData['certificate_type_6'] = $request->certificate_type_6;
            }
            // certificate 7
            if ($request->file('certificate_image_7')) {
                $image_file_7 = $request->file('certificate_image_7');
                $folder = public_path('images/product/certificate/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_7_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_7->getClientOriginalExtension();
                $aa = $image_file_7->move($folder, $image_file_7_cerf);

                $image_file_7_image_name = $image_file_7_cerf;
                $image_file_7_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_7_image_name;

                $certificateData['certificate_image_7'] = $image_file_7_cerf;
                $certificateData['certificate_type_7'] = $request->certificate_type_7;
            }





        $dataset_2['req'] =  $request->except(['image_1', 'image_2', 'image_3','image_4','image_5']);


        // session()->put('dataset_2', $dataset_2);
        $dataset_2= json_encode($dataset_2);
        $certificateData= json_encode($certificateData);

        $dataset_1 = $request->session()->get('dataset_1');
        $language = $request->session()->get('weblangauge');


        //print_r($certificateData);die('ds');
        $templatename = 'name_en  as name';
        if ($language == 'kn') {
            $templatename = 'name_kn  as name';
        }
        $template = ProductTemplate::where(['id'=>$dataset_1['tempalte_id']])
        ->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->first();
        return view('frontend.user.addproduct_final', ['template' => $template, 'dataset_2'=>$dataset_2,'certificateData'=>$certificateData]);
    }


    public function addproduct_to_db(Request $request)
    {
        $dataset_1 = $request->session()->get('dataset_1');

        // $dataset_2 = $request->session()->get('dataset_2');
        $dataset_2 = json_decode($request->dataset_2, true);
        $certificateAllData = json_decode($request->certificateData, true);

        $input = $request->all();

        //dd($dataset_2);
        $input['categoryId'] = $dataset_1['categoryId'];
        $input['subcategoryId'] = $dataset_1['subcategoryId'];
        $input['material_id'] = $dataset_1['material_id'];
        $input['template_id'] = $dataset_1['tempalte_id'];
        $input['price'] = $dataset_1['price'];
        $input['price_unit'] = $dataset_1['price_unit'];
        $input['qty'] = $dataset_1['qty'];
        $input['localname_en'] = $dataset_1['localname_en'];
        $input['localname_kn'] = $dataset_1['localname_kn'];


        if (isset($dataset_2['image_1'])) {
            $input['image_1'] = $dataset_2['image_1'];
        }
        if (isset($dataset_2['image_2'])) {
            $input['image_2'] = $dataset_2['image_2'];
        }
        if (isset($dataset_2['image_3'])) {
            $input['image_3'] = $dataset_2['image_3'];
        }
        if (isset($dataset_2['image_4'])) {
            $input['image_4'] = $dataset_2['image_4'];
        }
        if (isset($dataset_2['image_5'])) {
            $input['image_5'] = $dataset_2['image_5'];
        }

        if (isset($dataset_2['req']['length'])) {
            $input['length'] = $dataset_2['req']['length'];
            $input['length_unit'] = $dataset_2['req']['length_unit'];
        }
        if (isset($dataset_2['req']['width'])) {
            $input['width'] = $dataset_2['req']['width'];
            $input['width_unit'] = $dataset_2['req']['width_unit'];
        }
        if (isset($dataset_2['req']['height'])) {
            $input['height'] = $dataset_2['req']['height'];
            $input['height_unit'] = $dataset_2['req']['height_unit'];
        }
        if (isset($dataset_2['req']['vol'])) {
            $input['vol'] = $dataset_2['req']['vol'];
            $input['vol_unit'] = $dataset_2['req']['vol_unit'];
        }
        if (isset($dataset_2['req']['weight'])) {
            $input['weight'] = $dataset_2['req']['weight'];
            $input['weight_unit'] = $dataset_2['req']['weight_unit'];
        }

        if (isset($dataset_2['req']['video_url'])) {
            $input['video_url'] = $dataset_2['req']['video_url'];
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $product = ProductMaster::where(['user_id' => $user->id, 'is_draft' => 1])->first();


        if ($product && ($input['submit'] == 'draft')) {
            return redirect()->back()->withErrors('You have already product in your draft, Please add or remove from draft.');
        } elseif ($input['submit'] == 'draft') {
            $input['is_draft'] = 1;
        } else {
            $input['is_draft'] = 0;
        }

        $addProduct = ProductMaster::create($input);
        $str_result = str_pad($addProduct->id, 5, "0", STR_PAD_LEFT);
        $productShowId = 'PDX'.$str_result;
        $addProduct->update(['product_id_d' => $productShowId]);
        
        if(count($certificateAllData)>0 ){
            $certificateAllData['product_id'] = $addProduct->id;
            $chkAlreadyCer = ProductCertification::where('product_id',$addProduct->id)->first();
            if($chkAlreadyCer){
                 $chkAlreadyCer->update($certificateAllData);
            }else{
                $insertData = ProductCertification::create($certificateAllData);

            }
           
        }
        return redirect('/profile/home');
    }


    public function editproduct(Request $request, $id)
    {
        $id = decrypt($id);
        //check id with user
        $productData  = ProductMaster::where(['id'=>$id, 'user_id' => Auth::user()->id])->first();

        if ($productData) {
            $language = $request->session()->get('weblangauge');
            $catname = 'name_en  as name';
            $material_name = 'name_en  as name';
            $templatename = 'name_en as name';
            if ($language == 'kn') {
                $catname = 'name_kn  as name';
                $material_name = 'name_kn  as name';
                $templatename = 'name_kn as name';
            }
            $productData  = ProductMaster::where('id', $id)->first();
            $categoryData = Category::select('id', $catname)->where('parent_id', 0)->get();
            $subcategoryData = Category::select('id', $catname)->where('parent_id', $productData->categoryId)->get();
            $materials = Material::where('subcategory_id', $productData->subcategoryId)->select($material_name, 'id')->get();


            $template = ProductTemplate::where(['category_id' => $productData->categoryId, 'subcategory_id' => $productData->subcategoryId, 'material_id' => $productData->material_id ])
                ->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->get();

            //dd($template);

            return view('frontend.user.editproduct', ['categoryData'=>$categoryData,'productData'=>$productData,'subcategoryData'=>$subcategoryData,'materials'=>$materials,'template'=>$template]);
        } else {
            abort(404);
        }
    }


    public function editproduct_step_2(Request $request, $id)
    {
        $id = decrypt($id);
        //Set Validation on Product with steps
        //dd($request->all());
        $productData  = ProductMaster::where(['id'=>$id, 'user_id' => Auth::user()->id])->first();

        if ($productData) {
            $validator = Validator::make($request->all(), [
            'categoryId'    => 'required',
            'subcategoryId' => 'required',
            'material_id'   => 'required',
            'tempalte_id'   =>'required',
            'price' => 'required',
            'qty' => 'required',
            'localname_en' => 'required',
            'localname_kn' => 'required'



        ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $dataset_1 = $request->all();
            session()->put('dataset_1', $dataset_1);
            $language = $request->session()->get('weblangauge');
            $templatename = 'name_en  as name';
            if ($language == 'kn') {
                $templatename = 'name_kn  as name';
            }
            $template = ProductTemplate::where(['id'=>$request->tempalte_id])
        ->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->first();
            $productData  = ProductMaster::with('getCertificate')->where('id', $id)->first();
            //print_r($productData);die;
            $cname = 'name_en  as name';
            if ($language == 'kn') {
                $cname = 'name_hi  as name';
               
            }
            $typeList = CertificateType::select('id',$cname)->get();

            return view('frontend.user.editproduct_2', ['dataset_1'=>$dataset_1,'template' => $template,'productData'=>$productData,'typeList'=>$typeList]);
        } else {
            abort(404);
        }
    }

    public function editprpduct_final(Request $request, $id)
    {
        $id = decrypt($id);
        //dd($request->all());
        $productData  = ProductMaster::where(['id'=>$id, 'user_id' => Auth::user()->id])->first();
        if ($productData) {
            $productData  = ProductMaster::where('id', $id)->first();

            /** Upload Images */
            $user = Auth::user();
            if ($request->file('image_1')) {
                $image_file_1 = $request->file('image_1');
                $folder = public_path('images/product/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }
                $image_file_1_image = date('YmdHis') . rand(111, 9999). "productimage1." . $image_file_1->getClientOriginalExtension();
                $aa = $image_file_1->move($folder, $image_file_1_image);

                $image_file_1_image_name = $image_file_1_image;
                $image_file_1_image = 'images/product/'.$user->id.'/'.$image_file_1_image_name;

                $dataset_2['image_1'] = $image_file_1_image;
            }
            /** Upload Image 2 */
            if ($request->file('image_2')) {
                $image_file_2 = $request->file('image_2');
                $folder = public_path('images/product/' . $user->id . '/');
                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }
                $image_file_2_image = date('YmdHis') . rand(111, 9999). "productimage2." . $image_file_2->getClientOriginalExtension();
                $aa = $image_file_2->move($folder, $image_file_2_image);
                $image_file_2_image_name = $image_file_2_image;
                $image_file_2_image = 'images/product/'.$user->id.'/'.$image_file_2_image_name;
                $dataset_2['image_2'] = $image_file_2_image;
            }


            /** Upload Image 3 */

            if ($request->file('image_3')) {
                $image_file_3 = $request->file('image_3');
                $folder = public_path('images/product/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_3_image = date('YmdHis') . rand(111, 9999). "productimage3." . $image_file_3->getClientOriginalExtension();
                $aa = $image_file_3->move($folder, $image_file_3_image);

                $image_file_3_image_name = $image_file_3_image;
                $image_file_3_image = 'images/product/'.$user->id.'/'.$image_file_3_image_name;

                $dataset_2['image_3'] = $image_file_3_image;
            }


            /** Upload Image 4 */

            if ($request->file('image_4')) {
                $image_file_4 = $request->file('image_4');
                $folder = public_path('images/product/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_4_image = date('YmdHis') . rand(111, 9999). "productimage4." . $image_file_4->getClientOriginalExtension();
                $aa = $image_file_4->move($folder, $image_file_4_image);

                $image_file_4_image_name = $image_file_4_image;
                $image_file_4_image = 'images/product/'.$user->id.'/'.$image_file_4_image_name;

                $dataset_2['image_4'] = $image_file_4_image;
            }

            /** Upload Image 5 */

            if ($request->file('image_5')) {
                $image_file_5 = $request->file('image_5');
                $folder = public_path('images/product/' . $user->id . '/');

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder, 0775, true, true);
                }

                $image_file_5_image = date('YmdHis') . rand(111, 9999)."productimage5." . $image_file_5->getClientOriginalExtension();
                $aa = $image_file_5->move($folder, $image_file_5_image);

                $image_file_5_image_name = $image_file_5_image;
                $image_file_5_image = 'images/product/'.$user->id.'/'.$image_file_5_image_name;

                $dataset_2['image_5'] = $image_file_5_image;
            }




            $dataset_2['req'] =  $request->except(['image_1', 'image_2', 'image_3','image_4','image_5']);




            //$dataset_2 = $request->all();
            // dd()

            if ($request->img1 || $request->image_1) {
                if (!$request->file('image_1')) {
                    $dataset_2['image_1'] = $request->img1;
                }
            } else {
                $dataset_2['image_1'] = null;
            }

            if ($request->img2 || $request->image_2) {
                if (!$request->file('image_2')) {
                    $dataset_2['image_2'] = $request->img2;
                }
            } else {
                $dataset_2['image_2'] = null;
            }

            if ($request->img3 || $request->image_3) {
                if (!$request->file('image_3')) {
                    $dataset_2['image_3'] = $request->img3;
                }
            } else {
                $dataset_2['image_3'] = null;
            }

            if ($request->img4 || $request->image_4) {
                if (!$request->file('image_4')) {
                    $dataset_2['image_4'] = $request->img4;
                }
            } else {
                $dataset_2['image_4'] = null;
            }

            if ($request->img5 || $request->image_5) {
                if (!$request->file('image_5')) {
                    $dataset_2['image_5'] = $request->img5;
                }
            } else {
                $dataset_2['image_5'] = null;
            }

            $certificateData =[];
             //add certificate
        if ($request->file('certificate_image_1')) {
            $image_file_1 = $request->file('certificate_image_1');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_1_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_1->getClientOriginalExtension();
            $aa = $image_file_1->move($folder, $image_file_1_cerf);

            $image_file_1_image_name = $image_file_1_cerf;
            $image_file_1_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_1_image_name;

            $certificateData['certificate_image_1'] = $image_file_1_cerf;
            $certificateData['certificate_status_1'] = 0; //pending
            
        }

        if ($request->file('certificate_image_2')) {
            $image_file_2 = $request->file('certificate_image_2');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_2_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_2->getClientOriginalExtension();
            $aa = $image_file_2->move($folder, $image_file_2_cerf);

            $image_file_2_image_name = $image_file_2_cerf;
            $image_file_2_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_2_image_name;

            $certificateData['certificate_image_2'] = $image_file_2_cerf;
            $certificateData['certificate_status_2'] = 0;  
        }
        if ($request->file('certificate_image_3')) {
            $image_file_3 = $request->file('certificate_image_3');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_3_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_3->getClientOriginalExtension();
            $aa = $image_file_3->move($folder, $image_file_3_cerf);

            $image_file_3_image_name = $image_file_3_cerf;
            $image_file_3_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_3_image_name;

            $certificateData['certificate_image_3'] = $image_file_3_cerf;
            $certificateData['certificate_status_3'] = 0;
        }
        if ($request->file('certificate_image_4')) {
            $image_file_4 = $request->file('certificate_image_4');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_4_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_4->getClientOriginalExtension();
            $aa = $image_file_4->move($folder, $image_file_4_cerf);

            $image_file_4_image_name = $image_file_4_cerf;
            $image_file_4_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_4_image_name;

            $certificateData['certificate_image_4'] = $image_file_4_cerf;
            $certificateData['certificate_status_4'] = 0;
        }
        if ($request->file('certificate_image_5')) {
            $image_file_5 = $request->file('certificate_image_5');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_5_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_5->getClientOriginalExtension();
            $aa = $image_file_5->move($folder, $image_file_5_cerf);

            $image_file_5_image_name = $image_file_5_cerf;
            $image_file_5_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_5_image_name;

            $certificateData['certificate_image_5'] = $image_file_5_cerf;
            $certificateData['certificate_status_5'] = 0;
            
        }
        if ($request->file('certificate_image_6')) {
            $image_file_6 = $request->file('certificate_image_6');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_6_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_6->getClientOriginalExtension();
            $aa = $image_file_6->move($folder, $image_file_6_cerf);

            $image_file_6_image_name = $image_file_6_cerf;
            $image_file_6_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_6_image_name;

            $certificateData['certificate_image_6'] = $image_file_6_cerf;
            $certificateData['certificate_status_6'] = 0;
            
        }
        if ($request->file('certificate_image_7')) {
            $image_file_7 = $request->file('certificate_image_7');
            $folder = public_path('images/product/certificate/' . $user->id . '/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $image_file_7_cerf = date('YmdHis') . rand(111, 9999). "certificate1." . $image_file_7->getClientOriginalExtension();
            $aa = $image_file_7->move($folder, $image_file_7_cerf);

            $image_file_7_image_name = $image_file_7_cerf;
            $image_file_7_cerf = 'images/product/certificate/'.$user->id.'/'.$image_file_7_image_name;

            $certificateData['certificate_image_7'] = $image_file_7_cerf;
            $certificateData['certificate_status_7'] = 0;
            
        }
        $certificateData['certificate_type_1'] = isset($request->certificate_type_1)?$request->certificate_type_1:null;
        $certificateData['certificate_type_2'] = isset($request->certificate_type_2)?$request->certificate_type_2:null;
        $certificateData['certificate_type_3'] = isset($request->certificate_type_3)?$request->certificate_type_3:null;
        $certificateData['certificate_type_4'] = isset($request->certificate_type_4)?$request->certificate_type_4:null;
        $certificateData['certificate_type_5'] = isset($request->certificate_type_5)?$request->certificate_type_5:null;
        $certificateData['certificate_type_6'] = isset($request->certificate_type_6)?$request->certificate_type_6:null;
        $certificateData['certificate_type_7'] = isset($request->certificate_type_7)?$request->certificate_type_7:null;

        if ($request->cimg1 || $request->certificate_image_1) {
            if (!$request->file('certificate_image_1')) {
                $certificateData['certificate_image_1'] = $request->cimg1;
            }
        } else {
            $certificateData['certificate_image_1'] = null;
            $certificateData['certificate_status_1'] = 0;
            
        }

        if ($request->cimg2 || $request->certificate_image_2) {
            if (!$request->file('certificate_image_2')) {
                $certificateData['certificate_image_2'] = $request->cimg2;
            }
        } else {
            $certificateData['certificate_image_2'] = null;
            $certificateData['certificate_status_2'] = 0;
            
        }
        if ($request->cimg3 || $request->certificate_image_3) {
            if (!$request->file('certificate_image_3')) {
                $certificateData['certificate_image_3'] = $request->cimg3;
            }
        } else {
            $certificateData['certificate_image_3'] = null;
            $certificateData['certificate_status_3'] = 0;
            
        }
        if ($request->cimg4 ||$request->certificate_image_4) {
            if (!$request->file('certificate_image_4')) {
                $certificateData['certificate_image_4'] = $request->cimg4;
            }
        } else {
            $certificateData['certificate_image_4'] = null;
            $certificateData['certificate_status_4'] = 0;
            
        }
        if ($request->cimg5 || $request->certificate_image_5) {
            if (!$request->file('certificate_image_5')) {
                $certificateData['certificate_image_5'] = $request->cimg5;
            }
        } else {
            $certificateData['certificate_image_5'] = null;
            $certificateData['certificate_status_5'] = 0;
            
        }

        if ($request->cimg6 || $request->certificate_image_6) {
            if (!$request->file('certificate_image_6')) {
                $certificateData['certificate_image_6'] = $request->cimg6;
            }
        } else {
            $certificateData['certificate_image_6'] = null;
            $certificateData['certificate_status_6'] = 0;
            
        }

        if ($request->cimg7 || $request->certificate_image_7) {
            if (!$request->file('certificate_image_7')) {
                $certificateData['certificate_image_7'] = $request->cimg7;
            }
        } else {
            $certificateData['certificate_image_7'] = null;
            $certificateData['certificate_status_7'] = 0;
            
        }

            $dataset_2  =  json_encode($dataset_2);
            $certificateData  =  json_encode($certificateData);
           
            //dd($dataset_2 = $request->session()->get('dataset_2'));
            $dataset_1 = $request->session()->get('dataset_1');
            $language = $request->session()->get('weblangauge');
            $templatename = 'name_en  as name';
            if ($language == 'kn') {
                $templatename = 'name_kn  as name';
            }

            $product = ProductMaster::where(['user_id' => $user->id, 'is_draft' => 1])->first();
            
            
            
            
            if ($product) {
                if ($product->id == $id) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            } else {
                $flag = 1;
            }

           


            $template = ProductTemplate::where(['id'=>$dataset_1['tempalte_id']])->select($templatename, 'id', 'description_en', 'description_kn', 'length', 'width', 'height', 'weight', 'volume')->first();
            return view('frontend.user.editproduct_final', ['template' => $template, 'productData'=> $productData,'dataset_2'=>$dataset_2,'certificateData'=>$certificateData,'flag'=>$flag]);
        } else {
            abort(404);
        }
    }


    public function editproduct_to_db(Request $request, $id)
    {
        $id = decrypt($id);
        $productData  = ProductMaster::where(['id'=>$id, 'user_id' => Auth::user()->id])->first();
        if ($productData) {
            $dataset_1 = $request->session()->get('dataset_1');

            
            // $dataset_2 = $request->session()->get('dataset_2');
            $input = $request->all();

            $dataset_2 = json_decode($request->dataset_2, true);
            $certificateAllData = json_decode($request->certificateData, true);
             //dd($certificateAllData);

            $input['categoryId'] = $dataset_1['categoryId'];
            $input['subcategoryId'] = $dataset_1['subcategoryId'];
            $input['material_id'] = $dataset_1['material_id'];
            $input['template_id'] = $dataset_1['tempalte_id'];
            $input['price'] = $dataset_1['price'];
            $input['price_unit'] = $dataset_1['price_unit'];
            $input['qty'] = $dataset_1['qty'];
            $input['localname_en'] = $dataset_1['localname_en'];
            $input['localname_kn'] = $dataset_1['localname_kn'];



            //if (isset($dataset_2['image_1'])) {
            $input['image_1'] = $dataset_2['image_1'];
            //}
            // if (isset($dataset_2['image_2'])) {
            $input['image_2'] = $dataset_2['image_2'];
            //}
            //if (isset($dataset_2['image_3'])) {
            $input['image_3'] = $dataset_2['image_3'];
            // }
            //if (isset($dataset_2['image_4'])) {
            $input['image_4'] = $dataset_2['image_4'];
            //}
            //if (isset($dataset_2['image_5'])) {
            $input['image_5'] = $dataset_2['image_5'];
            //}



            if (isset($dataset_2['req']['length'])) {
                $input['length'] = $dataset_2['req']['length'];
                $input['length_unit'] = $dataset_2['req']['length_unit'];
            }
            if (isset($dataset_2['req']['width'])) {
                $input['width'] = $dataset_2['req']['width'];
                $input['width_unit'] = $dataset_2['req']['width_unit'];
            }
            if (isset($dataset_2['req']['height'])) {
                $input['height'] = $dataset_2['req']['height'];
                $input['height_unit'] = $dataset_2['req']['height_unit'];
            }
            if (isset($dataset_2['req']['vol'])) {
                $input['vol'] = $dataset_2['req']['vol'];
                $input['vol_unit'] = $dataset_2['req']['vol_unit'];
            }
            if (isset($dataset_2['req']['weight'])) {
                $input['weight'] = $dataset_2['req']['weight'];
                $input['weight_unit'] = $dataset_2['req']['weight_unit'];
            }
            //dd($input);

            if (isset($dataset_2['req']['video_url'])) {
                $input['video_url'] = $dataset_2['req']['video_url'];
            }
            ///dd($input);




            $user = Auth::user();
            $input['user_id'] = $user->id;


            $product = ProductMaster::where(['user_id' => $user->id, 'is_draft' => 1])->first();

           


            if ($input['submit'] == 'draft') {
                $input['is_draft'] = 1;
            } else {
                $input['is_draft'] = 0;
            }
            $submit_name = $input['submit'];
            unset($input['_token']);
            unset($input['submit']);
            unset($input['shgartisanId']);
            unset($input['dataset_2']);
            unset($input['certificateData']);



            $updatedraftproduct = ProductMaster::where('id', $id)->update($input);
            $chkAlreadyCer = ProductCertification::where('product_id',$id)->first();
            if($chkAlreadyCer){
                 $chkAlreadyCer->update($certificateAllData);
            }else{
                    $certificateAllData['product_id'] = $id;
                    $insertData = ProductCertification::create($certificateAllData);

                

            }
            return redirect('/profile/home');
        } else {
            abort(404);
        }
    }



  
    
}
