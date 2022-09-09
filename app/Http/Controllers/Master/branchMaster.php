<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\location_master;
use Illuminate\Support\Facades\Validator;
use Response;

class branchMaster extends Controller
{
    public function index()
    {
        
        $comp_city = city::pluck('city_name','city_id');
                           
        $comp_location_master= location_master::all();
        $comp_type_master = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'COMP_TYPE')
                            ->pluck('list_desc','list_value');
        $state_master = state::pluck('state_name','state_code');
        $country_master = country::pluck('country_name','country_code');                 
        return view('master.branch_master',['comp_city' => $comp_city,'comp_location_master'  => $comp_location_master,'state_master' => $state_master,'country_master' => $country_master,'comp_type_master' => $comp_type_master]);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'loc_code' => 'required|unique:location_master',
            'loc_no' => 'required',
            'loc_name' => 'required',
            'addr1' => 'required',
            'addr2' => 'required',
            'city' => 'required'
        ],
        [
            'loc_code.required' => 'Please Enter Location Code',
            'loc_code.unique' => 'Code Already Exist',
            'loc_no.required' => 'Please Enter Location No',
            'loc_name.required' => 'Please Enter Location Name',
            'addr1.required' => 'Please Enter Address',
            'addr2.required' => 'Please Enter Address',
            'city.required' => 'Please Select city'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            location_master::create([
                'loc_code' => $request->loc_code,
                'loc_no' => $request->loc_no,
                'loc_name' => $request->loc_name,
                'addr1' => $request->addr1,
                'addr2' => $request->addr2,
                'city' => $request->city,
                'state_code' => $request->statepost,
                'country_code' => $request->countrypost,
                'pin' => $request->pin,
                'phone_no' => $request->phone_no,
                'gstin' => $request->gstin,
                'bank_code' => $request->bank_code,
                'bankacno' => $request->bankacno,
                'status' =>'1',
                'created_by' => Session::get('useremail'),
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
