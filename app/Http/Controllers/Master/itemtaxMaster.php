<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\item_tax_master;
use App\Models\tax_master;
use App\Models\item_master;
use App\Exports\taxExport;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;
use Excel;

class itemtaxMaster extends Controller
{
    public $item_tax_master_data;
    public $item_master_data;
    public $tax_master_data;

    public function __construct()
    {
        $this->item_tax_master_data= item_tax_master::all();
        $this->item_master_data= item_master::all()->where('status', '=', 'Y')
                                                ->pluck('item_name','item_code');
        $this->tax_master_data= tax_master::all()->where('status', '=', 'Y')
                                                ->pluck('tax_name','tax_code');
    }
    public function index()
    {
        return view('Master.item_tax_master',['item_tax_master_data' => $this->item_tax_master_data,'item_master_data' => $this->item_master_data,'tax_master_data' => $this->tax_master_data]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'item_code' => 'required|unique:item_tax_master',
            'tax_code' => 'required',
            'start_date' => 'required',
            'state_code' => 'required'
        ],
        [
            'item_code.required' => 'Please Enter Item Code',
            'tax_code.required' => 'Please Enter Tax Code',
            'start_date.required' => 'Please Enter Start Date',
            'state_code.required' => 'Please Enter Zone'
        ]);

        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            item_tax_master::create([
                'item_code' => $request->item_code,
                'tax_code' => $request->tax_code,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'state_code' => $request->state_code,
                'created_by' => Session::get('useremail'),
                'updated_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

}
