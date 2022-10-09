<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\pmt_incl_excl_master;
use App\Models\pmt_master;
use App\Models\location_master;
use Illuminate\Support\Facades\Validator;
use Response;

class pmtinclexclMaster extends Controller
{
    public function index()
    {
        $pmt_code = pmt_master::where('status', '=', 'Y')
                            ->pluck('pmt_name','pmt_code');

        $comp_city = city::pluck('city_name','city_id');
                           
        $comp_pmt_incl_excl_master= pmt_incl_excl_master::all();

//        $trans_type_master = pmt_master::where('status', '=', 'Y')
//                            ->where('list_code', '=', 'COMP_TYPE')
//                            ->pluck('pmt_name','pmt_code');
        
        $state_master = state::pluck('state_name','state_code');
        
        $country_master = country::pluck('country_name','country_code');                 
        
        return view('master.pmt_incl_excl_master',['pmt_code' => $pmt_code,'comp_city' => $comp_city,'comp_pmt_incl_excl_master'  => $comp_pmt_incl_excl_master,'state_master' => $state_master,'country_master' => $country_master]);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'pmt_code' => 'required|unique:pmt_incl_excl_master',
            'trans_code' => 'required',
            'incl_excl' => 'required'
        ],
        [
            'pmt_code.required' => 'Please Enter Payment Code',
            'pmt_code.unique' => 'Code Already Exist',
            'trans_code.required' => 'Please Enter Transaction Code',
            'incl_excl.required' => 'Please Select Include/Exclude Criteria'            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            pmt_incl_excl_master::create([
                'pmt_code' => $request->pmt_code,
                'trans_type' => $request->trans_type,
                'trans_code' => $request->trans_code,
                'incl_excl' => $request->incl_excl,
                //'country_code' => $request->countrypost,
                'pin' => $request->pin,
                'phone_no' => $request->phone_no,
                'gstin' => $request->gstin,
                'bank_code' => $request->bank_code,
                'bankacno' => $request->bankacno,
                'status' =>'Y',
                'created_by' => Session::get('useremail'),
                'updated_by' => Session::get('useremail'),
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
