<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class itemMaster extends Controller
{
    public function list()
    {
        return view('Master.item_master_list');
    }
    public function index()
    {
        return view('Master.item_master');
    }
}
