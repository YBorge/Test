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
    public function __construct()
    {
        $this->custcode=cust_master::max('cust_code');
        $this->sysDate= Carbon::now("Asia/Kolkata")->format('d-m-Y');
        $this->otpCop= parameters::select('param_value')->where('param_code','=','OTP_COMP')->first();
        $this->item_master_data=item_master::pluck('item_name','item_code');
         //$sysDate=$currentTime->toDateTimeString();
    }
    public function index()
    {
         
        $sysDate = Carbon::now()->format('d-m-Y');
        $macAddr = exec('getmac');
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $macAddr,'sysDate' => $sysDate,'otpCop' => $this->otpCop->param_value]);
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
        $stocDetails=DB::table('stock_detail')->select('item_code','batch_no','mrp','sale_rate','recd_date',DB::raw('SUM(bal_qty) AS sum_bal_qty'))->where('item_code',$getItemCode->item_code)->where('bal_qty','>',0)
            ->groupBy('mrp')
            ->groupBy('item_code')
            ->groupBy('batch_no')
            ->groupBy('sale_rate')
            ->groupBy('recd_date')
            ->orderBy('stock_id')
            ->get();
            //dd($stocDetails);
            $SrNo=0;
            foreach($stocDetails as $value)
            {
                $discount=$value->mrp - $value->sale_rate;
                $ItemData[]=array('batch_no' => $value->batch_no,'mrp' => $value->mrp,'disc' => number_format((float)$discount, 2, '.', '')
                ,'qty' => $value->sum_bal_qty,'sale_rate' => $value->sale_rate,'amt' => 100,'SrNo' => ++$SrNo,'itemName' => $this->item_master_data[$value->item_code]);

            }
            
        return Response::json(['ItemData' => $ItemData]);
        // foreach ($stocDetails as $key => $stockVal) 
        // {
        //     $arrOfMrp[]=$stockVal->mrp;
        //     $arrOfSaleRate[]=$stockVal->sale_rate;
        //     $arrOfItemcode[]=$stockVal->item_code;
        //     $arrOfBalQty[]=$stockVal->sum_bal_qty;
        // }

        // $arUniq=array_unique($arrOfBalQty);
        // //print_r($arUniq);
        // if (array_count_values($arrOfMrp) > 1) 
        // {
        //    echo "string";
        // }
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
                    'created_at' => $sysDate,
                    'updated_at' => $sysDate
                ]);
               
                return Response::json(['success' => true]);
            }
            catch (Exception $exception) {
                return Response::json(['errors' => $exception->getMessage()]);
            }
        }
    }
}
