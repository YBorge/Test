<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\company_master;
use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use Illuminate\Support\Facades\Validator;
use Response;

class companyMaster extends Controller
{
    public function index()
    {
        $comp_type = common_list_master::select('list_desc','list_value')
                           ->where('status', '=', 'Y')
                           ->where('list_code', '=', 'COMP_TYPE')
                           ->orderBy('order_by')
                           ->get();
        $comp_city = city::select('city_id','city_name')
                           ->get();
        $comp_masterdata= company_master::all();
        $comp_type_master = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'COMP_TYPE')
                            ->pluck('list_desc','list_value');
        $city_master = city::pluck('city_name','city_id');
        $state_master = state::pluck('state_name','state_code');
        $country_master = country::pluck('country_name','country_code');                 
        return view('master.company_master',['comp_type' => $comp_type, 'comp_city' => $comp_city,'comp_masterdata'  => $comp_masterdata,'city_master' => $city_master,'state_master' => $state_master,'country_master' => $country_master,'comp_type_master' => $comp_type_master]);
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
            'comp_code' => 'required|unique:company_master',
            'txt_comname' => 'required',
            'type' => 'required',
            'addr1' => 'required',
            'city' => 'required'
        ],
        [
            'comp_code.required' => 'Please Enter Code',
            'comp_code.unique' => 'Code Already Exist',
            'txt_comname.required' => 'Please Enter Company Name',
            'type.required' => 'Please Select Type',
            'addr1.required' => 'Please Enter Address',
            'city.required' => 'Please Select city'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }
  
        if ($validatedData->passes()) 
        {
            company_master::create([
                'comp_code' => $request->comp_code,
                'comp_name' => $request->txt_comname,
                'type' => $request->type,
                'addr1' => $request->addr1,
                'addr2' => $request->addr2,
                'addr3' => $request->addr3,
                'city' => $request->city,
                'state' => $request->statepost,
                'country' => $request->countrypost,
                'std_code' => $request->std_code,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'gstin' => $request->gstin,
                'fassano' => $request->fassano,
                'cinno' => $request->cinno,
                'panno' => $request->panno,
                'tanno' => $request->tanno,
                'lsttinpinno' => $request->lsttinpinno,
                'cstno' => $request->cstno,
                'coregnno' => $request->coregnno,
                'coregndate' => $request->coregndate,
                'druglicno' => $request->druglicno,
                'importexport' => $request->importexport,
                'status' =>'1',
                'created_by' => Session::get('useremail'),
                'created_date' =>$request->coregndate,
                't_user' =>'',
                't_date' =>$request->coregndate
            ]);
           
            return Response::json(['success' => true]);
        }               
    }
}
