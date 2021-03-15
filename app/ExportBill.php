<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportBill extends Model
{
    protected $fillable = [
         'description', 'category_id','category_name', 'quantity', 'user_id','customer_id','price','totalPrice'
    ];
}
