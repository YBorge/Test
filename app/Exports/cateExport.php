<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\cateMaster;

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
    public function collection()
    {
        return collect(cateMaster::cateMasterExcel());
    }
}
