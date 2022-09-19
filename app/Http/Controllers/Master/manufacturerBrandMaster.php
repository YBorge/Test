<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\parameters;
use App\Models\manufacturer_master;
use App\Models\brand_master;
use App\Exports\manufacturerExport;
use App\Exports\brandMasterExport;
use Response;
use PDF;
use Excel;

class manufacturerBrandMaster extends Controller
{
    public function __construct()
    {
        $this->manufSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_MANUFACT_SEQ')
                                    ->get();
        $this->branAutoCode=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_BRAND_SEQ')
                                    ->get();
        $this->mancode=manufacturer_master::max('manufact_code');
        $this->manfacData=manufacturer_master::all()->where('status','Y');
        $this->brand_code=brand_master::max('brand_code');
        $this->brandData=brand_master::all()->where('status','Y');
        $this->manftype = manufacturer_master::where('status', '=', 'Y')->pluck('manufact_name','manufact_code');
                                            
    }
    public function index()
    {
        $mancode=$this->mancode;
        $manufSeq=$this->manufSeq[0]['param_value'];
        $branAutoCode=$this->branAutoCode[0]['param_value'];
        $manfacData=$this->manfacData;
        $brandData=$this->brandData;
        $manftype=$this->manftype;  
        return view('master.manufacturerBrandMaster',['manufSeq' => $manufSeq,'mancode' => $mancode,'manfacData' => $manfacData,'branAutoCode' => $branAutoCode,'brandData' => $brandData,'manftype' => $manftype]);
    }

    public function store(Request $request)
    {
        $manufSeq=$this->manufSeq[0]['param_value'];
        if($manufSeq=='Y')
        {
            $mancodevalid=0;
            $mancode=$this->mancode;
            $manufact_codeAuto=$mancode+1;
        }
        else
        {
            $mancodevalid=1;
        }
        
        $validatedData = Validator::make($request->all(), 
        [
            'manufact_code' => $mancodevalid==1 ? 'required|unique:manufacturer_master' : 'unique:manufacturer_master',
            'manufact_name' => 'required',
            'type' => 'required'
        ],
        [
            'manufact_code.required' => 'Please Enter Code',
            'manufact_code.unique' => 'Code Already Exist',
            'manufact_name.required' => 'Please Enter Name',
            'type.required' => 'Please Select Type'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            manufacturer_master::create([
                'manufact_code' => $mancodevalid==true ? $request->manufact_code : $manufact_codeAuto,
                'manufact_name' => $request->manufact_name,
                'type' => $request->type,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

    public function storeBrand(Request $request)
    {
        $branAutoCode=$this->branAutoCode[0]['param_value'];
        if($branAutoCode=='Y')
        {
            $brandcodevalid=0;
            $brand_code=$this->brand_code;
            $brand_codeAuto=$brand_code+1;
        }
        else
        {
            $brandcodevalid=1;
        }
        
        $validatedData = Validator::make($request->all(), 
        [
            'brand_code' => $brandcodevalid==1 ? 'required|unique:brand_master' : 'unique:brand_master',
            'brand_name' => 'required',
            'manufact_brand' => 'required'
        ],
        [
            'brand_code.required' => 'Please Enter Code',
            'brand_code.unique' => 'Code Already Exist',
            'brand_name.required' => 'Please Enter Name',
            'manufact_brand.required' => 'Please Select Type'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            brand_master::create([
                'brand_code' => $brandcodevalid==true ? $request->brand_code : $brand_codeAuto,
                'brand_name' => $request->brand_name,
                'manufact_code' => $request->manufact_brand,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

    public function brandMasterPdf()
    {
        $manfacData=$this->manfacData;
        $pdf = PDF::loadView('master.brandMasterPDF',["manfacData" => $manfacData,'Type' => 'ManfMaster']);
    
        return $pdf->download('brandMaster.pdf');
    }

    public function subBrandMasterPdf()
    {
        $brandData=$this->brandData;
        $manftype=$this->manftype;
        $pdf = PDF::loadView('master.brandMasterPDF',["brandData" => $brandData,'manftype' => $manftype,'Type' => 'brandMaster']);
    
        return $pdf->download('brandMaster.pdf');
    }

    public function brandMasterExcel()
    {
        $manfacData=$this->manfacData;
        return Excel::download(new manufacturerExport($manfacData),'manufacturerMaster.xlsx');
    }

    public function brandMasterGetExcel($manfacData)
    {
        $arrOfYesNo=array(); $arrOfYesNo['B']='Branded'; $arrOfYesNo['U']='Unbranded'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $SrNo=0;
        foreach($manfacData as $mancf_value)
        {
            $result[]=array(++$SrNo,$mancf_value->manufact_code,$mancf_value->manufact_name,$arrOfYesNo[$mancf_value->type],$arrOfStatus[$mancf_value->status],$mancf_value->created_by,$mancf_value->created_at,$mancf_value->updated_at);
        }
        return $result;
    }

    public function subBrandMasterExcel()
    {
        $brandData=$this->brandData;
        $manftype=$this->manftype;
        return Excel::download(new brandMasterExport($brandData,$manftype),'brandMaster.xlsx');
    }
    
    public function subBrandMasterGetExcel($brandData, $manftype)
    {
        $arrOfYesNo=array(); $arrOfYesNo['B']='Branded'; $arrOfYesNo['U']='Unbranded'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $SrNo=0;
        foreach($brandData as $brand_value)
        {
            $result[]=array(++$SrNo,$brand_value->brand_code,$brand_value->brand_name,$manftype[$brand_value->manufact_code],$arrOfStatus[$brand_value->status],$brand_value->created_by,$brand_value->created_at,$brand_value->updated_at);
        }
        return $result;
    }
}
