<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\vendorMaster;
use Illuminate\Http\Request;


class vendorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Sr No','Code','Name',
            'Credit Days',
            'Address 1',
            'Address 2','City','State','Country','Pin Code','Phone No','Email','GSTIN','FASSI No','Aadhar No','Pan No','Contact Person',
            'Status',
            'Created By',
            'Created Date and Time','Updated By',
            'Updated Date and Time'
        ];
        
    }

    protected $suply_type;
    protected $city_master;
    protected $vendor_master_data;
    protected $state_master;
    protected $country_master;

    function __construct($suply_type,$city_master,$vendor_master_data,$state_master,$country_master) 
    {
        $this->suply_type = $suply_type;
        $this->city_master = $city_master;
        $this->vendor_master_data = $vendor_master_data;
        $this->state_master = $state_master;
        $this->country_master = $country_master;

    }
    public function collection()
    {
        return collect(vendorMaster::vendorMasterGetExcel($this->suply_type, $this->city_master,$this->vendor_master_data,$this->state_master,$this->country_master));
    }
}
