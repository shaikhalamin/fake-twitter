<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Follow extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'follows';

    protected $fillable = [
        'follower_id',
        'following_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class);
    }

    public function following()
    {
        return $this->belongsTo(User::class);
    }
}
