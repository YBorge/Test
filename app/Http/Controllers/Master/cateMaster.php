<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\common_list_master;
use App\Models\category_master;
use App\Models\sub_category_master;
use Illuminate\Support\Facades\Validator;
use Response;
class cateMaster extends Controller
{
    public function index()
    {
    	$cat_mater = category_master::where('status', '=', 'Y')
                            ->pluck('cat_name','cat_code');
    	$food_type = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'CAT_TYPE')
                            ->pluck('list_value','list_id');
        $category_master_data= category_master::all()->where('status','Y');
        $sub_category_master_data= sub_category_master::all()->where('status','Y');
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
}
