<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function videos()
    {
        return $this->hasMany('App\Videos');
    }
}
