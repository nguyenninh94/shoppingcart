<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'province_id'];

    public function province()
    {
    	return $this->belongsTo(Province::class);
    }

    public function wards()
    {
    	return $this->hasMany(Ward::class);
    }
}
