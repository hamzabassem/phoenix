<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportBill extends Model
{
    protected $fillable = [
        'description', 'category_id', 'quantity', 'user_id','customer_id','store_id','bill_number','processing'
    ];
}
