<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function Category(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name', 'start', 'end', 'user_id',
    ];
}
