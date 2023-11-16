<?php

namespace App\Services\Follow;

use App\Models\Follow;

class FollowService
{
    public function getFollowingByFollowerId($followerId)
    {
        return Follow::where('follower_id', $followerId)->pluck('following_id')->toArray();
    }
}