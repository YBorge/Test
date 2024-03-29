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
use App\Models\item_scheme_disc;
use App\Models\pos_sale;
use App\Models\pointofsaledetails;
use App\Models\pointofsalepayment;
use App\Models\pmt_master;
use App\Models\tax_master;
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
    public $pmt_master_data;
    public $machineName;
    public $is_online;

    public function __construct()
    {
        $this->custcode=cust_master::max('cust_code');
        $this->sysDate= Carbon::now("Asia/Kolkata")->format('d-m-Y');
        $this->otpCop= parameters::select('param_value')->where('param_code','=','OTP_COMP')->first();
        $this->is_online= parameters::select('param_value')->where('param_code','=','IS_ONLINE')->first();
        $this->item_master_data=item_master::pluck('item_name','item_code');
        $this->pmt_master_data=pmt_master::select('pmt_name','pmt_code','calc_on','charge_per')->where('status','Y')->get();
        $this->machineName=gethostname();
        
         //$sysDate=$currentTime->toDateTimeString();
    }
    public function index()
    {
         
        $sysDate = Carbon::now()->format('d-m-Y');
        $macAddr = exec('getmac');
        $PaymentWithCharge="0";
        $billNo=pos_sale::select("v_no")->where([['mac_id',$this->machineName],['created_by',Session::get('useremail')]])->orderBy('p_id','desc')->first();
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $this->machineName,'sysDate' => $sysDate,'otpCop' => $this->otpCop->param_value,'pmt_master_data' => $this->pmt_master_data,'PmtCharge' => $PaymentWithCharge,'billNo'=>$billNo]);
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
        if(blank($getItemCode))
        {
            $getTempData=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            $updateTprint=0;$countVal=1;$emptyItemCode=1;
        }
        else
        {
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
            if ($countVal==0 or $countVal==null) 
            {
                return Response::json(['errors' => "Stock Not Available..!"]);
            }
            $existCount=DB::table('temp_stock_details')->select('id')->where('t_item_code',$getItemCode->item_code)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->get();
            $tempstockdata=count($existCount); $insertTempPrintDetails="false";
            $getExistCount=temp_print_stock_details::select('t_sum_bal_qty')->where('t_item_code',$getItemCode->item_code)->where('t_barcode',$barcode)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->get();
            $CheckCount=count($getExistCount);
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
                            'created_at' => $sysDate,
                            'updated_at' => $sysDate
                        ]);
                        if ($insertTempPrint==true) 
                        {
                            $insertTempPrintDetails="true";
                        }
                    }
                }
            }
            $updateTprint="0";
           
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
            elseif ($countVal==0 or $countVal==null) {
                $insertTempPrintDetails="true";
            }
            
            if ($insertTempPrintDetails=="true" or $updateTprint==1) 
            {
                $getTempData=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            }
            else{
                $getTempData=temp_stock_details::select('t_stock_id','t_item_code','t_batch_no','t_mrp','t_sale_rate','t_barcode',DB::raw('SUM(t_sum_bal_qty) AS t_sum_bal_qty'))->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->where('t_item_code',$getItemCode->item_code)->groupBy('t_mrp')->groupBy('t_sale_rate')->groupBy('t_item_code')->groupBy('t_batch_no')->orderBy('t_stock_id')->get();
            }
            $emptyItemCode=0;
        }
            
            $SrNo=0;$ItemData=array();$arrOft_barcode=array();$arrOf_t_sum_bal_qty=array();$arrOf_amountp=array();$arrOf_totalMrp=array();$arrof_Discount=array();$arrof_sale_rate=array();
            foreach ($getTempData as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                if ($updateTprint==1) 
                {
                    $discount=$discount * $value->t_sum_bal_qty;
                }
                $item_scheme_disc=item_scheme_disc::select('disc_perc','disc_amt','promo_code','calc_on','fix_rate')->where('item_code',$value->t_item_code)->first();
                if (!blank($item_scheme_disc)) 
                {
                    if ($item_scheme_disc->calc_on =='S') 
                    {
                        $calcOnMrpSale=$value->t_sale_rate;
                    }else if($item_scheme_disc->calc_on =='M') 
                    {
                        $calcOnMrpSale=$value->t_mrp;
                    }
                    if ($item_scheme_disc->promo_code=='P') 
                    {
                        if ($item_scheme_disc->disc_perc!=null)
                        {
                            $discount=$discount + ($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $perCentAmt=($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $sale_rate_disp=round($calcOnMrpSale - $perCentAmt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    else if ($item_scheme_disc->promo_code=='A')
                    {
                        if ($item_scheme_disc->disc_amt!=null) 
                        {
                            $discount=$discount + ($item_scheme_disc->disc_amt * $value->t_sum_bal_qty);
                            $sale_rate_disp=round($calcOnMrpSale - $item_scheme_disc->disc_amt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    elseif ($item_scheme_disc->promo_code=='F') 
                    {
                        $discount=$discount + ($calcOnMrpSale - $item_scheme_disc->fix_rate);
                        $sale_rate_disp=round($item_scheme_disc->fix_rate,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                else
                {
                    $sale_rate_disp=round($value->t_sale_rate,2);
                    $amount=round($value->t_sale_rate * $value->t_sum_bal_qty,2);
                }
                
                $totalMrpCal=$value->t_mrp * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $sale_rate_disp ?? '-','amt' => $amount ?? '-','SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
                $arrOft_barcode[]=$value->t_barcode;
                $arrOf_t_sum_bal_qty[]=$value->t_sum_bal_qty;
                $arrOf_amountp[]=$amount ?? '-';
                $arrOf_totalMrp[]=round($totalMrpCal,2);
                $arrof_Discount[]=round($discount,2);
                $arrof_sale_rate[]=round($sale_rate_disp,2);
            }
            $skuCount=sizeof(array_unique($arrOft_barcode));
            $totalQty=array_sum($arrOf_t_sum_bal_qty);
            $payAmt=array_sum($arrOf_amountp);
            $totalMrp=array_sum($arrOf_totalMrp);
            $saveAmt=round($totalMrp - $payAmt,2);
            $itemDiscount=array_sum($arrof_Discount);
            $sumOfSalRate=array_sum($arrof_sale_rate);
            return Response::json(['ItemData' => $ItemData,'countVal' => $countVal,'skuCount' => $skuCount,'totalQty' => $totalQty,'payAmt' => round($payAmt,0),'totalMrp' => $totalMrp,'saveAmt' => $saveAmt,'itemDiscount' => round($itemDiscount,2),'emptyItemCode' => $emptyItemCode,'sumOfSalRate' => $sumOfSalRate]);
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
            $SrNo=0;$ItemData=array();$arrOft_barcode=array();$arrOf_t_sum_bal_qty=array();$arrOf_amountp=array();$arrOf_totalMrp=array();$arrof_Discount=array();$arrof_sale_rate=array();
            foreach ($temp_print_stock_details as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                if ($updateTprint==1) 
                {
                    $discount=$discount * $value->t_sum_bal_qty;
                }
                $item_scheme_disc=item_scheme_disc::select('disc_perc','disc_amt','promo_code','calc_on','fix_rate')->where('item_code',$value->t_item_code)->first();
                if (!blank($item_scheme_disc)) 
                {
                    if ($item_scheme_disc->calc_on =='S') 
                    {
                        $calcOnMrpSale=$value->t_sale_rate;
                    }else if($item_scheme_disc->calc_on =='M') 
                    {
                        $calcOnMrpSale=$value->t_mrp;
                    }
                    if ($item_scheme_disc->promo_code=='P') 
                    {
                        if ($item_scheme_disc->disc_perc!=null)
                        {
                            $discount=$discount + ($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $perCentAmt=($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $sale_rate_disp=round($calcOnMrpSale - $perCentAmt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    else if ($item_scheme_disc->promo_code=='A')
                    {
                        if ($item_scheme_disc->disc_amt!=null) 
                        {
                            $discount=$discount + ($item_scheme_disc->disc_amt * $value->t_sum_bal_qty);
                            $sale_rate_disp=round($calcOnMrpSale - $item_scheme_disc->disc_amt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    elseif ($item_scheme_disc->promo_code=='F') 
                    {
                        $discount=$discount + ($calcOnMrpSale - $item_scheme_disc->fix_rate);
                        $sale_rate_disp=round($item_scheme_disc->fix_rate,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                else
                {
                    $sale_rate_disp=round($value->t_sale_rate,2);
                    $amount=round($value->t_sale_rate * $value->t_sum_bal_qty,2);
                }
                $totalMrpCal=$value->t_mrp * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $sale_rate_disp ?? '-','amt' => $amount ?? '-','SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
                $arrOft_barcode[]=$value->t_barcode;
                $arrOf_t_sum_bal_qty[]=$value->t_sum_bal_qty;
                $arrOf_amountp[]=$amount ?? '-';
                $arrOf_totalMrp[]=round($totalMrpCal,2);
                $arrof_Discount[]=round($discount,2);
                $arrof_sale_rate[]=round($sale_rate_disp,2);
            }
            $skuCount=sizeof(array_unique($arrOft_barcode));
            $totalQty=array_sum($arrOf_t_sum_bal_qty);
            $payAmt=array_sum($arrOf_amountp);
            $totalMrp=array_sum($arrOf_totalMrp);
            $saveAmt=round($totalMrp - $payAmt,2);
            $itemDiscount=array_sum($arrof_Discount);
            $sumOfSalRate=array_sum($arrof_sale_rate);
            return Response::json(['success' => true,'ItemData' => $ItemData,'skuCount' => $skuCount,'totalQty' => $totalQty,'payAmt' => round($payAmt,0),'totalMrp' => $totalMrp,'saveAmt' => $saveAmt,'itemDiscount' => round($itemDiscount,2),'sumOfSalRate' => $sumOfSalRate]);
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }

    public function removeSku(Request $request)
    {
        $itemCheckId=$request->itemCheckId;
        if(blank($itemCheckId))
        {
            $Message="Please Select Any One CheckBox..!";
            return Response::json(['errors' => $Message]);
            die();
        }
        $getExistCount=temp_print_stock_details::select('t_stock_id','t_item_code','t_barcode')->whereIn('id',$itemCheckId)->get();
        $arrOft_stock_id=array();$arrOft_item_code=array();$arrOft_barcode=array();
        foreach($getExistCount as $val)
        {
            $arrOft_stock_id[]=$val->t_stock_id;
            $arrOft_item_code[]=$val->t_item_code;
            $arrOft_barcode[]=$val->t_barcode;
        }
        $skuRemoveTmp=temp_stock_details::whereIn('t_item_code',$arrOft_item_code)->whereIn('t_barcode',$arrOft_barcode)->delete();
        $skuRemove=temp_print_stock_details::whereIn('id', $itemCheckId)->delete();
        if ($skuRemove) 
        {
            $temp_print_stock_details=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            $SrNo=0;$ItemData=array();$arrOft_barcode=array();$arrOf_t_sum_bal_qty=array();$arrOf_amountp=array();$arrOf_totalMrp=array();$arrof_Discount=array();$arrof_sale_rate=array();
            foreach ($temp_print_stock_details as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                $discount=$discount * $value->t_sum_bal_qty;
                $item_scheme_disc=item_scheme_disc::select('disc_perc','disc_amt','promo_code','calc_on','fix_rate')->where('item_code',$value->t_item_code)->first();
                if (!blank($item_scheme_disc)) 
                {
                    if ($item_scheme_disc->calc_on =='S') 
                    {
                        $calcOnMrpSale=$value->t_sale_rate;
                    }else if($item_scheme_disc->calc_on =='M') 
                    {
                        $calcOnMrpSale=$value->t_mrp;
                    }
                    if ($item_scheme_disc->promo_code=='P') 
                    {
                        if ($item_scheme_disc->disc_perc!=null)
                        {
                            $discount=$discount + ($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $perCentAmt=($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $sale_rate_disp=round($calcOnMrpSale - $perCentAmt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    else if ($item_scheme_disc->promo_code=='A')
                    {
                        if ($item_scheme_disc->disc_amt!=null) 
                        {
                            $discount=$discount + ($item_scheme_disc->disc_amt * $value->t_sum_bal_qty);
                            $sale_rate_disp=round($calcOnMrpSale - $item_scheme_disc->disc_amt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    elseif ($item_scheme_disc->promo_code=='F') 
                    {
                        $discount=$discount + ($calcOnMrpSale - $item_scheme_disc->fix_rate);
                        $sale_rate_disp=round($item_scheme_disc->fix_rate,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                else
                {
                    $sale_rate_disp=round($value->t_sale_rate,2);
                    $amount=round($value->t_sale_rate * $value->t_sum_bal_qty,2);
                }
                $totalMrpCal=$value->t_mrp * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $sale_rate_disp?? '-','amt' => $amount?? '-','SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
                $arrOft_barcode[]=$value->t_barcode;
                $arrOf_t_sum_bal_qty[]=$value->t_sum_bal_qty;
                $arrOf_amountp[]=$amount?? '-';
                $arrOf_totalMrp[]=round($totalMrpCal,2);
                $arrof_Discount[]=round($discount,2);
                $arrof_sale_rate[]=round($sale_rate_disp,2);
            }
            $skuCount=sizeof(array_unique($arrOft_barcode));
            $totalQty=array_sum($arrOf_t_sum_bal_qty);
            $payAmt=array_sum($arrOf_amountp);
            $totalMrp=array_sum($arrOf_totalMrp);
            $saveAmt=round($totalMrp - $payAmt,2);
            $itemDiscount=array_sum($arrof_Discount);
            $sumOfSalRate=array_sum($arrof_sale_rate);
            return Response::json(['success' => true,'ItemData' => $ItemData,'skuCount' => $skuCount,'totalQty' => $totalQty,'payAmt' => round($payAmt,0),'totalMrp' => $totalMrp,'saveAmt' => $saveAmt,'itemDiscount' => round($itemDiscount,2),'sumOfSalRate' => $sumOfSalRate]);
        }
        else
        {
            return Response::json(['errors' => "Something went wrong...!"]);
        }
    }

    public function skucopy(Request $request)
    {
        $copySku=temp_print_stock_details::select('id','t_sum_bal_qty')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->first();

        $updateSku=temp_print_stock_details::where('id',$copySku->id)->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)
                ->update([
                    't_sum_bal_qty' => $copySku->t_sum_bal_qty+ 1
                ]);
        if ($updateSku) 
        {
            $getskuCopy=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();
            $SrNo=0;$ItemData=array();$arrOft_barcode=array();$arrOf_t_sum_bal_qty=array();$arrOf_amountp=array();$arrOf_totalMrp=array();$arrof_Discount=array();$arrof_sale_rate=array();
            foreach ($getskuCopy as $key => $value) 
            {
                $discount=$value->t_mrp - $value->t_sale_rate;
                $discount=$discount * $value->t_sum_bal_qty;
                $item_scheme_disc=item_scheme_disc::select('disc_perc','disc_amt','promo_code','calc_on','fix_rate')->where('item_code',$value->t_item_code)->first();
                if (!blank($item_scheme_disc)) 
                {
                    if ($item_scheme_disc->calc_on =='S') 
                    {
                        $calcOnMrpSale=$value->t_sale_rate;
                    }else if($item_scheme_disc->calc_on =='M') 
                    {
                        $calcOnMrpSale=$value->t_mrp;
                    }
                    if ($item_scheme_disc->promo_code=='P') 
                    {
                        if ($item_scheme_disc->disc_perc!=null)
                        {
                            $discount=$discount + ($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $perCentAmt=($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                            $sale_rate_disp=round($calcOnMrpSale - $perCentAmt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    else if ($item_scheme_disc->promo_code=='A')
                    {
                        if ($item_scheme_disc->disc_amt!=null) 
                        {
                            $discount=$discount + ($item_scheme_disc->disc_amt * $value->t_sum_bal_qty);
                            $sale_rate_disp=round($calcOnMrpSale - $item_scheme_disc->disc_amt,2);
                            $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                        }
                    }
                    elseif ($item_scheme_disc->promo_code=='F') 
                    {
                        $discount=$discount + ($calcOnMrpSale - $item_scheme_disc->fix_rate);
                        $sale_rate_disp=round($item_scheme_disc->fix_rate,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                else
                {
                    $sale_rate_disp=round($value->t_sale_rate,2);
                    $amount=round($value->t_sale_rate * $value->t_sum_bal_qty,2);
                }
                $totalMrpCal=$value->t_mrp * $value->t_sum_bal_qty;
                $ItemData[]=array('batch_no' => $value->t_batch_no,'mrp' => $value->t_mrp,'disc' => round($discount,2),'qty' => $value->t_sum_bal_qty,'sale_rate' => $sale_rate_disp?? '-','amt' => $amount?? '-','SrNo' => $value->t_barcode,'itemName' => $this->item_master_data[$value->t_item_code],'item_code' => $value->t_item_code,'stock_id' => $value->t_stock_id,'id' => $value->id);
                $arrOft_barcode[]=$value->t_barcode;
                $arrOf_t_sum_bal_qty[]=$value->t_sum_bal_qty;
                $arrOf_amountp[]=$amount?? '-';
                $arrOf_totalMrp[]=round($totalMrpCal,2);
                $arrof_Discount[]=round($discount,2);
                $arrof_sale_rate[]=round($sale_rate_disp,2);
            }
            $skuCount=sizeof(array_unique($arrOft_barcode));
            $totalQty=array_sum($arrOf_t_sum_bal_qty);
            $payAmt=array_sum($arrOf_amountp);
            $totalMrp=array_sum($arrOf_totalMrp);
            $saveAmt=round($totalMrp - $payAmt,2);
            $itemDiscount=array_sum($arrof_Discount);
            $sumOfSalRate=array_sum($arrof_sale_rate);

            return Response::json(['success' => true,'ItemData' => $ItemData,'skuCount' => $skuCount,'totalQty' => $totalQty,'payAmt' => round($payAmt,0),'totalMrp' => $totalMrp,'saveAmt' => $saveAmt,'itemDiscount' => round($itemDiscount,2),'sumOfSalRate' => $sumOfSalRate]);
        }
        else
        {
            return Response::json(['errors' => "Something went wrong...!"]);
        }
    }

    public function paymentcharge(Request $request)
    { 
        $PmtData=pmt_master::select('calc_on','charge_per')
                                    ->where('pmt_code', '=', $request->paymentType)
                                    ->first();
        if (!empty($PmtData)) 
        {
            if ($PmtData->calc_on=='S') 
            {
               $PaymentWithCharge = ($PmtData->charge_per / 100) * $request->sumOfSalRate;
            }
            elseif ($PmtData->calc_on=='M') {
               $PaymentWithCharge = ($PmtData->charge_per / 100) * $request->totalMrp;
            }

            return Response::json(['success' => true,'calc_on' => $PmtData->calc_on,'charge_per' => $PmtData->charge_per,'Pmt_Charge' => $PaymentWithCharge,'totalSum' => round($request->payAmt + $PaymentWithCharge,0)]);
        }
        else
        {
            return Response::json(['errors' => "Something went wrong...!"]);
        }   
    }
    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $sysDate=$mytime->toDateTimeString();
        $vDate=$mytime->toDateString();
        $Mobile=$request->Mobile;
        $homedel=$request->homedel;
        $existCust=$request->existCust;
        $Pmt_Charge=$request->Pmt_Charge;
        $custSeq=parameters::select('param_value')
                                    ->where('param_code', '=', 'USE_CUSTOMER_SEQ')
                                    ->first();

        $existCust=='' ? $MobileValid=1 : $MobileValid='';
        if($custSeq->param_value=='Y')
        {
            $autoCode=false;
            $custcode=$this->custcode+1;
        }
        else{
            $autoCode=true;
        }
        
        $homedel=='Y' ? $valHomeDel=true : $valHomeDel='';
        $validatedData = Validator::make($request->all(), 
        [
            // 'Mobile' => 'required',
            'payAmt' => 'required',
            'cust_code' => $autoCode==true ? 'required|unique:cust_master' : 'unique:cust_master',
            'cust_name' => $valHomeDel==true ? 'required' : '',
            'cust_addr1' =>$valHomeDel==true ? 'required' : ''
        ],
        [
            // 'Mobile.required' => 'Please Enter Mobile No..!',
            'payAmt.required' => 'Payment Must be greater than 0..!',
            'cust_code.required' => 'Please Enter Code..!',
            'cust_code.unique' => 'Code Already Exist..!',
            'cust_name.required' => 'Please Enter Name..!',
            'cust_addr1.required' => 'Please Enter Address..!'
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }
        $currentYear = Carbon::now()->format('Y');
        $v_number=$currentYear."0000001";
        $getVnum=pos_sale::select('v_no')->orderBy('p_id', 'DESC')->first();
        
        if($getVnum ==null or $getVnum=='')
        {
            $v_no1=$v_number;
        }else{
            $v_no1=$getVnum->v_no +1;
        }

        $getskuCopy=temp_print_stock_details::select('*')->where('t_updatedby',Session::get('useremail'))->where('t_machine_name',$this->machineName)->orderBy('id','desc')->get();$arrOfNetsaleAmt=array();$arrOfSaleAmt=array();$arrOfbilldisc=array();
        foreach ($getskuCopy as $key => $value) 
        {
            $item_scheme_disc=item_scheme_disc::select('disc_perc','disc_amt','promo_code','calc_on','fix_rate')->where('item_code',$value->t_item_code)->first();
            $discount=$value->t_mrp - $value->t_sale_rate;
            $discount=$discount * $value->t_sum_bal_qty;
            if (!blank($item_scheme_disc)) 
            {
                if ($item_scheme_disc->calc_on =='S') 
                {
                    $calcOnMrpSale=$value->t_sale_rate;
                }else if($item_scheme_disc->calc_on =='M') 
                {
                    $calcOnMrpSale=$value->t_mrp;
                }
                $promoCode=$item_scheme_disc->promo_code;
                if ($item_scheme_disc->promo_code=='P') 
                {
                    if ($item_scheme_disc->disc_perc!=null)
                    {
                        $discount=$discount + ($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                        $perCentAmt=($calcOnMrpSale * $item_scheme_disc->disc_perc)/100;
                        $sale_rate_disp=round($calcOnMrpSale - $perCentAmt,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                else if ($item_scheme_disc->promo_code=='A')
                {
                    if ($item_scheme_disc->disc_amt!=null) 
                    {
                        $discount=$discount + ($item_scheme_disc->disc_amt * $value->t_sum_bal_qty);
                        $sale_rate_disp=round($calcOnMrpSale - $item_scheme_disc->disc_amt,2);
                        $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                    }
                }
                elseif ($item_scheme_disc->promo_code=='F') 
                {
                    $discount=$discount + ($calcOnMrpSale - $item_scheme_disc->fix_rate);
                    $sale_rate_disp=round($item_scheme_disc->fix_rate,2);
                    $amount=round($sale_rate_disp * $value->t_sum_bal_qty,2);
                }
            }
            else
            {
                $sale_rate_disp=round($value->t_sale_rate,2);
                $amount=round($value->t_sale_rate * $value->t_sum_bal_qty,2);
                $promoCode='';
                $discount=$value->t_mrp-$value->t_sale_rate;
            }
            $get_tax_code=item_master::select('tax_code')->where('item_code',$value->t_item_code)->first();
            $get_tax_percent=tax_master::select('tax_per')->where('tax_code',$get_tax_code->tax_code)->first();
            $get_cost_rate=stock_detail::select('cost_rate')->where('stock_id',$value->t_stock_id)->where('item_code',$value->t_item_code)->first();
            $insSaleAmt=round($value->t_sum_bal_qty * $value->t_sale_rate,2);
            $insItemDiscount=round($discount * $value->t_sum_bal_qty,2);
            $insBillDiscount=round($request->billDiscont * $discount,2);
            $insNetSaleAmt=round(($insSaleAmt-$insItemDiscount-$insBillDiscount),2);
            $arrOfNetsaleAmt[]=$insNetSaleAmt;
            $arrOfSaleAmt[]=$insSaleAmt;
            $arrOfbilldisc[]=$insBillDiscount;
            $insTaxCode=$get_tax_code->tax_code;
            $insTaxAmt=round(($insNetSaleAmt * $get_tax_percent->tax_per)/100,2);
            try {
                $posdetails=pointofsaledetails::create([
                    'loc_code' =>  Session::get('companyloc_code'),
                    'comp_code' => Session::get('companycode'),
                    'v_no' => $v_no1,
                    'v_date' => $vDate,
                    'mac_id' => $this->machineName,
                    'item_code' => $value->t_item_code,
                    'barcode' => $value->t_barcode,
                    'bill_qty' => $value->t_sum_bal_qty,
                    'mrp' => $value->t_mrp,
                    'cost_rate' => $get_cost_rate->cost_rate,
                    'sale_rate' => $value->t_sale_rate,
                    'sale_amt' => $insSaleAmt,
                    'batch_no' => $value->t_batch_no,
                    'promo_item' => $promoCode,
                    'item_disc' => $insItemDiscount,
                    'promo_bill' => '',
                    'bill_disc' => $insBillDiscount,
                    'net_sale_amt' => $insNetSaleAmt,
                    'net_sale_rate' => round($insNetSaleAmt / $value->t_sum_bal_qty,2),
                    'tax_code' => $insTaxCode,
                    'tax_amt' => $insTaxAmt,
                    'manual_disc_amt' => '',
                    'oth_chrg_amt' => '',
                    'free_item' => '',
                    'pmt_chrg' => '',
                    'adj_amt' => '',
                    'created_at' => $sysDate,
                    'updated_at' => $sysDate
                ]);
            }
            catch (Exception $exception) {
            
            return Response::json(['errors' => $exception->getMessage()]);
            } 
             
        }

        $discAmt=$request->discAmt;
        $discPercent=$request->discPercent;
        if ($discAmt!='') 
        {
            $manual_disc_perc = ($request->payAmt / 100) * $request->discAmt;
        }
        elseif ($discPercent!='') 
        {
            $manual_disc_perc = ($request->payAmt / 100) * $request->discAmt;
        }else{$manual_disc_perc="0";}

        $otherChargesAmt=$request->otherChargesAmt;
        $otherChargePer=$request->otherChargePer;
        if ($otherChargesAmt!='') 
        {
            $oth_chrg_perc = ($request->payAmt / 100) * $request->otherChargesAmt;
        }
        elseif ($otherChargePer!='') 
        {
            $oth_chrg_perc = ($request->payAmt / 100) * $request->otherChargesAmt;
        }else{$oth_chrg_perc="0";}
        $insItemDisc=$request->saveAmt;
        $insItemAmt=array_sum($arrOfSaleAmt);
        $insBill_disc=array_sum($arrOfbilldisc);
        $manual_disc_amt=($insItemAmt-$insItemDisc-$insBill_disc)*$manual_disc_perc/100;
        $insNet_sale_amt=array_sum($arrOfNetsaleAmt);
        $oth_chrg_amt=($insItemAmt-$insItemDisc-$insBill_disc)*$oth_chrg_perc/100;
        $insRoundoff=round(($insNet_sale_amt-$manual_disc_amt+$oth_chrg_amt+$Pmt_Charge),0)-($insNet_sale_amt-$manual_disc_amt+$oth_chrg_amt+$Pmt_Charge);
        $insNet_bill_amt=($insNet_sale_amt-$manual_disc_perc+$oth_chrg_amt+$Pmt_Charge)+$insRoundoff;
        

        try {
            $InsPos=pos_sale::create([
                'loc_code' =>  Session::get('companyloc_code'),
                'comp_code' => Session::get('companycode'),
                'v_no' => $v_no1,
                'v_date' => $vDate,
                'mac_id' => $this->machineName,
                'inv_type' => $request->inv_type,
                'cust_code' => $autoCode==true ? $request->cust_code : $custcode,
                'gl_code' => '',
                'gstin' => '',
                'home_delvy' => $homedel,
                'ord_id' => '',
                'salesman_code' => '',
                'token_no' => '',
                'session_id' => '', // after work done of login
                'is_online' => $this->is_online->param_value,
                'manual_disc_user' => $request->usercode,
                'manual_disc_perc' => $manual_disc_perc,
                'oth_chrg_user' => $request->usercode,
                'oth_chrg_perc' => $oth_chrg_perc,
                'net_bill_amt' => $insNet_bill_amt,
                'roundoff' => $insRoundoff,
                'net_sale_amt' => $insNet_sale_amt,
                'item_amt' => $insItemAmt,
                'item_disc' => $insItemDisc,
                'bill_disc' => $insBill_disc,
                'manual_disc_amt' => $manual_disc_amt,
                'oth_chrg_amt' => $oth_chrg_amt,
                'pmt_chrg' => $Pmt_Charge,
                'created_by' => Session::get('useremail'),
                'created_at' => $sysDate,
                'updated_at' => $sysDate
            ]);
           
        }
        catch (Exception $exception) {
            
            return Response::json(['errors' => $exception->getMessage()]);
        }

        $insPmtAmt=$request->payAmt + $request->pmt_chrg;
        try{
            $posPayment=pointofsalepayment::create([
                    'loc_code' =>  Session::get('companyloc_code'),
                    'comp_code' => Session::get('companycode'),
                    'v_no' => $v_no1,
                    'v_date' => $vDate,
                    'mac_id' => $this->machineName,
                    'pmt_code' => $request->paymentType,
                    'ref_amt' => $request->payAmt - $insPmtAmt,
                    'pmt_chrg' => $request->pmt_chrg,
                    'pmt_amt' => $insPmtAmt,
                    'remark' => $request->remark,
                    'created_at' => $sysDate,
                    'updated_at' => $sysDate
            ]);
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }

        if ($existCust=='' and $request->Mobile!='') 
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
               
            }
            catch (Exception $exception) {
                
                return Response::json(['errors' => $exception->getMessage()]);
            } 
        }

        if ($posdetails and $InsPos and $posPayment) 
        {
            temp_stock_details::where([['t_updatedby', Session::get('useremail')],['t_machine_name',$this->machineName]])->delete();

            temp_print_stock_details::where([['t_updatedby', Session::get('useremail')],['t_machine_name',$this->machineName]])->delete();
            $billNo=pos_sale::select("v_no")->where([['mac_id',$this->machineName],['created_by',Session::get('useremail')]])->orderBy('p_id','desc')->first();
            return Response::json(['success' => true,'billNo'=> $billNo->v_no]);
        }   
        else
        {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }
}
