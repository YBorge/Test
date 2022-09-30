<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\custMaster;
use Illuminate\Http\Request;

class customerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Sr No','Code',
            'Name',
            'Gender',
            'Barcode',
            'Birth Date','Join Date','Address1','Address2','City','State Code','State','Country Code','Country','Pincode','Mobile','Email','PAN','Aadhar No','Cust-Type','Ref-Cust','CR Limit','CR Overdue Days','Points','Status','Created By','Created Date and Time','Updated By',
            'Updated Date and Time'
        ];
        
    }

    protected $cust_masterdata;
    protected $state_master;
    protected $country_master;
    protected $cust_type_master;
    protected $ref_customer;
    protected $city_master;

    function __construct($cust_masterdata,$state_master,$country_master,$cust_type_master,$ref_customer,$city_master) 
    {
        $this->cust_masterdata = $cust_masterdata;
        $this->state_master = $state_master;
        $this->country_master = $country_master;
        $this->cust_type_master = $cust_type_master;
        $this->ref_customer = $ref_customer;
        $this->city_master = $city_master;
    }
    public function collection()
    {
        return collect(custMaster::custMasterGetExcel($this->cust_masterdata, $this->state_master,$this->country_master,$this->cust_type_master,$this->ref_customer,$this->city_master));
    }
}
