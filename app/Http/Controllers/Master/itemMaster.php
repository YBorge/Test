<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\parameters;
use App\Models\common_list_master;
use App\Models\item_master;
use App\Models\tax_master;
use App\Models\category_master;
use App\Models\sub_category_master;
use App\Models\manufacturer_master;
use App\Models\brand_master;
use App\Exports\itemMasterExport;
use Response;
use PDF;
use Excel;


class itemMaster extends Controller
{
	public $itemCodeSeq;
    public $unitType;
    public $parentItem;
    public $taxMaster;
    public $subCateMaster;
    public $food_type;
    public $brand_master_data;
    public $manufact_master_data;
    public $max_item_code;
    public $item_master_data;
    public $category_data;
    public function __construct()
    {
        
        $this->itemCodeSeq=parameters::select('param_value','param_desc')->where('param_code', '=', 'USE_ITEM_CODE_SEQ')->first();
        $this->max_item_code=item_master::max('item_code');
        $this->unitType=common_list_master::where('status', '=', 'Y')->where('list_code', '=', 'UNIT')->pluck('list_desc','list_value');
        $this->parentItem=item_master::where('status', '=', 'Y')->where('item_type', '=', 'L')->pluck('item_name','item_id');
        $this->taxMaster=tax_master::where('status', '=', 'Y')->pluck('tax_name','tax_id');
        $this->subCateMaster=sub_category_master::where('status', '=', 'Y')->pluck('sub_cat_name','sub_cat_code');
        $this->food_type = common_list_master::where('status', '=', 'Y')->where('list_code', '=', 'CAT_TYPE')->pluck('list_value','list_id');
       $this->brand_master_data = brand_master::where('status', '=', 'Y')->pluck('brand_name','brand_code');
       $this->manufact_master_data = manufacturer_master::where('status', '=', 'Y')->pluck('manufact_name','manufact_code');
       $this->item_master_data=item_master::all()->where('status','Y');
       $this->category_data=category_master::where('status', '=', 'Y')->pluck('cat_name','cat_code');
    }
    public function list()
    {
        $item_master_data=$this->item_master_data;
        $unitType=$this->unitType;
        $parentItem=$this->parentItem;
        $taxMaster=$this->taxMaster;
        $subCateMaster=$this->subCateMaster;
        $brand_master_data=$this->brand_master_data;
        $manufact_master_data=$this->manufact_master_data;
        $category_data=$this->category_data;
        return view('Master.item_master_list',['item_master_data' => $item_master_data,'unitType' => $unitType,'parentItem' => $parentItem,'taxMaster' => $taxMaster,'subCateMaster' => $subCateMaster,'brand_master_data' => $brand_master_data,'manufact_master_data' => $manufact_master_data,'category_data' => $category_data]);
    }
    public function index()
    {
    	$itemCodeSeq=$this->itemCodeSeq->param_value;
        $unitType=$this->unitType;
        $parentItem=$this->parentItem;
        $taxMaster=$this->taxMaster;
        $subCateMaster=$this->subCateMaster;
        $brand_master_data=$this->brand_master_data;
        return view('Master.item_master',['itemCodeSeq' => $itemCodeSeq,'unitType' => $unitType,'parentItem' => $parentItem,'taxMaster' => $taxMaster,'subCateMaster' => $subCateMaster,'brand_master_data' => $brand_master_data]);
    }

    public function subCategory(Request $request)
    {
        $sub_category_code=$request->sub_category_code;
        $sub_category_data = sub_category_master::select('cat_code','markup','markdown','shelf_life_p','shelf_life_dm')->where('sub_cat_code', '=', $sub_category_code)->get();

        $category_data=category_master::select('cat_name','cat_type','inventory')->where('cat_code', '=', $sub_category_data[0]['cat_code'])->get();

        if ($category_data[0]['inventory']=='Y') 
        {
            $inventory="Yes";
        }
        elseif ($category_data[0]['inventory']=='N') {
            $inventory="No";
        }else{$inventory="";}
        $cat_type=$category_data[0]['cat_type'];
        $cat_type_name=$this->food_type[$cat_type];
        $subCateData=array('markup' => $sub_category_data[0]['markup'], 'markdown' => $sub_category_data[0]['markdown'],'shelf_life_p' =>$sub_category_data[0]['shelf_life_p'],'shelf_life_dm' => $sub_category_data[0]['shelf_life_dm'],'cate_code' => $sub_category_data[0]['cat_code'],'cateName' => $category_data[0]['cat_name'],'inventory' => $inventory,'cat_type_name' => $cat_type_name);
        return Response::json(['subCateData' => $subCateData]);

    }

    public function itemBrand(Request $request)
    {
        $brand_code=$request->brand_code;
        $manufac_data=brand_master::select('manufact_code')->where('brand_code', '=', $brand_code)->first();
        $manufact_name=$this->manufact_master_data[$manufac_data->manufact_code];
        $brand_data=array('manufact_name' => $manufact_name,'manufact_code' => $manufac_data->manufact_code);
        return Response::json(['brand_data' => $brand_data]);
    }

