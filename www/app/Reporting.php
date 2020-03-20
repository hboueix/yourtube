<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    public $timestamps = true;

    protected $fillable = ['reporter_id', 'video_id', 'content'];

}
