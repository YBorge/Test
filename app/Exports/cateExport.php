<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\cateMaster;
use Illuminate\Http\Request;

class cateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Sr No','Code','Name',
            'Type',
            'Group',
            'Inventory',
            'Status',
            'Created By',
            'Created Date and Time',
            'Updated Date and Time'
        ];
        
    }
    protected $category_master_data;
    protected $food_type;

    function __construct($category_master_data,$food_type) 
    {
        $this->category_master_data = $category_master_data;
        $this->food_type = $food_type;
    }
    public function collection()
    {
        return collect(cateMaster::cateMasterGetExcel($this->category_master_data, $this->food_type));
    }
}
