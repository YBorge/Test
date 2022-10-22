<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use App\Models\cust_master;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Response;

class PointofSale extends Controller
{
    public function index()
    {
        $sysDate= Carbon::now()->format('d-m-Y');
        $macAddr = exec('getmac');
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $macAddr,'sysDate' => $sysDate]);
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
            $custData=array('cust_code' => $getcustData[0]['cust_code'],'cust_name' => $getcustData[0]['cust_name'],'cust_addr1' => $getcustData[0]['cust_addr1'],'points' => $getcustData[0]['points']);
            return Response::json(['custData' => $custData]);
        }
        //return $getcustData;

    }
}
