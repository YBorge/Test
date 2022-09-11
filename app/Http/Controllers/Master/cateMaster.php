<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\common_list_master;
use App\Models\category_master;

class cateMaster extends Controller
{
    public function index()
    {
    	$cat_mater = category_master::where('status', '=', 'Y')
                            ->pluck('cat_name','cat_code');
    	$food_type = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'CAT_TYPE')
                            ->pluck('list_value','list_id');
        return view('master.cate_master',['food_type' => $food_type,'cat_mater' => $cat_mater]);
    }
}
