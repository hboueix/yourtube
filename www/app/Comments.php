<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'video_id', 'content'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
