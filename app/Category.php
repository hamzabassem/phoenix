<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'name', 'description', 'buying_price','selling_price', 'notify', 'user_id',
    ];



    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
