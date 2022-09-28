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
    public function index()
    {
        $custSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_MANUFACT_SEQ')
                                    ->get();
        $custcode=cust_master::max('cust_code');
        if($custSeq[0]['param_value']=='Y' and ($custcode==0 or $custcode==null))
        {
            $custcode=1;
        }
        $loc_code = location_master::pluck('loc_name','loc_code');
        
        $comp_city = city::select('city_id','city_name')
                           ->get();
        $city_master = city::pluck('city_name','city_id');
        $state_master = state::pluck('state_name','state_code');
        $country_master = country::pluck('country_name','country_code');
        $cust_type_master = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'CUST_TYPE')
                            ->pluck('list_desc','list_value');
        $ref_customer = cust_master::where('status', '=', 'Y')
//                            ->where('cust_code', '=', 'CUST_NAME')
                            ->pluck('cust_code','cust_name');
        $cust_masterdata= cust_master::all();

        return view('master.custMaster',['custSeq' => $custSeq,'loc_code' => $loc_code,'custcode' => $custcode,'cust_masterdata'  => $cust_masterdata, 'comp_city' => $comp_city,'city_master' => $city_master,'state_master' => $state_master,'country_master' => $country_master,'cust_type_master' => $cust_type_master,'ref_customer' => $ref_customer]);
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
        $validatedData = Validator::make($request->all(), 
        [
            'cust_code' => 'required|unique:cust_master',
            'cust_name' => 'required'
        ],
        [
            'cust_code.required' => 'Please Enter Code',
            'cust_code.unique' => 'Code Already Exist',
            'cust_name.required' => 'Please Enter Name'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            cust_master::create([
                'cust_code' => $request->cust_code,
                'cust_name' => $request->cust_name,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
