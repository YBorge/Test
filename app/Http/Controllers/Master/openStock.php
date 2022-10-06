<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\open_stock;
use App\Models\dept_master;
use App\Models\item_barcode;
use App\Models\item_master;
use App\Models\stock_detail;
use Response;
use PDF;
use Excel;

class openStock extends Controller
{
    public $dept_code;
    public $open_stockdata;
    public function __construct()
    {
        $this->dept_code = dept_master::where('status', '=', 'Y')->pluck('dept_name','dept_code');
        $this->open_stockdata= open_stock::all();
    }
    public function index()
    {
        
        return view('master.openStock',['open_stockdata'  => $this->open_stockdata,'dept_code' => $this->dept_code]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'barcode' => 'required',
            'qty' => 'required',
            'mrp' => 'required',
            'sale_rate' => 'required',
            'cost_rate' => 'required',
            'dept_code' => 'required',
            'expiry_date' => 'required'
        ],
        [
            'barcode.required' => 'Please Enter Bar Code',
            'qty.required' => 'Please Enter Quantity',
            'mrp.required' => 'Please Enter MRP',
            'sale_rate.required' => 'Please Enter Sale Rate',
            'cost_rate.required' => 'Please Enter Cost Rate',
            'dept_code.required' => 'Please Enter Department Code',
            'expiry_date.required' => 'Please Enter Department Code'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }
        $open_stock_count = DB::table('open_stock')->where('item_code', '=', $request->item_code)->count();
        
        $batch_no_get = DB::table('open_stock')
            ->select('batch_no')
            ->where('item_code', '=' , $request->item_code)
            ->first();
        
            if($request->item_type='V')
            {
                if(!$batch_no_get)
                {
                  $batch_post=-99; 
                }
                else{
                   $batch_post=null; 
                }
            }
            elseif($request->item_type='P' or $request->item_type='L')
            {
                if(!$batch_no_get)
                {
                  $batch_post=-1; 
                }
                else{
                    $batch_post=null; 
                 }
            }
        
        if ($validatedData->passes()) 
        {
            if($open_stock_count==0)
            {
            
                open_stock::create([
                    'loc_Code' => Session::get('companyloc_code'),
                    'barcode' => $request->barcode,
                    'item_code' => $request->item_code,
                    'qty' => $request->qty,
                    'mrp' => $request->mrp,
                    'sale_rate' => $request->sale_rate,
                    'cost_rate' => $request->cost_rate,
                    'dept_code' => $request->dept_code,
                    'expiry_date' => $request->expiry_date,
                    'batch_no' => $batch_post,
                    'doc_type' => '',
                    'comp_code' => Session::get('companycode'),
                    'status' => 'Y',
                    'created_by' => Session::get('useremail')
                ]);
            }
            elseif($open_stock_count <> 0)
            {
                $open_stock_exist_count = DB::table('open_stock')->where('item_code', '=', $request->item_code)->where('mrp', '=', $request->mrp)->where('sale_rate', '=', $request->sale_rate)->where('cost_rate', '=', $request->cost_rate)->count();
                if($open_stock_exist_count > 0)
                {

                }
                elseif($open_stock_exist_count==0)
                {
                    open_stock::create([
                        'loc_Code' => Session::get('companyloc_code'),
                        'barcode' => $request->barcode,
                        'item_code' => $request->item_code,
                        'qty' => $request->qty,
                        'mrp' => $request->mrp,
                        'sale_rate' => $request->sale_rate,
                        'cost_rate' => $request->cost_rate,
                        'dept_code' => $request->dept_code,
                        'expiry_date' => $request->expiry_date,
                        'batch_no' => $batch_post,
                        'doc_type' => '',
                        'comp_code' => Session::get('companycode'),
                        'status' => 'Y',
                        'created_by' => Session::get('useremail')
                    ]);
                }
            }
            return Response::json(['success' => true]);
        }
    }

    public function getBarcode(Request $request)
    {
        $barcodedata = DB::table('item_master')
            ->select('item_master.item_code','item_master.item_name','item_master.markup','item_master.markdown','item_master.item_type')
            ->join('item_barcode', 'item_barcode.item_code', '=', 'item_master.item_code')
            ->where('item_barcode.barcode', '=' , $request->barcode)
            ->first();

        if($barcodedata)
        {
            $jsonData=array('item_code' => $barcodedata->item_code,'item_name' => $barcodedata->item_name,'markup' => $barcodedata->markup,'markdown' => $barcodedata->markdown,'item_type' => $barcodedata->item_type);
            return Response::json(['jsonData' => $jsonData]); 
        }
        else{
            return Response::json(['error' => true]);
        }
        
    }
}
