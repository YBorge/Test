<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\manufacturerBrandMaster;
use Illuminate\Http\Request;

class manufacturerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Sr No','Code','Name',
            'Type',
            'Status',
            'Created By',
            'Created Date and Time',
            'Updated Date and Time'
        ];
        
    }
    protected $manfacData;

    function __construct($manfacData) 
    {
        $this->manfacData = $manfacData;
    }

    public function collection()
    {
        return collect(manufacturerBrandMaster::brandMasterGetExcel($this->manfacData));
    }
}
