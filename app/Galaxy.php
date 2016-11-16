<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galaxy extends Model
{

    protected $fillable = [
        'name', 'type'
    ];

    public function starSystems()
    {
        return $this->hasMany('App\StarSystem');
    }
}
