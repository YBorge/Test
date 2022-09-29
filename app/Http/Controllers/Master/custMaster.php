<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\parameters;
use App\Models\cust_master;
use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\location_master;
use App\Models\company_master;

use Response;
use PDF;
use Excel;

class custMaster extends Controller
{
    public $loc_code;
    public $custcode;
    public $custSeq;
    public $city_master;
    public $state_master;
    public $country_master;
    public $cust_type_master;
    public $ref_customer;
    public $cust_masterdata;
    public function __construct()
    {
        $this->loc_code=location_master::where('status', '=' ,'Y')->pluck('loc_name','loc_code');
        $this->custSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_CUSTOMER_SEQ')
                                    ->get();
        $this->custcode=cust_master::max('cust_code');
        $this->city_master = city::pluck('city_name','city_id');
        $this->state_master = state::pluck('state_name','state_code');
        $this->country_master = country::pluck('country_name','country_code');
        $this->cust_type_master = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'CUST_TYPE')
                            ->pluck('list_desc','list_value');
        $this->ref_customer = cust_master::where('status', '=', 'Y')
                            ->pluck('cust_name','cust_code');
        $this->cust_masterdata= cust_master::all();
    }
    public function index()
    {        
        return view('master.custMaster',['custSeq' => $this->custSeq,'loc_code' => $this->loc_code,'custcode' => $this->custcode,'cust_masterdata'  => $this->cust_masterdata,'city_master' => $this->city_master,'state_master' => $this->state_master,'country_master' => $this->country_master,'cust_type_master' => $this->cust_type_master,'ref_customer' => $this->ref_customer]);
    }

    public function cityChange(Request $request)
    {
        
        $city_get=$request->city;
        $comp_state_code = city::select('state_code')
                            ->where('city_id', '=', $city_get)
                            ->get();
        $comp_state = state::select('state_name','country_code')
                            ->where('state_code', '=', $comp_state_code[0]['state_code'])
                            ->get();
        $comp_country = country::select('country_name')
                            ->where('country_code', '=', $comp_state[0]['country_code'])
                            ->get();
        $DataStatecount=array('state' => $comp_state[0]['state_name'], 'comp_country' => $comp_country[0]['country_name'],'statecode' =>$comp_state_code[0]['state_code'],'countrycode' => $comp_state[0]['country_code']);
        return Response::json(['StateCount' => $DataStatecount]);                
    }

    public function store(Request $request)
    {
        if($this->custSeq[0]['param_value']=='Y')
        {
            $autoCode=false;
            $custcode=$this->custcode+1;
        }
        else{
            $autoCode=true;
        }
        $validatedData = Validator::make($request->all(), 
        [
            'loc_code' => 'required',
            'cust_code' => $autoCode==true ? 'required|unique:cust_master' : 'unique:cust_master',
            'cust_name' => 'required',
            'gender'    => 'required',
            'barcode' => 'required',
            'birth_date'    => 'required',
            'join_date' => 'required',
            'cust_addr1'    => 'required',
            'cust_addr2' => 'required',
            'city'    => 'required',
            'cust_type'    => 'required',
            'ref_cust_code'  => 'required'
        ],
        [
            'loc_code.required' => 'Please Select Location',
            'cust_code.required' => 'Please Enter Code',
            'cust_code.unique' => 'Code Already Exist',
            'cust_name.required' => 'Please Enter Name',
            'gender.required'  => 'Please Select Gender',
            'barcode.required' => 'Please Enter Barcode',
            'birth_date.required'  => 'Please Enter Birth Date',
            'join_date.required' => 'Please Select Join Date',
            'cust_addr1.required' => 'Please Enter Address 1',
            'cust_addr2.required'  => 'Please Enter Address 2',
            'city.required' => 'Please Select City',
            'cust_type.required'  => 'Please Select Customer Type',
            'ref_cust_code.required'  => 'Please Select Ref. Customer'
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        try {
            cust_master::create([
                'cust_code' => $autoCode==true ? $request->cust_code : $custcode,
                'cust_name' => $request->cust_name,
                'gender' => $request->gender,
                'barcode' => $request->barcode,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'join_date' => $request->join_date,
                'cust_addr1' => $request->cust_addr1,
                'cust_addr2' => $request->cust_addr2,
                'city' => $request->city,
                'state' => $request->statepost,
                'country' => $request->countrypost,
                'pincode' => $request->pincode,
                'Mobile' => $request->Mobile,
                'email' => $request->email,
                'pan' => $request->pan,
                'aadhar_no' => $request->aadhar_no,
                'gstin' => $request->gstin,
                'cust_type' => $request->cust_type,
                'ref_cust_code' => $request->ref_cust_code,
                'cr_limit' => $request->cr_limit,
                'cr_overdue_days' => $request->cr_overdue,
                'points' => $request->points,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }

    public function custPdf()
    {
        $cust_masterdata=$this->cust_masterdata;
        $state_master=$this->state_master;
        $country_master=$this->country_master;
        $cust_type_master=$this->cust_type_master;
        $ref_customer=$this->ref_customer;
        $mpdf= new \Mpdf\Mpdf();
        $html=\View::make('Master.cust_master_pdf')->with(compact('cust_masterdata','state_master','country_master','cust_type_master','ref_customer'));
        
        $mpdf->SetHTMLFooter('<table width="100%" style="font-size:12px;"> 
            <tr> <td colspan="2" align="center">|{PAGENO} of {nbpg}|</td>  </tr>
             </table>');
        $html=$html->render();
        $mpdf->WriteHTML($html);
        $mpdf->output('custMaster.pdf','I');
    }
}
