<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tax_master;
use App\Exports\taxExport;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;
use Excel;
class taxMaster extends Controller
{
    public $tax_master_data;
    public function __construct()
    {
        $this->tax_master_data= tax_master::all()->where('status','Y');
    }
    public function index()
    {
        return view('Master.tax_master',['tax_master_data' => $this->tax_master_data]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'tax_type' => 'required',
            'tax_code' => 'required|unique:tax_master',
            'tax_name' => 'required',
            'tax_per' => 'required'
        ],
        [
            'tax_type.required' => 'Please Select Tax Type',
            'tax_code.required' => 'Please Enter Tax Code',
            'tax_code.unique' => 'Tax Code Already Exist',
            'tax_name.required' => 'Please Enter Name',
            'tax_per.required' => 'Please Enter Tax %'
            
        ]);

        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            tax_master::create([
                'tax_type' => $request->tax_type,
                'tax_code' => $request->tax_code,
                'tax_name' => $request->tax_name,
                'tax_per' => $request->tax_per,
                'tax_indicator' => $request->tax_indicator,
                'igst' => $request->igst,
                'sgst' => $request->sgst,
                'cgst' => $request->cgst,
                'utgst' => $request->utgst,
                'cess' => $request->cess,
                'cessperpiece' => $request->cessperpiece,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

    public function taxPdf()
    {
        $tax_master_data=$this->tax_master_data;
       
        $mpdf= new \Mpdf\Mpdf();
        $html=\View::make('Master.tax_master_pdf')->with(compact('tax_master_data'));
        
        $mpdf->SetHTMLFooter('<table width="100%" style="font-size:12px;"> 
            <tr> <td colspan="2" align="center">|{PAGENO} of {nbpg}|</td>  </tr>
             </table>');
        $html=$html->render();
        $mpdf->WriteHTML($html);
        $mpdf->output('taxMaster.pdf','I');
    }

    public function taxMasterExcel()
    {
        return Excel::download(new taxExport($this->tax_master_data),'taxMaster.xlsx');
    }
    public function taxMasterGetExcel($tax_master_data)
    {
        $arrOfType=array(); $arrOfType['G']='GST'; $arrOfType['V']='Vat';
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $srNo=0;
        foreach($tax_master_data as $taxValue)
        {
            $result[]=array(++$srNo,$arrOfType[$taxValue->tax_type],$taxValue->tax_code,$taxValue->tax_name,$taxValue->tax_per,$taxValue->tax_indicator,$taxValue->igst,$taxValue->sgst,$taxValue->cgst,$taxValue->utgst,$taxValue->cess,$taxValue->cessperpiece,$arrOfStatus[$taxValue->status],$taxValue->created_by,$taxValue->created_at,$taxValue->t_user,$taxValue->updated_at);
        }

        return $result;
    }
}
