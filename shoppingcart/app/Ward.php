<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['name', 'district_id'];

    public function district()
    {
    	return $this->belongsTo(District::class);
    }
}
