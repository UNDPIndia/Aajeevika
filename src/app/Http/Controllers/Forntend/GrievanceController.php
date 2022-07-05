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
use App\GrievanceMessage;


use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\ProductCertification;
use Session;

class GrievanceController extends Controller
{
    private $headers;
    public function __construct()
    {
        
        $this->middleware('auth');
        

    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $grievanceList = Grievance::where('user_id',$user_id)->latest()->get();
        return view('frontend.grievance.index', ['grievanceList' => $grievanceList]);
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
    public function grievanceChat(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $grievance_id = decrypt($id);
        //$grievance_row= Grievance::first(['ticket_id','status','created_at']);
        $grievance =  Grievance::find($grievance_id);
        return view('frontend.grievance.grievance_chat', ['grievanceMessages'=>$grievance]);
    }
   
    public function grievanceReply(Request $request)
    {
        //$model = new GrievanceMessage();
        $language = $request->header('language');
        
        $addData['grievance_id'] = $request->grievance_id;
        $addData['message'] = $request->message;
        $addData['type'] = 'by_user';
        $chkStatus = Grievance::where('id',$request->grievance_id)->first();
        if($chkStatus){
            if($chkStatus->status == 0){ //if open
                $addGrievance = GrievanceMessage::create($addData);
                $messageDate= date('y-m-d H:i:s');
                Grievance::where('id',$request->grievance_id)->update(['last_message_date' => $messageDate]);
                        if($language == 'hi'){
                            $queryStatus    = "सफलतापूर्वक जोड़ा गया";
                        }else{
                            $queryStatus = "Added successfully";
                        }
                        return response()->json(
                            [
                                'success' => true,
                                'message' => $queryStatus,
                            ]
                        );
            }else{
                if($language == 'hi'){
                    $queryStatus    = "इस टिकट को बंद के रूप में चिह्नित किया गया है। यदि आपकी समस्या का समाधान नहीं होता है, तो एक नया टिकट खोलें।";
                }else{
                    $queryStatus = "This ticket has been marked closed. In case if your issue is not resolved, open a new ticket.";
                }
                return response()->json(
                    [
                        'success' => true,
                        'message' => $queryStatus,
                    ]
                );
            }
           
        }
       
            
        
    }

        



  
    
}
