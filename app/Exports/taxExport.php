<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\taxMaster;
use Illuminate\Http\Request;

class taxExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Sr No','Type','Name',
            'Code',
            'Tax (%)',
            'Tax Indicator',
            'IGST (%)','SGST (%)','CGST (%)','UTGST (%)','CESS (%)','Cess Per Peice (%)',
            'Status',
            'Created By',
            'Created Date and Time','Updated By',
            'Updated Date and Time'
        ];
        
    }
    protected $tax_master_data;
    
    public function __construct($tax_master_data)
    {
        $this->tax_master_data=$tax_master_data;
    }
    public function collection()
    {
       return collect(taxMaster::taxMasterGetExcel($this->tax_master_data));
    }
}
