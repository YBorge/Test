<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\common_list_master;
use App\Models\category_master;
use App\Models\sub_category_master;
use App\Exports\cateExport;
use App\Exports\cateSubExport;
use Response;
use PDF;
use Excel;
class cateMaster extends Controller
{
    public $cat_mater;
    public $food_type;
    public $category_master_data;
    public $sub_category_master_data;
    public function __construct()
    {
        $this->cat_mater = category_master::where('status', '=', 'Y')
                            ->pluck('cat_name','cat_code');
        $this->food_type = common_list_master::where('status', '=', 'Y')
                    ->where('list_code', '=', 'CAT_TYPE')
                    ->pluck('list_value','list_id');
        $this->category_master_data= category_master::all()->where('status','Y');
        $this->sub_category_master_data= sub_category_master::all()->where('status','Y');
    }

    public function index()
    {
    	$cat_mater=$this->cat_mater;
    	$food_type = $this->food_type;
        $category_master_data=$this->category_master_data;
        $sub_category_master_data=$this->sub_category_master_data;
        return view('master.cate_master',['food_type' => $food_type,'cat_mater' => $cat_mater,'category_master_data' => $category_master_data,'sub_category_master_data' => $sub_category_master_data]);
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'cat_code' => 'required|unique:category_master',
            'cat_name' => 'required',
            'cat_type' => 'required',
            'group' => 'required',
            'inventory' => 'required'
        ],
        [
            'cat_code.required' => 'Please Enter Code',
            'cat_code.unique' => 'Code Already Exist',
            'cat_name.required' => 'Please Enter Name',
            'cat_type.required' => 'Please Select Category Type',
            'group.required' => 'Please Enter Group',
            'inventory.required' => 'Please Select Inventory'
            
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            category_master::create([
                'cat_code' => $request->cat_code,
                'cat_name' => $request->cat_name,
                'cat_type' => $request->cat_type,
                'group' => $request->group,
                'inventory' => $request->inventory,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }
    public function subCateSave(Request $request)
    {
        $validatedData = Validator::make($request->all(), 
        [
            'sub_cat_code' => 'required|unique:sub_category_master',
            'sub_cat_name' => 'required',
            'cat_code' => 'required',
            'markup' => 'required',
            'markdown' => 'required',
            'shelf_life_p' => 'required',
            'shelf_life_dm' => 'required'
        ],
        [
            'sub_cat_code.required' => 'Please Enter Sub Ctegory Code',
            'sub_cat_code.unique' => 'Sub Ctegory Code Already Exist',
            'sub_cat_name.required' => 'Please Enter Sub Ctegory Name',
            'cat_code.required' => 'Please Select Sub Category Type',
            'markup.required' => 'Please Enter markup',
            'markdown.required' => 'Please Enter Markdown',
            'shelf_life_p.required' => 'Please Enter Shelf Life Peried',
            'shelf_life_dm.required' => 'Please Select Shelf Life D/M'
        ]);
        if($validatedData->fails())
        {
            return Response::json(['errors' => $validatedData->errors()->first()]);
        }

        if ($validatedData->passes()) 
        {
            sub_category_master::create([
                'sub_cat_code' => $request->sub_cat_code,
                'sub_cat_name' => $request->sub_cat_name,
                'cat_code' => $request->cat_code,
                'markup' => $request->markup,
                'markdown' => $request->markdown,
                'shelf_life_p' => $request->shelf_life_p,
                'shelf_life_dm' => $request->shelf_life_dm,
                'status' =>'Y',
                'created_by' => Session::get('useremail')
            ]);
           
            return Response::json(['success' => true]);
        }
    }

    public function CatePDF()
    {
        $category_master_data=$this->category_master_data;
        $food_type = $this->food_type;
        $pdf = PDF::loadView('master.cateMasterPDF',["category_master_data" => $category_master_data,'food_type' => $food_type,'cateType' => 'Master']);
    
        return $pdf->download('category.pdf');
    }
    public function subcateMaster()
    {
        $food_type = $this->food_type;
        $cat_master =$this->cat_mater;
        $sub_category_master_data=$this->sub_category_master_data;
        $pdf = PDF::loadView('master.cateMasterPDF',["sub_category_master_data" => $sub_category_master_data,'food_type' => $food_type,'cateType' => 'SubMaster','cat_master' => $cat_master]);
    
        return $pdf->download('subcategory.pdf');
    }

    public function cateMasterExcel()
    {
        $category_master_data=$this->category_master_data;
        $food_type = $this->food_type;
        return Excel::download(new cateExport($category_master_data,$food_type),'cateMaster.xlsx');
    }

    public function cateMasterGetExcel($category_master_data, $food_type)
    {
        $arrOfYesNo=array(); $arrOfYesNo['Y']='Yes'; $arrOfYesNo['N']='No'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $srNo=0;
        foreach($category_master_data as $cat_value)
        {
            $result[]=array(++$srNo,$cat_value->cat_code,$cat_value->cat_name,$food_type[$cat_value->cat_type],$cat_value->group,$arrOfYesNo[$cat_value->inventory],$arrOfStatus[$cat_value->status],$cat_value->created_by,$cat_value->created_at,$cat_value->updated_at);
        }

        return $result;
    }

    public function sub_cate_master_excel()
    {
        $cat_master =$this->cat_mater;
        $sub_category_master_data=$this->sub_category_master_data;
        return Excel::download(new cateSubExport($cat_master,$sub_category_master_data),'subcateMaster.xlsx');
    }

    public function cateSubMasterGetExcel($sub_category_master_data,$cat_master)
    {
        
        $arrOfDayMonth=array(); $arrOfDayMonth['D']='Days'; $arrOfDayMonth['M']='Month'; 
        $arrOfStatus=array(); $arrOfStatus['Y']='Active'; $arrOfStatus['N']='In-Active';
        $srNo=0;
        foreach($sub_category_master_data as $sub_cat_value)
        {
            $result[]=array(++$srNo,$sub_cat_value->sub_cat_code,$sub_cat_value->sub_cat_name,$cat_master[$sub_cat_value->cat_code],$sub_cat_value->markup,$sub_cat_value->markdown,$sub_cat_value->shelf_life_p,$arrOfDayMonth[$sub_cat_value->shelf_life_dm],$arrOfStatus[$sub_cat_value->status],$sub_cat_value->created_by,$sub_cat_value->created_at,$sub_cat_value->updated_at);
        }

        return $result;
    }
}