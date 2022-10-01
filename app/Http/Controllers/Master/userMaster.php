<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\common_list_master;
use App\Models\login;

use Response;
use PDF;
use Excel;

class userMaster extends Controller
{
	public $user_role;
	public function __construct()
	{
		$this->user_role = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'USER_ROLE')
                            ->pluck('list_value','list_id');
	}
    public function index()
    {
    	return view('master.user_master',['user_role' => $this->user_role]);
    }

    public function store(Request $request)
    {
    	$validatedData = Validator::make($request->all(), 
        [
            'user_code' => 'required|unique:login',
            'uname' => 'required',
            'upass'    => 'required',
            'role' => 'required',
            'mobile'    => 'required|unique:login',
            'email' => 'required|unique:login'
        ],
        [
            'user_code.required' => 'Please Enter User Code',
            'uname.required' => 'Please Enter User Name',
            'upass.required'  => 'Please Enter Password',
            'role.required' => 'Please Select Role',
            'mobile.required'  => 'Please Enter Mobile No',
            'mobile.unique' => 'Mobile number already exist',
            'email.required' => 'Please Enter Email Id',
            'email.unique' => 'Email Id already exist'
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
        	try {
	            login::create([
	                'user_code' => $request->user_code,
	                'uname' => $request->uname,
	                'upass' =>  Hash::make($request->upass),
	                'role' => $request->role,
	                'mobile' => $request->mobile,
	                'email' => $request->email,
	                'verification_code' => $request->upass,	
	                'status' =>'Y',
	                'created_by' => Session::get('useremail')
	            ]);
	           
            	return Response::json(['success' => true]);
	        }
	        catch (Exception $exception) {
	            return Response::json(['errors' => $exception->getMessage()]);
	        }
        }
    }
}
