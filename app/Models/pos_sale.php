<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pos_sale extends Model
{
    use HasFactory;
    protected $table = 'pos_sale';
    protected $guarded = []; 
}
