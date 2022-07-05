<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use App\User;
use App\ProductMaster;
use App\RolePermission;
use App\Permission;
use App\Role;
use App\ChatMessage;
use Auth;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Input;
use Excel;

class ChatMessageController extends Controller
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

            if (!in_array('/admin/chat-message', $permission)) {
                return redirect('admin');
            }
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $chat_message_list = ChatMessage::paginate();        
        return view('chat_msg.index', ['chat_message_list' => $chat_message_list]);
    }

    public function create($catId = false)
    {
        return view('chat_msg.add');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'msg_en'=>'required',
            'msg_hi'=>'required',            
        ]);

        if ($validator->fails()) {
            return redirect('admin/add-chat-message')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $input = $request->all();
 
            $category = ChatMessage::create($input);
            $queryStatus = "Successful";
            return redirect('admin/chat-message')->with('message', $queryStatus);
        }
    }  


    public function destroy($id, $status)
    {
       // $id = decrypt($id); 
        $input['status'] = $status;
        $individualUpdate  = ChatMessage::where('id', $id)->first();
        if ($individualUpdate) {
            $cats = $individualUpdate->update($input);
            return redirect('admin/chat-message');
        }
    }




}
