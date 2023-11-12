<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Follow extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'follows';


    public function follower()
    {
        return $this->belongsTo(User::class, 'follower');
    }

    public function followee()
    {
        return $this->belongsTo(User::class, 'followee');
    }
}
