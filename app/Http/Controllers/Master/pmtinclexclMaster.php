<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category_master;
use App\Models\sub_category_master;
use App\Models\pmt_incl_excl_master;
use App\Models\pmt_master;
use Illuminate\Support\Facades\Validator;
use Response;

class pmtinclexclMaster extends Controller
{
    public $pmt_code;
    public $comp_pmt_incl_excl_master;
    public $cat_master;
    public $sub_cat_master;
    public function __construct()
    {
        $this->cat_master = category_master::where('status', '=', 'Y')
                            ->pluck('cat_name','cat_code');
        $this->sub_cat_master = sub_category_master::where('status', '=', 'Y')
                            ->pluck('sub_cat_name','sub_cat_code');
        $this->pmt_code = pmt_master::where('status', '=', 'Y')
        ->pluck('pmt_name','pmt_code');
        $this->comp_pmt_incl_excl_master= pmt_incl_excl_master::all();
    }
    public function index()
    {                
        return view('master.pmt_incl_excl_master',['pmt_code' => $this->pmt_code,'comp_pmt_incl_excl_master'  => $this->comp_pmt_incl_excl_master]);
    }

    public function trnasTypeChange(Request $request)
    {
        $trans_type=$request->trans_type;
        if($trans_type=='CT')
        {
            $tranStypeData=$this->cat_master; 
        }
        return Response::json(['tranStypeData' => $tranStypeData]); 
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'pmt_code' => 'required|unique:pmt_incl_excl_master',
            'trans_type' => 'required',
            'trans_code' => 'required',
            'incl_excl' => 'required'
        ],
        [
            'pmt_code.required' => 'Please Select Payment Code',
            'pmt_code.unique' => 'Payment Code Already Exist',
            'trans_type.required' => 'Please Select Transaction Type',
            'trans_code.required' => 'Please Select Transaction Name',
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
                'status' =>'Y',
                'created_by' => Session::get('useremail'),
                'updated_by' => Session::get('useremail'),
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
