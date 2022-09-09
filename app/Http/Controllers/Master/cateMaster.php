<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cateMaster extends Controller
{
    public function index()
    {
        return view('master.cate_master');
    }
}
