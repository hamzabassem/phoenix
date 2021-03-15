<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmportBill extends Model
{
    protected $fillable = [
         'description', 'category_id', 'quantity', 'user_id','supplier_id','store_id','bill_number','processing'
    ];
}
