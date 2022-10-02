<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\common_list_master;
use App\Models\login;
use App\Exports\userExport;

use Response;
use PDF;
use Excel;

class userMaster extends Controller
{
	public $user_role;
	public $user_data;
	public function __construct()
	{
		$this->user_role = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'USER_ROLE')
                            ->pluck('list_value','list_id');
        $this->user_data= login::all()->where('status', '=', 'Y')->where('user_id', '!=', '1');
	}
    public function index()
    {
    	return view('master.user_master',['user_role' => $this->user_role,'user_data' => $this->user_data]);
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

    public function userPdf()
    {
    	$user_role=$this->user_role;
        $user_data=$this->user_data;
        $mpdf= new \Mpdf\Mpdf();
        $html=\View::make('Master.user_master_pdf')->with(compact('user_role','user_data'));
        
        $mpdf->SetHTMLFooter('<table width="100%" style="font-size:12px;"> 
            <tr> <td colspan="2" align="center">|{PAGENO} of {nbpg}|</td>  </tr>
             </table>');
        $html=$html->render();
        $mpdf->WriteHTML($html);
        $mpdf->output('userMaster.pdf','I');
    }

    public function userMasterExcel()
    {
        return Excel::download(new userExport($this->user_role,$this->user_data),'userMaster.xlsx');
    }

    public function userMasterGetExcel($user_role,$user_data)
    {
    	$srNo=0;$arrOfStatus=array(); $arrOfStatus['Y']='Active';
    	foreach ($user_data as $key => $user) 
    	{
    		$result[] = array(++$srNo,$user->user_code,$user->uname,$user_role[$user->role]?? '-',$user->mobile,$user->email,$arrOfStatus[$user->status],$user->created_by,$user->created_at,$user->t_user,$user->updated_at);
    	}

    	return $result;
    }
}
