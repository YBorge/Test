<?php

namespace App\Http\Controllers\Master;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\open_stock;
use App\Models\dept_master;
use App\Models\item_barcode;

use Response;
use PDF;
use Excel;

class openStock extends Controller
{
    public $dept_code;
    public $open_stockdata;
    public function __construct()
    {
        $this->dept_code = dept_master::where('status', '=', 'Y')->pluck('dept_name','dept_code');
        $this->open_stockdata= open_stock::all();
    }
    public function index()
    {
        
        return view('master.openStock',['open_stockdata'  => $this->open_stockdata,'dept_code' => $this->dept_code]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'barcode' => 'required',
            'qty' => 'required',
            'mrp' => 'required',
            'sale_rate' => 'required',
            'cost_rate' => 'required',
            'dept_code' => 'required',
            'expiry_date' => 'required'
        ],
        [
            'barcode.required' => 'Please Enter Bar Code',
            'qty.required' => 'Please Enter Quantity',
            'mrp.required' => 'Please Enter MRP',
            'sale_rate.required' => 'Please Enter Sale Rate',
            'cost_rate.required' => 'Please Enter Cost Rate',
            'dept_code.required' => 'Please Enter Department Code',
            'expiry_date.required' => 'Please Enter Department Code'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            open_stock::create([
                'loc_Code' => Session::get('companyloc_code'),
                'barcode' => $request->barcode,
                'item_code' => $request->item_code,
                'qty' => $request->qty,
                'mrp' => $request->mrp,
                'sale_rate' => $request->sale_rate,
                'cost_rate' => $request->cost_rate,
                'dept_code' => $request->dept_code,
                'expiry_date' => $request->expiry_date,
                'batch_no' => '',
                'doc_type' => '',
                'comp_code' => Session::get('companycode'),
                'status' => 'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

    public function getBarcode(Request $request)
    {
        echo $request->barcode;
        // $articles = DB::table('item_mastr')
        //     ->select('item_mastr.item_code', ..... )
        //     ->join('categories', 'articles.categories_id', '=', 'categories.id')
        //     ->join('users', 'articles.user_id', '=', 'user.id')

        //     ->get();
    }
}
