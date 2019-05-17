<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;

    public function theme() {
        return $this->belongsTo('App\Theme');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }
}
