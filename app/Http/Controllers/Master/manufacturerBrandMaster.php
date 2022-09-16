<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\parameters;
use App\Models\manufacturer_master;
use Response;
use PDF;
use Excel;

class manufacturerBrandMaster extends Controller
{
    public function index()
    {
        $manufSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_MANUFACT_SEQ')
                                    ->get();
        $mancode=manufacturer_master::max('manufact_code');
        if($manufSeq[0]['param_value']=='Y' and ($mancode==0 or $mancode==null))
        {
            $mancode=1;
        }
        return view('master.manufacturerBrandMaster',['manufSeq' => $manufSeq,'mancode' => $mancode]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'manufact_code' => 'required|unique:manufacturer_master',
            'manufact_name' => 'required',
            'type' => 'required'
        ],
        [
            'manufact_code.required' => 'Please Enter Code',
            'manufact_code.unique' => 'Code Already Exist',
            'manufact_name.required' => 'Please Enter Name',
            'type.required' => 'Please Select Category Type'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            manufacturer_master::create([
                'manufact_code' => $request->manufact_code,
                'manufact_name' => $request->manufact_name,
                'type' => $request->type,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
