<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointofSale extends Controller
{
    public function index()
    {
        $macAddr = exec('getmac');
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $macAddr]);
    }
}
