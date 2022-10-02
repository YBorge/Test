<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Master\userMaster;
use Illuminate\Http\Request;

class userExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings():array{
        return[
            'Sr No','User Code','User Name',
            'Role',
            'Mobile',
            'Email',
            'Status',
            'Created By',
            'Created Date and Time','Updated By',
            'Updated Date and Time'
        ];
        
    }
    protected $user_role;
    protected $user_data;
    
    public function __construct($user_role,$user_data)
    {
        $this->user_role=$user_role;
        $this->user_data=$user_data;
    }
    public function collection()
    {
       return collect(userMaster::userMasterGetExcel($this->user_role,$this->user_data));
    }
}
