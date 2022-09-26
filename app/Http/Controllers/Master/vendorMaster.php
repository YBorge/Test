<?php

namespace App\Http\Controllers\Master;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\common_list_master;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use App\Models\location_master;
use App\Models\parameters;
use Illuminate\Support\Facades\Validator;
use Response;

class vendorMaster extends Controller
{
    public $city_master;
    public $vendorCodeSeq;
    public $suply_type;
    public function __construct()
    {
        $this->city_master = city::pluck('city_name','city_id');
                           
        $this->comp_location_master= location_master::all();
        $this->suply_type = common_list_master::where('status', '=', 'Y')
                            ->where('list_code', '=', 'SUPP_TYPE')
                            ->pluck('list_desc','list_value');
        $this->state_master = state::pluck('state_name','state_code');
        $this->country_master = country::pluck('country_name','country_code');
        $this->vendorCodeSeq=parameters::select('param_value')->where('param_code', '=', 'USE_VENDOR_SEQ')->first();
    }
    public function index()
    {
        $vendorCodeSeq=$this->vendorCodeSeq->param_value;
        $suply_type=$this->suply_type;
        $city_master=$this->city_master;
        return view('Master.vendor_master',['vendorCodeSeq' => $vendorCodeSeq,'suply_type' => $suply_type,'city_master' =>$city_master]);
    }
}
