<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\itemMaster;
use Illuminate\Http\Request;

class itemMasterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Sr No','Status','Code',
            'Name',
            'Weight',
            'Unit',
            'Item Type','Parent Item','Pack Charge','Label Reqd','Qty In Case','Tax (%)','Sub Category','Category','Category Type','Inventory','Brand','Manufacturer','MarkUp (%)','MarkDown (%)','Rate Update','HSN No','Expiry Reqired','ShelfLife','Shelf Life D/M','Group 1','Group 2','Group 3','Group 4','Bar Code','Created By','Created Date and Time','Updated By',
            'Updated Date and Time'
        ];
        
    }

    protected $item_master_data;
    protected $unitType;
    protected $parentItem;
    protected $taxMaster;
    protected $subCateMaster;
    protected $brand_master_data;
    protected $manufact_master_data;
    protected $category_data;

    function __construct($item_master_data,$unitType,$parentItem,$taxMaster,$subCateMaster,$brand_master_data,$manufact_master_data,$category_data) 
    {
        $this->item_master_data = $item_master_data;
        $this->unitType = $unitType;
        $this->parentItem = $parentItem;
        $this->taxMaster = $taxMaster;
        $this->subCateMaster = $subCateMaster;
        $this->brand_master_data = $brand_master_data;
        $this->manufact_master_data = $manufact_master_data;
        $this->category_data = $category_data;
    }
    public function collection()
    {
        return collect(itemMaster::itemMasterGetExcel($this->item_master_data, $this->unitType,$this->parentItem,$this->taxMaster,$this->subCateMaster,$this->brand_master_data,$this->manufact_master_data,$this->category_data));
    }
}
