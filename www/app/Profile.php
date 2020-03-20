<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = true;

    protected $fillable = ['user_id', 'image', 'last_name', 'first_name', 'dateOfBirth'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
