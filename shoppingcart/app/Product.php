<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
	use Searchable;
	
    protected $fillable = ['name', 'image', 'price', 'slug', 'description'];

    public function orders()
    {
    	return $this->belongsToMany('App\Order','Order_Products', 'order_id', 'product_id');
    }
}
