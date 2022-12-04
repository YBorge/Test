<?php

namespace App\Http\Controllers\Master;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\location_master;
use App\Models\item_scheme_disc;
use App\Models\item_master;
use App\Models\users;
use App\Models\common_list_master;
use App\Models\parameters;
use App\Exports\masterExport;
use Response;
use PDF;
use Excel;

class itemScheme extends Controller
{   
    public $itemData;
    public $itemSchemeData;
    public $locData;
    public $cust_type_master;

    public function __construct()
    {
        $this->itemData= item_master::where('status', '=', 'Y')
                                    ->orderBy('item_name', 'asc')
                                    ->pluck('item_name','item_code');
        $this->itemSchemeData= item_scheme_disc::all();
        $this->locData=location_master::where('status', '=', 'Y')
                                    ->orderBy('loc_name', 'asc')
                                    ->pluck('loc_name','loc_code');
        $this->cust_type_master = common_list_master::where('status', '=', 'Y')
                                    ->where('list_code', '=', 'CUST_TYPE')
                                    ->pluck('list_desc','list_value');
    }
    public function list()
    {
        $itemData=$this->itemData;
        $itemSchemeData=$this->itemSchemeData;
        $locData=$this->locData;
        $cust_type_master=$this->cust_type_master;
        return view('master.item_scheme_disc',['itemData'  => $this->itemData,'itemSchemeData'  => $this->itemSchemeData,'locData'  => $this->locData,'cust_type_master' => $this->cust_type_master]);
    }
    public function index()
    {
        $itemData=$this->itemData;
        $itemSchemeData=$this->itemSchemeData;
        $locData=$this->locData;
        $cust_type_master=$this->cust_type_master;
        return view('master.item_scheme_disc',['itemData'  => $this->itemData,'itemSchemeData'  => $this->itemSchemeData,'locData'  => $this->locData, 'cust_type_master' => $this->cust_type_master]);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'item_code' => 'required',
            'promo_code' => 'required',
            'item_code' => 'required'
        ],
        [
            'item_code.required' => 'Please Select User Code',
            'promo_code.required' => 'Please Select Promo Code',
            'item_code.required' => 'Please Select Item Code'
        ]);

        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }
        try {
            
            item_scheme_disc::create([
                'loc_code' => $request->loc_code,
                'promo_code' => $request->promo_code,
                'item_code' => $request->item_code,
                'batch_no' => $request->batch_no,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'from_time' => $request->from_time,
                'to_time' => $request->to_time,
                'from_qty' => $request->from_qty,
                'to_qty' => $request->to_qty,
                'max_qty' => $request->max_qty,
                'disc_perc' => $request->disc_perc,
                'disc_amt' => $request->disc_amt,
                'fix_rate' => $request->fix_rate,
                'calc_on' => $request->calc_on,
                'cust_type_incl' => $request->cust_type_incl,
                'cust_type_excl' => $request->cust_type_excl,
                'created_by' => Session::get('useremail'),
                'updated_by' => Session::get('useremail')
            ]);
        
            return Response::json(['success' => true]); 
        }
        catch (Exception $exception) {
            return Response::json(['errors' => $exception->getMessage()]);
        }
    }

    public function itemSchemePdf()
    {
        $itemSchemeData=$this->itemSchemeData;
        $itemData=$this->itemData;
        $locData=$this->locData;
        $pdf = PDF::loadView('master.itemSchemePDF',["itemSchemeData" => $itemSchemeData, "itemData" => $itemData, "locData" => $locData]);
    
        return $pdf->download('itemScheme.pdf');
    }
    
    public function itemSchemeExcel()
    {
        $itemSchemeData=$this->itemSchemeData;
        $itemData=$this->itemData;
        $locData=$this->locData;
        return Excel::download(new masterExport($itemSchemeData,$itemData,$locData),'itemScheme.xlsx');
    }

    public function itemSchemeGetExcel($itemSchemeData)
    {
        $arrOfpromo_code=array(); $arrOfpromo_code['F']='Fix'; $arrOfpromo_code['P']='Perc'; $arrOfpromo_code['A']='Amt';
        $arrOfcalc_on=array(); $arrOfcalc_on['S']='Sale'; $arrOfcalc_on['M']='MRP';

        $SrNo=0;
        foreach($itemSchemeData as $item_value)
        {
            $result[]=array(++$SrNo,
                            $item_value->item_code,
                            //$item_value->promo_code,
                            $arrOfpromo_code[$item_value->promo_code],
                            $item_value->item_code,
                            $item_value->batch_no,
                            $item_value->from_date,
                            $item_value->to_date,
                            $item_value->from_time,
                            $item_value->to_time,
                            $item_value->from_qty,
                            $item_value->to_qty,
                            $item_value->max_qty,
                            $item_value->disc_perc,
                            $item_value->disc_amt,
                            $item_value->fix_rate,
                            $arrOfcalc_on[$item_value->calc_on],
                            $item_value->cust_type_incl,
                            $item_value->cust_type_excl,
                            $item_value->created_by,
                            $item_value->created_at,
                            $item_value->updated_by,
                            $item_value->updated_at);
        }
        return $result;
    }
}
