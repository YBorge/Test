<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use App\Models\cust_master;
use App\Models\parameters;
use App\Models\location_master;
use App\Models\item_barcode;
use App\Models\stock_detail;
use App\Models\item_master;
use App\Models\temp_stock_details;
use App\Models\temp_print_stock_details;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Response;


class PointofSale extends Controller
{
    public $sysDate;
    public $custcode;
    public $otpCop;
    public $item_master_data;
    public $machineName;
    public function __construct()
    {
        $this->custcode=cust_master::max('cust_code');
        $this->sysDate= Carbon::now("Asia/Kolkata")->format('d-m-Y');
        $this->otpCop= parameters::select('param_value')->where('param_code','=','OTP_COMP')->first();
        $this->item_master_data=item_master::pluck('item_name','item_code');
        $this->machineName=gethostname();
        
         //$sysDate=$currentTime->toDateTimeString();
    }
    public function index()
    {
         
        $sysDate = Carbon::now()->format('d-m-Y');
        $macAddr = exec('getmac');
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $this->machineName,'sysDate' => $sysDate,'otpCop' => $this->otpCop->param_value]);
    }

    public function posCustomerData(Request $request)
    {
        $Mobile=$request->Mobile;
        $getcustData=cust_master::select('cust_code','cust_name','cust_addr1','points')
                                    ->where('Mobile','=', $Mobile)
                                    ->get();
        if(sizeof($getcustData) == 0)
        {
            $Message="No Record Found for this Mobile No..!";
            return Response::json(['errors' => $Message]);
        }
        else{
            $custData=array('cust_code' => $getcustData[0]['cust_code'],'cust_name' => $getcustData[0]['cust_name'],'cust_addr1' => $getcustData[0]['cust_addr1'],'points' => $getcustData[0]['points'],'existCust' => '1');
            return Response::json(['custData' => $custData]);
        }
    }
    public function posCustomerDataOnId(Request $request)
    {
        $cust_code=$request->cust_code;
        $getcustData=cust_master::select('cust_code','cust_name','cust_addr1','points','Mobile')
                                    ->where('cust_code','=', $cust_code)
                                    ->orWhere('barcode','=', $cust_code)
                                    ->first();
       
        if(blank($getcustData))
        {
            $Message="Invalid customer-id..!";
            return Response::json(['errors' => $Message]);
        }
        else{
            $custData=array('cust_code' => $getcustData->cust_code,'cust_name' => $getcustData->cust_name,'cust_addr1' => $getcustData->cust_addr1,'points' => $getcustData->points,'Mobile' => $getcustData->Mobile,'existCust' => '1');
            return Response::json(['custData' => $custData]);
        }
    }
    public function itemData(Request $request)
    {
        
        $barcode=$request->barcode;
        $getItemCode=item_barcode::select('item_code')->where('barcode',$barcode)->first();
        $stocDetails=DB::table('stock_detail')->select('item_code','batch_no','mrp','sale_rate','recd_date','stock_id',DB::raw('SUM(bal_qty) AS sum_bal_qty'))->where('item_code',$getItemCode->item_code)->where('bal_qty','>',0)
            ->groupBy('mrp')
            ->groupBy('item_code')
            ->groupBy('batch_no')
            ->groupBy('sale_rate')
            ->groupBy('recd_date')
            ->groupBy('stock_id')
            ->orderBy('stock_id')
            ->get();
            $mytime = Carbon::now();
            $sysDate=$mytime->toDateTimeString();
            $countVal=count($stocDetails);
            $existCount=DB::table('temp_stock_details')->select('id')->where('t_item_code',$getItemCode->item_code)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->get();
            $tempstockdata=count($existCount); $insertTempPrintDetails="false";
            if ($tempstockdata==0) 
            { 
                foreach($stocDetails as $value)
                {
                    temp_stock_details::create([
                        't_barcode' => $barcode,
                        't_stock_id' => $value->stock_id,
                        't_item_code' => $value->item_code,
                        't_batch_no' => $value->batch_no,
                        't_mrp' => $value->mrp,
                        't_sale_rate' => $value->sale_rate,
                        't_sum_bal_qty' => $value->sum_bal_qty,
                        't_updatedby' => Session::get('useremail'),
                        't_machine_name' => $this->machineName,
                        'created_at' => $sysDate,
                        'updated_at' => $sysDate
                    ]);
                    if ($countVal==1) 
                    {
                        
                        $insertTempPrint=temp_print_stock_details::create([
                            't_stock_id' => $value->stock_id,
                            't_item_code' => $value->item_code,
                            't_barcode' => $barcode,
                            't_batch_no' => $value->batch_no,
                            't_mrp' => $value->mrp,
                            't_sale_rate' => $value->sale_rate,
                            't_sum_bal_qty' => 1,
                            't_updatedby' => Session::get('useremail'),
                            't_machine_name' => $this->machineName,
                            'created_at' => $this->sysDate,
                            'updated_at' => $this->sysDate
                        ]);
                        if ($insertTempPrint==true) 
                        {
                            $insertTempPrintDetails="true";
                        }
                    }
                }
            }
            $updateTprint="0";
            $getExistCount=temp_print_stock_details::select('t_sum_bal_qty')->where('t_item_code',$getItemCode->item_code)->where('t_barcode',$barcode)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->get();
            $CheckCount=count($getExistCount);
            if ($countVal==1) 
            {
                if ($CheckCount == 1 and $insertTempPrintDetails=="false") 
                {
                    $updateTprint=temp_print_stock_details::where('t_barcode', $barcode)->where('t_item_code',$getItemCode->item_code)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)
                        ->update([
                            't_sum_bal_qty' => $getExistCount[0]['t_sum_bal_qty'] + 1
                        ]);
                }
            }
            //dd($insertTempPrint);
            if ($insertTempPrintDetails=="true" or $updateTprint==1) 
            {
                $getTempData=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            }
            else{
                $getTempData=temp_stock_details::select('t_stock_id','t_item_code','t_batch_no','t_mrp','t_sale_rate','t_barcode',DB::raw('SUM(t_sum_bal_qty) AS t_sum_bal_qty'))->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->where('t_item_code',$getItemCode->item_code)->groupBy('t_mrp')->groupBy('t_sale_rate')->groupBy('t_item_code')->groupBy('t_batch_no')->orderBy('t_stock_id')->get();
            }
            
            $SrNo=0;$ItemData=array();
            foreach ($getTempData as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                if ($updateTprint==1) 
                {
                    $discount=$discount * $value->t_sum_bal_qty;
                }
                $amount=$value->t_sale_rate * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $value->t_sale_rate,'amt' => round($amount,2),'SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
            } 
        return Response::json(['ItemData' => $ItemData,'countVal' => $countVal]);
        
    }

    public function itemSave(Request $request)
    {
        $barcode=$request->barcode;
        $itemCodeNew=$request->itemCodeNew;
        $itemBalQty=$request->itemBalQty;
        $mytime = Carbon::now();
        $mytime=$mytime->toDateTimeString();
        $getStockTempData=temp_stock_details::
                    select('t_item_code','t_batch_no','t_mrp','t_sale_rate')
                    ->where('t_updatedby',Session::get('useremail'))
                    ->where('t_machine_name',$this->machineName)
                    ->where('t_stock_id',$itemCodeNew)
                    ->first();
        try {
            $getExistCount=temp_print_stock_details::select('t_sum_bal_qty')->where('t_stock_id',$itemCodeNew)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->get();
            $printCount=count($getExistCount);$updateTprint=0;
            if($printCount==0)
            {
                temp_print_stock_details::create([
                    't_stock_id' => $itemCodeNew,
                    't_barcode' => $barcode,
                    't_item_code' => $getStockTempData->t_item_code,
                    't_batch_no' => $getStockTempData->t_batch_no,
                    't_mrp' => $getStockTempData->t_mrp,
                    't_sale_rate' => $getStockTempData->t_sale_rate,
                    't_sum_bal_qty' => 1,
                    't_updatedby' => Session::get('useremail'),
                    't_machine_name' => $this->machineName,
                    'created_at' =>$mytime,
                    'updated_at' => $mytime
                ]);
            }
            else{
                $updateTprint=temp_print_stock_details::where('t_barcode', $barcode)->where('t_stock_id',$itemCodeNew)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)
                ->update([
                    't_sum_bal_qty' => $getExistCount[0]['t_sum_bal_qty'] + 1
                ]);
            }
            $temp_print_stock_details=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            $SrNo=0;$ItemData=array();
            foreach ($temp_print_stock_details as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                if ($updateTprint==1) 
                {
                    $discount=$discount * $value->t_sum_bal_qty;
                }
                $amount=$value->t_sale_rate * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $value->t_sale_rate,'amt' => round($amount,2),'SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
            }
            return Response::json(['success' => true,'ItemData' => $ItemData]);
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }

    public function removeSku(Request $request)
    {
        $itemCheckId=$request->itemCheckId;
        $skuRemove=temp_print_stock_details::whereIn('id', $itemCheckId)->delete();
        if ($skuRemove) 
        {
            $temp_print_stock_details=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            $SrNo=0;$ItemData=array();
            foreach ($temp_print_stock_details as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                $discount=$discount * $value->t_sum_bal_qty;
                $amount=$value->t_sale_rate * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $value->t_sale_rate,'amt' => round($amount,2),'SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
            }
            return Response::json(['success' => true,'ItemData' => $ItemData]);
        }
        else
        {
            return Response::json(['errors' => true]);
        }
    }

    public function store(Request $request)
    {
        $Mobile=$request->Mobile;
        $homedel=$request->homedel;
        $existCust=$request->existCust;
        $custSeq=parameters::select('param_value')
                                    ->where('param_code', '=', 'USE_CUSTOMER_SEQ')
                                    ->first();
        if ($Mobile=='') 
        {
            $Message="Please Enter Mobile No..!";
            return Response::json(['errors' => $Message]);
        }
        if ($existCust=='') 
        {
            $MobileValid=1;
        }
        if($custSeq->param_value=='Y')
        {
            $autoCode=false;
            $custcode=$this->custcode+1;
        }
        else{
            $autoCode=true;
        }
        // if ($homedel=='Y' and $existCust=='') 
        // {
        //     $autoCode=true;
        // }
        $validatedData = Validator::make($request->all(), 
        [
            'Mobile' => 'required',
            'cust_code' => $autoCode==true ? 'required|unique:cust_master' : 'unique:cust_master',
            'cust_name' => $MobileValid==1 ? 'required' : '',
            'cust_addr1' => $MobileValid==1 ? 'required' : ''
        ],
        [
            'Mobile.required' => 'Please Enter Mobile No..!',
            'cust_code.required' => 'Please Enter Code..!',
            'cust_code.unique' => 'Code Already Exist..!',
            'cust_name.required' => 'Please Enter Name..!',
            'cust_addr1.required' => 'Please Enter Address..!'
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($existCust=='') 
        {
            $sysDate = Carbon::now()->format('d-m-Y');
            $mytime = Carbon::now();
            $mytime->toDateTimeString();
            $getLocData=location_master::select('city','pin','state_code','country_code')
                        ->where('loc_code','=', Session::get('companyloc_code'))
                        ->where('status','=', 'Y')
                        ->get();
            try {
                cust_master::create([
                    'cust_code' => $autoCode==true ? $request->cust_code : $custcode,
                    'cust_name' => $request->cust_name,
                    'barcode' => $request->barcode,
                    'join_date' => $sysDate,
                    'cust_addr1' => $request->cust_addr1,
                    'city' => $getLocData[0]['city'],
                    'state' => $getLocData[0]['state_code'],
                    'country' => $getLocData[0]['country_code'],
                    'pincode' => $getLocData[0]['pin'],
                    'Mobile' => $request->Mobile,
                    'points' => $request->points,
                    'status' =>'Y',
                    'created_by' => Session::get('useremail'),
                    'updated_by' => Session::get('useremail'),
                    'created_at' => $mytime,
                    'updated_at' => $mytime
                ]);
               
                return Response::json(['success' => true]);
            }
            catch (Exception $exception) {
                return Response::json(['errors' => $exception->getMessage()]);
            }
        }
    }
}
