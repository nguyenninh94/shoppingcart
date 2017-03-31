<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'status', 'customer_id'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product','Order_Products', 'order_id', 'product_id');
    }
}
