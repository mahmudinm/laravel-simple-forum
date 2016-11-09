<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function forum()
    {
        return $this->belongsTo('App\Forum')
    }

    public function threads()
    {
        return $this->hasMany('App\Thread', 'category_id');
    }


}
