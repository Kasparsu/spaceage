<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $fillable = [
        'name', 'type'
    ];

    public function fleets()
    {
        return $this->hasMany('App\Fleet');
    }

    public function plots()
    {
        return $this->hasMany('App\Plot');
    }
}
