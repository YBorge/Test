<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_barcode extends Model
{
    use HasFactory;
    protected $table = 'item_barcode';
    protected $guarded = []; 
}
