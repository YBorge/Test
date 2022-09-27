<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tax_master;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;
use Excel;
class taxMaster extends Controller
{
    public function index()
    {
        return view('Master.tax_master');
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
}
