<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StarSystem extends Model
{
    protected $fillable = [
        'name', 'type'
    ];

    public function planets()
    {
        return $this->hasMany('App\Planet');
    }
}
