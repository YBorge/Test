<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\paymentMaster;
use Illuminate\Http\Request;

class paymentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Sr No','Payment Code','Payment',
            'CalCulate On',
            'Charges (%)',
            'Allow Multi',
            'Bill Copy',
            'Status',
            'Created By',
            'Created Date and Time',
            'Updated Date and Time'
        ];
        
    }
    protected $paymentData;

    public function __construct($paymentData)
    {
        $this->paymentData=$paymentData;
    }

    public function collection()
    {
        return collect(paymentMaster::paymentMasterGetExcel($this->paymentData));
    }
}
