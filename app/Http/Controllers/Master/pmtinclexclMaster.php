<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category_master;
use App\Models\sub_category_master;
use App\Models\manufacturer_master;
use App\Models\brand_master;
use App\Models\item_master;
use App\Models\pmt_incl_excl_master;
use App\Models\pmt_master;
use Illuminate\Support\Facades\Validator;
use Response;

class pmtinclexclMaster extends Controller
{
    public $pmt_code_master;
    public $comp_pmt_incl_excl_master;
    public $cat_master;
    public $sub_cat_master;
    public $manfacmaster;
    public $brandmaster;
    public $item_master;
    public function __construct()
    {
        $this->cat_master = category_master::where('status', '=', 'Y')
                            ->pluck('cat_name','cat_code');
        $this->sub_cat_master = sub_category_master::where('status', '=', 'Y')
                            ->pluck('sub_cat_name','sub_cat_code');
        $this->manfacmaster = manufacturer_master::where('status', '=', 'Y')->pluck('manufact_name','manufact_code');
        $this->brandmaster = brand_master::where('status', '=', 'Y')->pluck('brand_name','brand_code');
        $this->item_master = item_master::where('status', '=', 'Y')->pluck('item_name','item_code');
        $this->pmt_code_master = pmt_master::where('status', '=', 'Y')
        ->pluck('pmt_name','pmt_code');
        $this->comp_pmt_incl_excl_master= pmt_incl_excl_master::all();
    }
    public function index()
    {                
        return view('master.pmt_incl_excl_master',['pmt_code_master' => $this->pmt_code_master,'comp_pmt_incl_excl_master'  => $this->comp_pmt_incl_excl_master,'cat_master' => $this->cat_master,'sub_cat_master' => $this->sub_cat_master,'brandmaster' => $this->brandmaster,'item_master' => $this->item_master ]);
    }

    public function trnasTypeChange(Request $request)
    {
        $trans_type=$request->trans_type;
        if($trans_type=='CT')
        {
            $tranStypeData=$this->cat_master; 
        }
        elseif($trans_type=='SC')
        {
            $tranStypeData=$this->sub_cat_master;
        }
        elseif ($trans_type=='M') 
        {
            $tranStypeData=$this->manfacmaster;
        }
        elseif ($trans_type=='B') 
        {
            $tranStypeData=$this->brandmaster;
        }
        elseif ($trans_type=='I') 
        {
            $tranStypeData=$this->item_master;
        }
        else{
            $tranStypeData="";
        }
        return Response::json(['tranStypeData' => $tranStypeData]); 
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'pmt_code' => 'required',
            'trans_type' => 'required',
            'trans_code' => 'required',
            'incl_excl' => 'required'
        ],
        [
            'pmt_code.required' => 'Please Select Payment Code',
            'trans_type.required' => 'Please Select Transaction Type',
            'trans_code.required' => 'Please Select Transaction',
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
