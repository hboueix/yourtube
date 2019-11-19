<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'title', 'image', 'description', 'path', 'likes', 'dislikes'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
