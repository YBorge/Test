<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class PointofSale extends Controller
{
    public function index()
    {
        $sysDate= Carbon::now()->format('d-m-Y');
        $macAddr = exec('getmac');
        //echo php_uname();
        //echo $host = request()->getHttpHost();
        return view('master.pointofsale',['macAddr' => $macAddr,'sysDate' => $sysDate]);
    }
}
