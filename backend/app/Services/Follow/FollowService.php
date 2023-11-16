<?php

namespace App\Services\Follow;

use App\Models\Follow;

class FollowService
{
    public function followUnfollow($followerId, $followeeId)
    {
        $followed = $this->alreadyFollowed($followerId, $followeeId);
        if (!is_null($followed)) {
            return $followed->delete();
        }

        return Follow::create(['follower_id' => $followerId, 'following_id' => $followeeId]);
    }

    public function alreadyFollowed($followerId, $followeeId)
    {
        return Follow::where(['follower_id' => $followerId, 'following_id' => $followeeId])->first();
    }

    public function getFollowingByFollowerId($followerId)
    {
        return Follow::where('follower_id', $followerId)->pluck('following_id')->toArray();
    }

    public function getFollowerByFollowerId($followerId)
    {
        return Follow::where('following_id', $followerId)->pluck('follower_id')->toArray();
    }
}
