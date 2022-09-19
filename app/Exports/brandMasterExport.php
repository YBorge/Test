<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\manufacturerBrandMaster;
use Illuminate\Http\Request;

class brandMasterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Sr No','Code','Name','Manufacturer',
            'Status',
            'Created By',
            'Created Date and Time',
            'Updated Date and Time'
        ];
        
    }

    protected $brandData;
    protected $manftype;

    function __construct($brandData,$manftype) 
    {
        $this->brandData = $brandData;
        $this->manftype = $manftype;
    }

    public function collection()
    {
        return collect(manufacturerBrandMaster::subBrandMasterGetExcel($this->brandData,$this->manftype));
    }

}
