<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\parameters;
use App\Models\vendor_master;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;
use Excel;

class vendorMaster extends Controller
{
    public $city_master;
    public $vendorCodeSeq;
    public $suply_type;
    public $max_vendor_code;
    public $vendor_master_data;
    public function __construct()
    {
        $this->city_master = city::pluck('city_name','city_id');
                           
        $this->vendor_master_data= vendor_master::all()->where('status','=' ,'Y');
        $this->suply_type = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'SUPP_TYPE')
                            ->pluck('list_desc','list_value');
        $this->state_master = state::pluck('state_name','state_code');
        $this->country_master = country::pluck('country_name','country_code');
        $this->vendorCodeSeq=parameters::select('param_value')->where('param_code', '=', 'USE_VENDOR_SEQ')->first();
        $this->max_vendor_code=vendor_master::max('vend_code');
    }
    public function index()
    {
        $vendorCodeSeq=$this->vendorCodeSeq->param_value;
        $suply_type=$this->suply_type;
        $city_master=$this->city_master;
        $vendor_master_data=$this->vendor_master_data;
        return view('Master.vendor_master',['vendorCodeSeq' => $vendorCodeSeq,'suply_type' => $suply_type,'city_master' =>$city_master,'vendor_master_data' => $vendor_master_data]);
    }

    public function vendorCityChange(Request $request)
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
    	$vendorCodeSeq=$this->vendorCodeSeq->param_value;
        if($vendorCodeSeq=='Y')
        {
            $vendseqvalid=0;
            $max_vend_code=$this->max_vendor_code;
            $vend_codeAuto=$max_vend_code+1;
        }
        else
        {
            $vendseqvalid=1;
        }
        
        $validatedData = Validator::make($request->all(), 
        [
            'vend_code' => $vendseqvalid==1 ? 'required|unique:vendor_master' : 'unique:vendor_master',
            'vend_name' => 'required',
            'type' => 'required',
            'aadr1' => 'required',
            'city' => 'required'
        ],
        [
            'vend_code.required' => 'Please Enter Code',
            'vend_code.unique' => 'Code Already Exist',
            'vend_name.required' => 'Please Enter Name',
            'type.required' => 'Please Select Type',
            'addr1.required' => 'Please Enter Address',
            'city.required' => 'Please Select City'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            vendor_master::create([
                'vend_code' => $vendseqvalid==true ? $request->vend_code : $vend_codeAuto,
                'vend_name' => $request->vend_name,
                'type' => $request->type,
                'credit_day' => $request->credit_day,
                'aadr1' => $request->aadr1,
                'addr2' => $request->addr2,
                'city' => $request->city,
                'state' => $request->statepost,
                'country' => $request->countrypost,
                'pin' => $request->pin,
                'phone' => $request->phone,
                'email' => $request->email,
                'gstin' => $request->gstin,
                'fassi_no' => $request->fassi_no,
                'aadhar_no' => $request->aadhar_no,
                'pan_no' => $request->manufact_code,
                'contact_person' => $request->contact_person,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
