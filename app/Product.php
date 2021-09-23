<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','coffee_origin'];
   // public $timestamps = false;

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