    public function store(Request $request)
    {
        $itemCodeSeq=$this->itemCodeSeq->param_value;
        if($itemCodeSeq=='Y')
        {
            $itemseqvalid=0;
            $max_item_code=$this->max_item_code;
            $item_codeAuto=$max_item_code+1;
        }
        else
        {
            $itemseqvalid=1;
        }
        
        $validatedData = Validator::make($request->all(), 
        [
            'item_code' => $itemseqvalid==1 ? 'required|unique:item_master' : 'unique:item_master',
            'item_name' => 'required',
            'item_weight' => 'required',
            'item_UOM' => 'required',
            'item_type' => 'required',
            'tax_code' => 'required',
            'sub_category_code' => 'required'
        ],
        [
            'item_code.required' => 'Please Enter Code',
            'item_code.unique' => 'Code Already Exist',
            'item_name.required' => 'Please Enter Name',
            'item_weight.required' => 'Please Enter Weight',
            'item_UOM.required' => 'Please Select Unit',
            'item_type.required' => 'Please Select Item Type',
            'tax_code.required' => 'Please Select Tax',
            'sub_category_code.required' => 'Please Select Sub Category'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            item_master::create([
                'item_code' => $itemseqvalid==true ? $request->item_code : $item_codeAuto,
                'item_name' => $request->item_name,
                'item_weight' => $request->item_weight,
                'item_UOM' => $request->item_UOM,
                'item_type' => $request->item_type,
                'item_parent' => $request->item_parent,
                'pack_charge' => $request->pack_charge,
                'lebel_reqd' => $request->lebel_reqd,
                'qty_in_case' => $request->qty_in_case,
                'tax_code' => $request->tax_code,
                'sub_category_code' => $request->sub_category_code,
                'category_code' => $request->category_code,
                'category_type' => $request->category_type,
                'inventory' => $request->inventory,
                'brand_code' => $request->brand_code,
                'manufact_code' => $request->manufact_code,
                'markup' => $request->markup,
                'markdown' => $request->markdown,
                'hsn' => $request->hsn,
                'exp_req' => $request->exp_req,
                'shelf_life_period' => $request->shelf_life_period,
                'shelf_life_dm' => $request->shelf_life_dm,
                'group1' => $request->group1,
                'group2' => $request->group2,
                'group3' => $request->group3,
                'group4' => $request->group4,
                'barcode' => $request->barcode,
                'status' =>'Y',
                'rate_upd' =>'A',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }

    }

    public function itemMasterPdf()
    {
        $item_master_data=$this->item_master_data;
        $unitType=$this->unitType;
        $parentItem=$this->parentItem;
        $taxMaster=$this->taxMaster;
        $subCateMaster=$this->subCateMaster;
        $brand_master_data=$this->brand_master_data;
        $manufact_master_data=$this->manufact_master_data;
        $category_data=$this->category_data;
        $pdf = PDF::loadView('Master.item_master_pdf',['item_master_data' => $item_master_data,'unitType' => $unitType,'parentItem' => $parentItem,'taxMaster' => $taxMaster,'subCateMaster' => $subCateMaster,'brand_master_data' => $brand_master_data,'manufact_master_data' => $manufact_master_data,'category_data' => $category_data]);
        return $pdf->download('item_master.pdf');
    }

    public function itemMasterExcel()
    {
        $item_master_data=$this->item_master_data;
        $unitType=$this->unitType;
        $parentItem=$this->parentItem;
        $taxMaster=$this->taxMaster;
        $subCateMaster=$this->subCateMaster;
        $brand_master_data=$this->brand_master_data;
        $manufact_master_data=$this->manufact_master_data;
        $category_data=$this->category_data;
        return Excel::download(new itemMasterExport($item_master_data,$unitType,$parentItem,$taxMaster,$subCateMaster,$brand_master_data,$manufact_master_data,$category_data),'itemMaster.xlsx');
    }

    public function itemMasterGetExcel($item_master_data,$unitType,$parentItem,$taxMaster,$subCateMaster,$brand_master_data,$manufact_master_data,$category_data)
    {
        $srNo=0;
        $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $arrOfDayMonth=array(); $arrOfDayMonth['D']='Days'; $arrOfDayMonth['M']='Month';
        $arrOfPackLoose=array(); $arrOfPackLoose['P']='Pack'; $arrOfPackLoose['L']='Loose'; 
        $arrOfPackLoose['V']='Variant';

        foreach($item_master_data as $itemKey => $itemvalue)
        {
            $result[]= array(++$srNo,$arrOfStatus[$itemvalue->status],$itemvalue->item_code,$itemvalue->item_name?? '-',$itemvalue->item_weight,$unitType[$itemvalue->item_UOM],$arrOfPackLoose[$itemvalue->item_type]?? '-',$parentItem[$itemvalue->item_parent]?? '-',$itemvalue->pack_charge,$arrOfYesNo[$itemvalue->lebel_reqd]?? '-',$itemvalue->qty_in_case,$taxMaster[$itemvalue->tax_code]?? '-',$subCateMaster[$itemvalue->sub_category_code]?? '-',$category_data[$itemvalue->category_code]?? '-',$itemvalue->category_type,$itemvalue->inventory,$brand_master_data[$itemvalue->brand_code]?? '-',$manufact_master_data[$itemvalue->manufact_code]?? '-',$itemvalue->markup,$itemvalue->markdown,$itemvalue->rate_upd,$itemvalue->hsn,$arrOfYesNo[$itemvalue->exp_req]?? '-',$itemvalue->shelf_life_period,$arrOfDayMonth[$itemvalue->shelf_life_dm]?? '-',$itemvalue->group1,$itemvalue->group2,$itemvalue->group3,$itemvalue->group4,$itemvalue->barcode,$itemvalue->created_by,$itemvalue->created_at,$itemvalue->t_user?? '-',$itemvalue->updated_at);
        }

        return $result;
    }
}
