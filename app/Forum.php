<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    
    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->hasMany('App\Category', 'forum_id');
    }

    public function threads()
    {
        return $this->hasManyThrough('App\Thread', 'App\Category');
    }


}
