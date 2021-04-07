<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function users(){
        return $this->hasMany(User::class);

    }


    protected $fillable = [
        'name','days','signature'
    ];


    /*public function getSignatureAttribute($signature)
    {
        return is_null($signature) ? null : asset($signature);
    }*/
}
