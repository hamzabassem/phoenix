<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'operation', 'description', 'quantity','deleted', 'user_id', 'category_id','processing','customer_id','supplier_id','store_id','export_bill','import_bill'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
