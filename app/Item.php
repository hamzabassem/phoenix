<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function category(){
        return $this->belongsTo('App\Category');
    }

    protected $fillable = [
        'operation', 'description', 'quantity','storage', 'user_id', 'category_id',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
