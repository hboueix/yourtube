<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public $timestamps = true;

    protected $fillable = ['videos_id', 'user_id', 'title', 'image', 'description', 'likes', 'dislikes'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
