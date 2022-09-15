<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\cateMaster;
use Illuminate\Http\Request;

class cateSubExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Sr No','Code','Name',
            'Category',
            'Mark Up',
            'Mark Down',
            'Shelf Peried',
            'Day/Months',
            'Status',
            'Created By',
            'Created Date and Time',
            'Updated Date and Time'
        ];
        
    }

    protected $cat_master;
    protected $sub_category_master_data; 

    function __construct($cat_master,$sub_category_master_data) 
    {
        $this->cat_master = $cat_master;
        $this->sub_category_master_data= $sub_category_master_data;
    }
    public function collection()
    {
        return collect(cateMaster::cateSubMasterGetExcel( $this->sub_category_master_data, $this->cat_master));
    }
}
