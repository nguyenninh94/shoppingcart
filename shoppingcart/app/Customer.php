<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = ['name', 'phone', 'province', 'district', 'ward'];

    public function orders()
    {
    	return $this->hasMany(Order::class);
    }
}
