<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\open_stock;
use App\Models\dept_master;
use App\Models\item_barcode;
use App\Models\item_master;
use App\Models\stock_detail;

use Session;
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
        $open_stock_count = DB::table('open_stock')->where('item_code', '=', $request->item_code)->count(); // get count 
       
        $batch_no_get = DB::table('open_stock')
                        ->select('batch_no')
                        ->where('item_code', '=' , $request->item_code)
                        ->first();
        $max_batch_code=open_stock::where('item_code', '=' , $request->item_code)->max('batch_no');
        $min_batch_code=open_stock::where('item_code', '=' , $request->item_code)->min('batch_no');
    
        if($request->item_type='V')
        {
            if($max_batch_code=='')
            {
                $batch_post=-99; 
            }
            elseif($max_batch_code <> '')
            {
                $batch_post=1+$max_batch_code;
            }
        }
        elseif($request->item_type='P' or $request->item_type='L')
        {
            if($min_batch_code=='')
            {
                $batch_post=-1; 
            }
            elseif($min_batch_code <> '')
            {
                $batch_post=$min_batch_code - 1; 
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
                    'doc_type' => 'OB',
                    'comp_code' => Session::get('companycode'),
                    'status' => 'Y',
                    'created_by' => Session::get('useremail')
                ]);

                stock_detail::create([
                    'loc_Code' => Session::get('companyloc_code'),
                    'batch_no' => $batch_post,
                    'item_code' => $request->item_code,
                    'dept_code' => $request->dept_code,
                    'doc_type' => 'OB',
                    'recd_date' => null,
                    'recd_qty' => $request->qty,
                    'trf_in_qty' => null,
                    'oth_in_qty' => null,
                    'sale_qty' => null,
                    'trf_out_qty' => null,
                    'oth_out_qty' => null,
                    'bal_qty' => null,
                    'cost_rate' => null,
                    'sale_rate' => null,
                    'mrp' => null,
                    'expiry_date' => null,
                    'ven_code' => null,
                    'expiry_date' => null,
                    'oth_loc_code' => null,
                    'oth_batch_no' => null,
                    'oth_ref_date' => null,
                    'comp_code' => null,
                    'sch_narration' => null
                ]);

                return Response::json(['success' => true]);
            }
            elseif($open_stock_count <> 0)
            {
                $open_stock_exist_count = DB::table('open_stock')->where('item_code', '=', $request->item_code)->where('mrp', '=', $request->mrp)->where('sale_rate', '=', $request->sale_rate)->where('cost_rate', '=', $request->cost_rate)->count();

                if($open_stock_exist_count <> 0)
                {
                    $getQty=open_stock::select('qty')->where('item_code', '=', $request->item_code)->where('mrp', '=', $request->mrp)->where('sale_rate', '=', $request->sale_rate)->where('cost_rate', '=', $request->cost_rate)->first();
				    $getNewQty = $getQty->qty + $request->qty;
                    
                    $open_stock_update = DB::table('open_stock')
                                ->where('item_code', $request->item_code)
                                ->where('mrp', $request->mrp)
                                ->where('sale_rate', $request->sale_rate)
                                ->where('cost_rate', $request->cost_rate)
                                ->update(['qty' => $getNewQty]);
                    
                    $stock_detail_update = DB::table('stock_detail')
                                ->where('item_code', $request->item_code)
                                ->where('mrp', $request->mrp)
                                ->where('sale_rate', $request->sale_rate)
                                ->where('cost_rate', $request->cost_rate)
                                ->update(['recd_qty' => $getNewQty]);
                    
                    if($open_stock_update and $stock_detail_update)
                    {
                        return Response::json(['success' => true]);
                    }
                    else{
                        return Response::json(['error' => true]);
                    }
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
                        'doc_type' => 'OB',
                        'comp_code' => Session::get('companycode'),
                        'status' => 'Y',
                        'created_by' => Session::get('useremail')
                    ]);

                    stock_detail::create([
                        'loc_Code' => Session::get('companyloc_code'),
                        'batch_no' => $batch_post,
                        'item_code' => $request->item_code,
                        'dept_code' => $request->dept_code,
                        'doc_type' => 'OB',
                        'recd_date' => null,
                        'recd_qty' => $request->qty,
                        'trf_in_qty' => null,
                        'oth_in_qty' => null,
                        'sale_qty' => null,
                        'trf_out_qty' => null,
                        'oth_out_qty' => null,
                        'bal_qty' => null,
                        'cost_rate' => null,
                        'sale_rate' => null,
                        'mrp' => null,
                        'expiry_date' => null,
                        'ven_code' => null,
                        'expiry_date' => null,
                        'oth_loc_code' => null,
                        'oth_batch_no' => null,
                        'oth_ref_date' => null,
                        'comp_code' => null,
                        'sch_narration' => null
                    ]);

                    return Response::json(['success' => true]);
                }
            }
        }
        else{
            return Response::json(['errors' => true]);
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
