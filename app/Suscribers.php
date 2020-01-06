<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscribers extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'suscriber_id', 'is_suscribed'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

