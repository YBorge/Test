<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\parameters;
use App\Models\open_stock;
use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\location_master;
use App\Models\company_master;

use Response;
use PDF;
use Excel;

class openStock extends Controller
{
    public function index()
    {
        $loc_code = location_master::pluck('loc_name','loc_code');
        $open_stockdata= open_stock::all();
        $dept_code = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'DEPT_CODE')
                            ->pluck('list_desc','list_value');

        return view('master.openStock',['loc_code' => $loc_code,'open_stockdata'  => $open_stockdata,'dept_code' => $dept_code]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'item_code' => 'required|unique:open_stock',
            'item_name' => 'required'
        ],
        [
            'item_code.required' => 'Please Enter Code',
            'item_code.unique' => 'Code Already Exist',
            'item_name.required' => 'Please Enter Name'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            open_stock::create([
                'item_code' => $request->item_code,
                'item_name' => $request->item_name,
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }
}
