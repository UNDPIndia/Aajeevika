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
use App\Grievance;
use App\GrievanceIssueType;
use App\Survey;

use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;
use Session;

class SurveyController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        

    }

    public function index(Request $request)
    {
        $language = $request->header('language');
        $name = 'title_en  as name';
        if ($language == 'kn') {
            $name = 'title_hi  as name';
           
        }
            $surveyList = Survey::select('id','message','google_url','start_date','end_date')->get();
        return view('frontend.survey.index', ['surveyList' => $surveyList]);
    }

    

   
    public function raiseTicket(Request $request)
    {
        $language = $request->session()->get('weblangauge');
        $user_id = Auth::user()->id;// seller id
        try{
            if($request->isMethod('post')){

                $addData['user_id'] =  $user_id;
                $addData['issue_type_id'] = $request->issue_type_id;
                $addData['message'] = $request->message;
                $addGrievance = Grievance::create($addData);
                    $str_result = str_pad(1000+$addGrievance->id, 5, "0", STR_PAD_LEFT);
                $grShowId = 'TICK'.$str_result;
                $addGrievance->update(['ticket_id' => $grShowId]);
                        if($language == 'hi'){
                            $queryStatus    = "सफलतापूर्वक जोड़ा गया";
                        }else{
                            $queryStatus = "Added successfully";
                        }
                        return redirect('/grievance');
            }
           

            $name = 'title_en  as name';
            if ($language == 'kn') {
                $name = 'title_hi  as name';
               
            }
                $typeList = GrievanceIssueType::select('id',$name)->get();
            return view('frontend.grievance.raise_ticket',['typeList' => $typeList]);
        }catch(\EXCEPTION $e){
            return $e->getMessage();
        }
        
    }
    
    
}
