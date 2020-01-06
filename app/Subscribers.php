<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'subscriber_id', 'is_subscribed'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
