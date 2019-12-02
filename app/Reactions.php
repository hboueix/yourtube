<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'video_id', 'is_liked'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
