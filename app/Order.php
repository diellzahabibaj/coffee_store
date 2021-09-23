<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'total', 'order_time', 'user_id'];
    //public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity','amount');
    }

    

}
