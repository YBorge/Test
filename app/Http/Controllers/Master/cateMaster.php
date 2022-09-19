<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\common_list_master;
use App\Models\category_master;
use App\Models\sub_category_master;
use App\Models\parameters;
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
        $this->cateSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_CAT_SEQ')
                                    ->get();
        $this->subCateSeq=parameters::select('param_value','param_desc')
                                    ->where('param_code', '=', 'USE_SUB_CAT_SEQ')
                                    ->get();
        $this->Seq_cat_code=category_master::max('cat_code');
        $this->Seq_sub_cat_code=sub_category_master::max('sub_cat_code');
    }

    public function index()
    {
    	$cat_mater=$this->cat_mater;
    	$food_type = $this->food_type;
        $category_master_data=$this->category_master_data;
        $sub_category_master_data=$this->sub_category_master_data;
        $cateSeq=$this->cateSeq[0]['param_value'];
        $subCateSeq=$this->subCateSeq[0]['param_value'];
        return view('master.cate_master',['food_type' => $food_type,'cat_mater' => $cat_mater,'category_master_data' => $category_master_data,'sub_category_master_data' => $sub_category_master_data,'cateSeq' => $cateSeq,'subCateSeq' => $subCateSeq]);
    }
    public function store(Request $request)
    {
        $cateSeq=$this->cateSeq[0]['param_value'];
        if($cateSeq=='Y')
        {   
            $cateSeVal=0;
            $Seq_cat_codeSave=$this->Seq_cat_code+1;
        }else{
            $cateSeVal=1;
        }
        $validatedData = Validator::make($request->all(), 
        [
            'cat_code' => $cateSeVal==1 ? 'required|unique:category_master' : 'unique:category_master',
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
                'cat_code' => $cateSeVal==1 ? $request->cat_code : $Seq_cat_codeSave,
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
        $subCateSeq=$this->subCateSeq[0]['param_value'];
        if($subCateSeq=='Y')
        {   
            $subCateSeVal=0;
            $Seq_sub_cat_codeSave=$this->Seq_sub_cat_code+1;
        }else{
            $subCateSeVal=1;
        }
        $validatedData = Validator::make($request->all(), 
        [
            'sub_cat_code' => $subCateSeVal==1 ? 'required|unique:sub_category_master' : 'unique:sub_category_master',
            'sub_cat_name' => 'required',
            'pos_cat_code' => 'required',
            'markup' => 'required',
            'markdown' => 'required',
            'shelf_life_p' => 'required',
            'shelf_life_dm' => 'required'
        ],
        [
            'sub_cat_code.required' => 'Please Enter Sub Ctegory Code',
            'sub_cat_code.unique' => 'Sub Ctegory Code Already Exist',
            'sub_cat_name.required' => 'Please Enter Sub Ctegory Name',
            'pos_cat_code.required' => 'Please Select Sub Category Type',
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
                'sub_cat_code' => $subCateSeVal==1 ? $request->sub_cat_code : $Seq_sub_cat_codeSave,
                'sub_cat_name' => $request->sub_cat_name,
                'cat_code' => $request->pos_cat_code,
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