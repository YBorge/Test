<?php

namespace App\Http\Controllers\Master;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\pmt_master;
use App\Models\parameters;
use App\Exports\paymentExport;
use Response;
use PDF;
use Excel;

class paymentMaster extends Controller
{
    public function __construct()
    {
        $this->paymentSeq=parameters::select('param_value')
                                    ->where('param_code', '=', 'USE_PMT_SEQ')
                                    ->first();    
        $this->pmt_code=pmt_master::max('pmt_code');
        $this->paymentData=pmt_master::all()->where('status','Y');                                   
    }
    public function index()
    {
        $paymentSeq=$this->paymentSeq->param_value;
        $paymentData=$this->paymentData;
        return view('master.payment_master',['paymentSeq' => $paymentSeq,'paymentData' => $paymentData]);
    }

    public function store(Request $request)
    {
        $paymentSeq=$this->paymentSeq->param_value;
        if($paymentSeq=='Y')
        {
            $paymentvalid=0;
            $pmtcode=$this->pmt_code;
            $pmtcodesave=$pmtcode+1;
        }
        else
        {
            $paymentvalid=1;
        }
        
        $validatedData = Validator::make($request->all(), 
        [
            'pmt_code' => $paymentvalid==1 ? 'required|unique:pmt_master' : 'unique:pmt_master',
            'pmt_name' => 'required',
            'calc_on' => 'required',
            'allow_multi' => 'required'
        ],
        [
            'pmt_code.required' => 'Please Enter Code',
            'pmt_code.unique' => 'Code Already Exist',
            'pmt_name.required' => 'Please Enter Payment Name',
            'calc_on.required' => 'Please Select Calculate On',
            'allow_multi.required' => 'Please Select Allow Multi'
        ]);

        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }
        try {
            
            pmt_master::create([
                'pmt_code' => $paymentvalid==1 ? $request->pmt_code : $pmtcodesave,
                'pmt_name' => $request->pmt_name,
                'calc_on' => $request->calc_on,
                'charge_per' => $request->charge_per,
                'allow_multi' => $request->allow_multi,
                'bill_copy' => $request->bill_copy,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
        
            return Response::json(['success' => true]); 
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }

    public function paymentMasterPdf()
    {
        $paymentData=$this->paymentData;
        $pdf = PDF::loadView('master.paymentMasterPDF',["paymentData" => $paymentData]);
    
        return $pdf->download('PaymentMaster.pdf');
    }

    public function paymentMasterExcel()
    {
        $paymentData=$this->paymentData;
        return Excel::download(new paymentExport($paymentData),'PaymentMaster.xlsx');
    }

    public function paymentMasterGetExcel($paymentData)
    {
        $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No';
        $arrOfCalOn=array(); $arrOfCalOn['M']='MRP'; $arrOfCalOn['S']='Sale'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $SrNo=0;
        foreach($paymentData as $payment_value)
        {
            $result[]=array(++$SrNo,$payment_value->pmt_code,$payment_value->pmt_name,$arrOfCalOn[$payment_value->calc_on],$payment_value->charge_per,$arrOfYesNo[$payment_value->allow_multi]?? '-',$payment_value->bill_copy,$arrOfStatus[$payment_value->status],$payment_value->created_by,$payment_value->created_at,$payment_value->updated_at);
        }
        return $result;
    }
}
